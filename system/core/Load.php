<?php

class Load {
	
	public static $instance;
	
	public function __construct() {
		self::$instance = $this;
	}

	public static function getInstance() {
		if(self::$instance == null) self::$instance = new self();
		return self::$instance;
	}

	public function view($viewName, $params = null, $main = false) {
		$viewPath = APP_DIR . 'views/' . $viewName . '.php';
		if($params != null) extract($params, EXTR_PREFIX_SAME, "wddx");
		$viewData = $params;
		if(file_exists($viewPath)) {
			if(!$main) require APP_DIR . 'views/main.php';
			else require $viewPath;
		} else {
			require APP_DIR . 'controllers/err.php';
			$error = new Err('View file doesn\'t exists: ' . ucfirst($viewName));
			exit();
		}
	}

	public function model($modelName, $customModelName = null) {

		$modelPath = APP_DIR . 'models/' . $modelName . '.php';
		if(file_exists($modelPath)) {
			require $modelPath;
			$modelObject = $modelName . '_Model';
			if($customModelName == null) $this->$modelName = new $modelObject();
			else $this->$customModelName = new $modelObject();
		} else {
			require APP_DIR . 'controllers/err.php';
			$error = new Err('Model file doesn\'t exists: ' . ucfirst($modelName));
			exit();
		}
	}
}