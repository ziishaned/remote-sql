<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('user_model');
	}

	public function register_user() {
		if (isset($_POST['data'])) {
			$username = $_POST['data']['username'];
			$password = $_POST['data']['password'];
			$email = $_POST['data']['email'];

			$result = $this->user_model->register_user($username, $password, $email);
			echo json_encode($result);
		} else {
			redirect('user/register');
		}
	}

	public function change_security() {
		if (isset($_POST['data'])) {
			$username = $_POST['data']['username'];
			$password = $_POST['data']['password'];
			$user_id = $this->session->userdata('user_id');

			$result = $this->user_model->update_security($user_id, $username, $password);

			echo json_encode($result);

		} else {
			redirect('user/dashboard');
		}
	}

	public function login() {
		if($this->session->userdata('logged_in') === TRUE) {
			$data['cur_page'] = 'home';
			redirect('user/dashboard');
		} else {
			$data['cur_page'] = '';
			$this->load->view('main/header');
			$this->load->view('login', $data);
			$this->load->view('main/footer');
		} 

	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('user/login');
	}

	public function register() {
		if($this->session->userdata('logged_in') === TRUE) { 
			$data['cur_page'] = 'home';
			redirect('user/dashboard');
		} else {
			$data['cur_page'] = 'home';
			$this->load->view('main/header', $data);
			$this->load->view('register');
			$this->load->view('main/footer');
		}
	}

	public function dashboard() {
		if($this->session->userdata('logged_in') === TRUE) {
			$data['cur_page'] = 'home';
			$this->load->view('main/header', $data);
			$this->load->view('dashboard');
			$this->load->view('main/footer');
		} else {
			redirect('user/login');
		}
	}

	public function profile() {
		if($this->session->userdata('logged_in') === TRUE) { 

			$user_id = $this->session->userdata('user_id');
			$result = $this->user_model->getUserInfo($user_id);

			$data['user_data'] = $result;
			$data['cur_page'] = 'profile';

			$this->load->view('main/header', $data);
			$this->load->view('profile');
			$this->load->view('main/footer');	
		} else {
			redirect('user/login');
		}
	}

	public function activity() {
		if($this->session->userdata('logged_in') === TRUE) {
			$data['cur_page'] = 'activity';
			$this->load->view('main/header', $data);
			$this->load->view('activity');
			$this->load->view('main/footer');
		} else {
			redirect('user/login');	
		}
	}

	public function login_user() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[12]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[12]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->login();
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('user_model');
			$user_id = $this->user_model->validate_user($username, $password);
			if ($user_id) {
				$array = array(
					'logged_in' => TRUE,
					'user_id' => $user_id
				);
				$this->session->set_userdata( $array );
				redirect('rsql/con_db');
			} else {
				$this->session->set_flashdata('login_failed', 'Please check username and password.');
				$this->login();
			}
		}
	}
}
