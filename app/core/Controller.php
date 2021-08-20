<?php

include "../config/session_handler.php";

if (!isset($_SESSION)) {
	session_start();
}

date_default_timezone_set('Asia/Jakarta');

class Controller {

	public function __construct() {
		// If user doesn't have session and not login 
		if(!isset($_SESSION['username']) && !isset($_POST['username'])) {
			$this->view('template/login-header');
			$this->view('login/index');
			$this->view('template/login-footer');
			die();
		}

		// Session Handler
		if(!empty($_SESSION['username'])){
			$timeout = 6000;
			$elapsed = time() - $_SESSION['start'];
			if ($elapsed >= $timeout) {
				session_destroy();
				echo '<script type="text/javascript">alert("Session expired."); window.location = "' . BASE_URL . '"</script>';
			}
		}
		else{
			header('location:' . BASE_URL);
		}

	}
	
	public function view($view, $data=[]) {
		require_once '../app/views/' . $view . '.php';
	}

	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model;
	}

}