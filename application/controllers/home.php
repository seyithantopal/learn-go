<?php

class Home extends Controller {

	public $instance;

	public function __construct() {
		parent::__construct();
		$this->instance = Load::getInstance();
		session_start();
	}

	public function Index() {
		if(isset($_SESSION['userdata'])) {
			if($_SESSION['userdata']['statement'] == 1) $this->load->view('lesson/teacher');
			else if($_SESSION['userdata']['statement'] == 0) $this->load->view('lesson/student');
		} else $this->load->view('welcome/index');
	}

	public function setSession() {
		if(isset($_POST['id'])) {
			$_SESSION['guestdata'] = ['id' => $this->input->post('id')];
		}
		else echo 'POST edilmedi';
	}

	public function aboutUs() {
		$this->load->view('about');
	}

	public function comingSoon() {
		$this->load->view('coming-soon/coming-soon', '', true);
	}
}