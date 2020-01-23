<?php

class Auth extends Controller {

	public $instance;

	public function __construct() {
		parent::__construct();
		session_start();
		$this->load->model('auth');
		$this->instance = Load::getInstance();
	}

	public function Index() {
		//echo $this->instance->auth->isAvailable();
	}

	public function signup() {
		if($this->input->post('username')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$statement = $this->input->post('statement');
			$name_surname = $this->input->post('name_surname');
			$branch = $this->input->post('branch') ? $this->input->post('branch') : '';
			if($this->instance->auth->signup($username, $password, true) === false) {
				$this->instance->auth->add($name_surname, $username, $password, $statement, $branch);
				echo 'Kayıt Başarılı';
			}
			else echo 'Böyle bir kullanıcı var';
		}
	}
	public function login() {
		if($this->input->post('username') && $this->input->post('password')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result = $this->instance->auth->signup($username, $password);
			if($result === false) echo 'Böyle bir kullanıcı yok';
			else {
				if($result['statement'] == 'Öğretmen') $statement = 1; 
				else if($result['statement'] == 'Öğrenci') $statement = 0;
				$_SESSION['userdata'] = [
				'id' => $result['id'],
				'statement' => $statement,
				'branch' => $result['branch'],
				'name_surname' => $result['name_surname']
				];
				$this->instance->auth->status(true);
				echo json_encode($result);
			}
		}
	}

	public function logout() {
		$this->instance->auth->status(false);
		unset($_SESSION['userdata']);
		redirect('home');
	}
}