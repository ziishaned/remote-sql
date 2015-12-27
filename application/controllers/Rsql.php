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
		
		// if (array_key_exists('query_result', $data)) {
		// 	$data['query_result'] = $data['query_result'];
		// }

		// if (array_key_exists('fields_name', $data)) {
		// 	$data['fields_name'] = $data['fields_name'];
		// }

		// if (array_key_exists('num_rows', $data)) {
		// 	$data['num_rows'] = $data['num_rows'];
		// }

		// if (array_key_exists('affected_rows', $data)) {
		// 	$data['affected_rows'] = $data['affected_rows'];
		// }

		// if (array_key_exists('query_duration', $data)) {
		// 	$data['query_duration'] = $data['query_duration'];
		// }

		// if (array_key_exists('query_count', $data)) {
		// 	$data['query_count'] = $data['query_count'];
		// }

		// if (array_key_exists('query', $data)) {
		// 	$data['query'] = $data['query'];
		// }

		// if (array_key_exists('query_error', $data)) {
		// 	$data['query_error'] = $data['query_error'];
		// }

		$db_slug = $this->session->userdata('db_slug');

		// Check if the user is not connected to any database
		// then redirect him to connection page.
		if ( !$db_slug ) {

			// Make sure to show a message there e.g.
			// "You have not connected any database. Please use the below form to connect."
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

			// if ( !$this->slug ) {
			// 	return redirect('/');
			// }

			$this->query = $this->input->post('query');
			
			if (strpos($this->query,'USE') !== false) {
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

		$data = [];

		$data['query'] = $this->query;
		if (strpos(strtolower($this->query),'select') !== false) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['query_error'] = $this->db->error();
			} else {
				// var_dump($this->result);
				// die;
				$data['query_result'] = $this->result->result_array();
				$data['fields_name'] = $this->result->list_fields();
				$data['total_fields'] = $this->result->conn_id->field_count;
				$data['num_rows'] = $this->result->num_rows();
				$data['warnings'] =	$this->result->conn_id->warning_count;
			}
		}

		if (strpos($this->query,'DROP') !== false) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['query_error'] = $this->db->error();
			} else {
				$this->query = explode(" ", $this->query);
				$this->db = $this->query[2];
				if ($this->session->userdata('current_db') === $this->db) {
					$this->session->unset_userdata('db_slug');
					$this->session->unset_userdata('current_db');
					$this->session->set_flashdata('db_dropped', 'Database successfully dropped.');
					redirect('/rsql/con_db');
				} else {
					$this->session->set_flashdata('db_dropped', 'Database successfully dropped.');
					redirect('/rsql/query');
				}
			}
		}

		if (strpos($this->query,'INSERT') !== false OR strpos($this->query,'UPDATE') !== false OR strpos($this->query,'DELETE') !== false OR strpos($this->query,'ALTER') !== false) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['query_error'] = $this->db->error();
			} else {
				$data['affected_rows'] = $this->db->affected_rows();
				$data['query_duration'] = $this->db->query_times[0];
				$data['query_count'] = $this->db->query_count;
				$data['query'] = $this->db->queries[0];
			}
		}

		if (strpos($this->query,'CREATE') !== false) {
			if ($this->db->error()['code'] AND $this->db->error()['message']) {
				$data['query_error'] = $this->db->error();
			} else {
				$data['affected_rows'] = $this->db->affected_rows();
				$data['query_duration'] = $this->db->query_times[0];
				$data['query_count'] = $this->db->query_count;
				$data['query'] = $this->db->queries[0];
			}
		}

		if (strpos($this->query,'SHOW') !== false) {
			$data['query_result'] = $this->result->result_array();
			$data['fields_name'] = $result->list_fields();
		}
		
		if ($this->db->error()['code'] AND $this->db->error()['message']) {
			$data['query_error'] = $this->db->error();
		}

		return $data;
	}

	public function db_setting() {
		$this->form_validationalidation->set_rules('hostname', 'Hostname', 'trim|required|min_length[7]|max_length[64]');
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