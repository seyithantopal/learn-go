<?php

class Lesson extends Controller {

	public $instance;

	public function __construct() {
		parent::__construct();
		$this->instance = Load::getInstance();
		session_start();
	}

	public function Index() {
		//print_r($_SESSION['guestdata']);
		$this->load->view('lesson/lesson');
	}
}