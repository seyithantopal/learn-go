<?php

class Session {

	public function __construct() {
		$this->init();
	}

	public function init() {
		if(!isset($_SESSION)) session_start();
	}

	public function set($key, $value) {
		if(is_array($value)) {
			foreach($value as $col => $val) {
				$_SESSION[$col] = $val;
			}
		} else {
			$_SESSION[$key] = $value;
		}
	}

	public function get($key) {
		if(is_null($key)) return $_SESSION;
		else return $_SESSION[$key];
	}

	public function is_exists($key) {
		return isset($_SESSION[$key]);
	}
	public function delete($key) {
		unset($_SESSION[$key]);
	}

	public function destroy() {
		session_destroy();
	}
}