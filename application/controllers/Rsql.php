<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rsql extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->dbutil();
		$this->load->model('remote_database');
	}

	public function con_db() {
		$data['cur_page'] = 'condb';
		$this->load->view('main/header', $data);
		$this->load->view('rsql');
		$this->load->view('main/footer');
	}

	public function query($data = NULL) {

		$data['cur_page'] = 'query';
		
		if (array_key_exists('query_result', $data)) {
			$data['query_result'] = $data['query_result'];
		}

		if (array_key_exists('fields_name', $data)) {
			$data['fields_name'] = $data['fields_name'];
		}

		if (array_key_exists('num_rows', $data)) {
			$data['num_rows'] = $data['num_rows'];
		}

		if (array_key_exists('affected_rows', $data)) {
			$data['affected_rows'] = $data['affected_rows'];
		}

		if (array_key_exists('query_duration', $data)) {
			$data['query_duration'] = $data['query_duration'];
		}

		if (array_key_exists('query_count', $data)) {
			$data['query_count'] = $data['query_count'];
		}

		if (array_key_exists('query', $data)) {
			$data['query'] = $data['query'];
		}

		if (array_key_exists('query_error', $data)) {
			$data['query_error'] = $data['query_error'];
		}

		$db_slug = $this->session->userdata('db_slug');

		// Check if the user is not connected to any database
		// then redirect him to connection page.
		if ( !$db_slug ) {

			// Make sure to show a message there e.g.
			// "You have not connected any database. Please use the below form to connect."
			redirect('/rsql/con_db');
		}

		$this->load->view('main/header', $data);
		$this->load->view('query');
		$this->load->view('main/footer');	
	}

	public function run_query() {

		$this->form_validation->set_rules('query', 'Query', 'trim|required'); 

		if ($this->form_validation->run() == FALSE) { 
			$this->query();
		} else {
			$data = array();

			$slug = $this->session->userdata('db_slug');
			$query = $this->input->post('query');

			if ( !$slug ) {
				return redirect('/');
			}

			$db = $this->remote_database->connectDatabase( $slug );
			$result = $db->query( $query );

			if (strpos($query,'USE') !== false) {
				$this->session->set_flashdata("use_not_allowed", "USE query is't allowed here. If you want to connect with other database cilck here <a href='http://localhost/remote-sql-master/rsql/con_db'>Connect DB</a>.");
				redirect('/rsql/query');
			}

			if (strpos($query,'SELECT') !== false) {
				if ($db->error()['code'] AND $db->error()['message']) {
					$data['query_error'] = $db->error();
				} else {
					$data['query_result'] = $result->result_array();
					$data['fields_name'] = $result->list_fields();
					$data['num_rows'] = $result->num_rows();
				}
			}

			if (strpos($query,'INSERT') !== false OR strpos($query,'UPDATE') !== false OR strpos($query,'DELETE') !== false) {
				if ($db->error()['code'] AND $db->error()['message']) {
					$data['query_error'] = $db->error();
				} else {
					$data['affected_rows'] = $db->affected_rows();
					$data['query_duration'] = $db->query_times[0];
					$data['query_count'] = $db->query_count;
					$data['query'] = $db->queries[0];
				}
			}

			if (strpos($query,'SHOW') !== false) {
				$data['query_result'] = $result->result_array();
				$data['fields_name'] = $result->list_fields();
			}
			
			if ($db->error()['code'] AND $db->error()['message']) {
				$data['query_error'] = $db->error();
			}

			$this->query($data);

		}
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
				$slug = $this->remote_database->saveDatabaseInfo( $input, $userId );
				$this->session->set_userdata('db_slug', $slug);
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
		redirect('rsql/con_db');
	}

}

/* End of file rsql.php */
/* Location: ./application/controllers/rsql.php */