<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

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

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */