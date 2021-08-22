<?php

// include "../config/session_handler.php";

if (!isset($_SESSION)) {
	session_start();
}

date_default_timezone_set('Asia/Jakarta');

class UserController {

	public function __construct() {
		// If user doesn't have session and not login 
		if(!isset($_SESSION['catalog_username']) && !isset($_POST['catalog_username'])) {
			$data['title'] = "User Login";
			$this->view('template/login-header', $data);
			$this->view('catalog/login');
			$this->view('template/login-footer');
			die();
		}

		// Session Handler
		if(!empty($_SESSION['catalog_username'])){
			$timeout = 6000;
			$elapsed = time() - $_SESSION['catalog_start'];
			if ($elapsed >= $timeout) {
				session_destroy();
				echo '<script type="text/javascript">alert("Session expired."); window.location = "' . BASE_URL . '/Catalog"</script>';
			}
		}
		else {
			header('location:' . BASE_URL . '/Catalog');
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