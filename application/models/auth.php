<?php

class Auth_Model extends Model {

	public function __construct() {
		parent::__construct();
	}

	public function add($name_surname, $username, $password, $statement, $branch) {
		$datas = [
			'name_surname' => $name_surname,
			'username' => $username,
			'password' => $password,
			'statement' => $statement,
			'branch' => $branch,
			'isAvailable' => 0
		];
		$this->db->insert('users', $datas);		
	}
	public function signup($username, $password, $control = false) {
		if($control == false) return $this->db->where(['username' => $username, 'password' => $password])->row('users');
		else if($control == true) return $this->db->where(['username' => $username])->row('users');
	}

	public function status($flag) {
		if($flag == true) $this->db->where(['id' => $_SESSION['userdata']['id']])->update('users', ['status' => 1, 'isAvailable' => 1]);
		else if($flag == false) $this->db->where(['id' => $_SESSION['userdata']['id']])->update('users', ['status' => 0]);
	}

	/*public function aa() {
		return $_SESSION['userdata']['id'];
	}*/
}