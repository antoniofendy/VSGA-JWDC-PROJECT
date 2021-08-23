<?php

// include "../config/session_handler.php";

if (!isset($_SESSION)) {
	session_start();
}

date_default_timezone_set('Asia/Jakarta');

class Controller {

	public function __construct() {
		// If user doesn't have session and not login 
		if(!isset($_SESSION['username']) && !isset($_POST['username'])) {
			$data['title'] = "Administrator Login";
			$this->view('template/login-header', $data);
			$this->view('login/index');
			$this->view('template/login-footer');
			die();
		}

		// Session Handler
		if(!empty($_SESSION['username'])){
			$timeout = 6000;
			$elapsed = time() - $_SESSION['start'];
			if ($elapsed >= $timeout) {
				unset($_SESSION['username']);
				unset($_SESSION['userid']);
				unset($_SESSION['start']);
				echo '<script type="text/javascript">alert("Session expired."); window.location = "' . BASE_URL . '/Admin"</script>';
			}
		}
		else{
			header('location:' . BASE_URL . '/Admin');
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