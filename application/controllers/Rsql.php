<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rsql extends CI_Controller {

	private $query;
	private $result;
	public $db;

	public function __construct() {
		parent::__construct();

		$this->load->dbutil();
		$this->load->model('remote_database');

		if ($this->session->userdata('db_slug') !== null) {
			$slug = $this->session->userdata('db_slug');
			$this->db = $this->remote_database->connectDatabase( $slug );
		}

	}

	public function con_db() {
		$data['cur_page'] = 'condb';
		$this->load->view('main/header', $data);
		$this->load->view('rsql');
		$this->load->view('main/footer');
	}

	public function query($data = NULL) {

		$_data['cur_page'] = 'query';
		$_data['result_sets'] = $data;

		$db_slug = $this->session->userdata('db_slug');

		if ( !$db_slug ) {
			redirect('/rsql/con_db');
		}

		$this->load->view('main/header', $_data);
		$this->load->view('query');
		$this->load->view('main/footer');	
	}

	public function run_query() {

		$this->form_validation->set_rules('query', 'Query', 'trim|required'); 

		if ($this->form_validation->run() == FALSE) { 
			$this->query();
		} else {
			$data = [];

			$this->query = $this->input->post('query');

			if (preg_match('/^USE|^use/', $this->query)) {
				$this->session->set_flashdata("use_not_allowed", "USE query is't allowed here. If you want to connect with other database cilck here <a href='http://localhost/remote-sql-master/rsql/con_db'>Connect DB</a>.");
				redirect('/rsql/query');
			}
			
			$queries = explode(';', $this->query);

			if(count($queries) > 1) {

				foreach ($queries as $this->query) {

					if (trim($this->query) == "") {
						continue;
					}

					$this->result = $this->db->query($this->query);
					array_push($data, $this->parseResult());
				}
			} else {
				$this->result = $this->db->query( $this->query );
				array_push($data, $this->parseResult());
			}

			$this->query($data);
		}
	}

	public function parseResult() {

		// Alternative to preg_match()
		// strpos(strtolower($this->query),'select') !== false

		$data = [];

		$data['query'] = $this->query;

		if (preg_match('/^SELECT|^select/', $this->query) == 1) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['total_fields'] = 0;
				$data['num_rows'] = 0;
				$data['query_error'] = $this->db->error();
			} else {
				$data['query_result'] = $this->result->result_array();
				$data['fields_name'] = $this->result->list_fields();
				$data['total_fields'] = $this->result->conn_id->field_count;
				$data['num_rows'] = $this->result->num_rows();
				$data['warnings'] =	$this->result->conn_id->warning_count;
				$data['query_times'] = $this->db->query_times[0];
			}
		}

		if (preg_match('/^DROP|^drop/', $this->query) == 1) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['total_fields'] = 0;
				$data['num_rows'] = 0;
				$data['query_error'] = $this->db->error();
			} else {
				$query = explode(" ", $this->query);
				$db = $query[2];
				if ($this->session->userdata('current_db') === $db) {
					$this->session->unset_userdata('db_slug');
					$this->session->unset_userdata('current_db');
					$this->session->set_flashdata('db_dropped', 'Database successfully dropped.');
					redirect('/rsql/con_db');
				} else {
					$data['fields_name'] = 0;
					$data['total_fields'] = 0;
					$data['affected_rows'] = $this->db->conn_id->affected_rows;
					$data['num_rows'] = 0;
					$data['warnings'] =	$this->db->conn_id->warning_count;
					$data['query_times'] = $this->db->query_times[0];
					$data['query_count'] = $this->db->query_count;
					$data['query'] = $this->db->queries[0];
				}
			}
		}

		if (preg_match('/^RENAME|^rename/', $this->query) == 1 OR preg_match('/^INSERT|^insert/', $this->query) == 1 OR preg_match('/^UPDATE|^update/', $this->query) == 1 OR preg_match('/^DELETE|^delete/', $this->query) == 1 OR preg_match('/^ALTER|^alter/', $this->query) == 1) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['total_fields'] = 0;
				$data['num_rows'] = 0;
				$data['query_error'] = $this->db->error();
			} else {
				$data['fields_name'] = 0;
				$data['total_fields'] = 0;
				$data['num_rows'] = 0; 
				$data['warnings'] = $this->db->conn_id->warning_count; 
				$data['affected_rows'] = 1;
				$data['query_times'] = $this->db->query_times[0];
				$data['query_count'] = $this->db->query_count;
				$data['query'] = $this->db->queries[0];
			}
		}
		
		if (preg_match('/^CREATE|^create/', $this->query) == 1) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['total_fields'] = 0;
				$data['num_rows'] = 0;
				$data['query_error'] = $this->db->error();
			} else {	
				$data['fields_name'] = 0;
				$data['total_fields'] = 0;
				$data['num_rows'] = 0;
				$data['warnings'] = $this->db->conn_id->warning_count; 
				$data['affected_rows'] = $this->db->affected_rows();
				$data['query_times'] = $this->db->query_times[0];
				$data['query_count'] = $this->db->query_count;
				$data['query'] = $this->db->queries[0];
			}
		}

		if (preg_match('/^SHOW|^show/', $this->query) == 1) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['total_fields'] = 0;
				$data['num_rows'] = 0;
				$data['query_error'] = $this->db->error();
			} else {
				$data['affected_rows'] = 0;
				$data['query_count'] = $this->db->query_count;
				$data['query_times'] = $this->db->query_times[0];
				$data['total_fields'] = $this->result->conn_id->field_count;
				$data['warnings'] = $this->result->conn_id->warning_count;
				$data['num_rows'] = $this->result->result_id->num_rows;
				$data['query_result'] = $this->result->result_array();
				$data['fields_name'] = $this->result->list_fields();
			}
		}
		
		
		if ($this->db->error()['code'] AND $this->db->error()['message']) {
			$data['total_fields'] = 0;
			$data['num_rows'] = 0;
			$data['query_error'] = $this->db->error();
		}

		return $data;
	}

	public function db_setting() {
		$this->form_validation->set_rules('hostname', 'Hostname', 'trim|required|min_length[7]|max_length[64]');
		$this->form_validation->set_rules('port', 'Port', 'trim|required|min_length[1]|max_length[6]');
		$this->form_validation->set_rules('dbname', 'Database Name', 'trim|required|min_length[3]|max_length[80]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->con_db();
		} else {
			$input = $this->input->post();
			$userId = $this->session->userdata('user_id');

			$db_exist = $this->dbutil->database_exists($input['dbname']);
			if ($db_exist === true) {
				$this->slug = $this->remote_database->saveDatabaseInfo( $input, $userId );
				$this->session->set_userdata('db_slug', $this->slug);
				$this->session->set_userdata('current_db', $input['dbname']);

				$this->session->set_flashdata("db_connected", "Database Successfully Connected.");
				redirect('/rsql/query');			
			} else {
				$this->session->set_flashdata("db_not_found", "Database not Found on server.");
				redirect('/rsql/db_setting');
			}
		}	
	}

	public function db_disconnect() {
		$this->session->unset_userdata('db_slug');
		$this->session->unset_userdata('current_db');
		$this->session->set_flashdata('disconnected_success', 'You are successfully disconnected from database.');
		redirect('/rsql/con_db');
	}

}

/* End of file rsql.php */
/* Location: ./application/controllers/rsql.php */