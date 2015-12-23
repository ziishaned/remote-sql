<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Remote_database extends CI_Model {

	/**
	 * Connects to a database and returns the database object for queries
	 * @return array The database object
	 */
	public function connectDatabase( $slug ) {

		$info = $this->getDatabaseInfo( $slug );

		$config['hostname'] = $info->hostname;
		$config['username'] = $info->db_username;
		$config['password'] = $info->db_password;
		$config['database'] = $info->db_name;
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = FALSE;

		$db = $this->load->database( $config, TRUE);

		return $db;
	}

	/**
	 * Returns the remote database information
	 * @param  string $slug The slug associated with the database
	 * @return array        An array of information for the database
	 */
	public function getDatabaseInfo( $slug ) {
		$this->db->where('slug', $slug);
		$result = $this->db->get('remote_databases');

		if ($result->num_rows() == 1) {
			return $result->row(0);
		} else {
			return FALSE;
		}
	}

	/**
	 * Saves the remote database information for reuse
	 * @return Slug The slug to be used in the URL
	 */
	public function saveDatabaseInfo( $info, $userId ) {

		// Generate a unique Id. 
		// This will be used to uniquely identify the database.
		$slug = uniqid();

		$this->db->insert('remote_databases', [
			'hostname' => $info['hostname'],
			'port' => $info['port'],
			'db_name' => $info['dbname'],
			'db_username' => $info['dbusername'],
			'db_password' => $info['dbpassword'],
			'user_id' => $userId,
			'slug' => $slug
		]);

		return $slug;
	} 

}

/* End of file Remote_database.php */
/* Location: ./application/models/Remote_database.php */