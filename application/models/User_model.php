<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function update_security($user_id, $username, $password) {
		$data = array(
           'username' => $username,
           'password' => $password
        );

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);

		return true;
	}

	public function validate_user($username, $password)	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$result = $this->db->get('users');
		if ($result->num_rows() == 1) {
			return $result->row(0)->id;
		} else {
			return FALSE;
		}
	}

	public function getUserInfo($user_id) {
		$this->db->where('id', $user_id);
		$result = $this->db->get('users');
		if ($result->num_rows() == 1) {
			return $result->row(0);
		} else {
			return FALSE;
		}	
	}

	public function register_user($username, $password, $email) {
		$data = array(
			'id' => '',
           	'username' => $username,
           	'password' => $password,
           	'email' => $email
        );

		$this->db->insert('users', $data);
		return true;
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */