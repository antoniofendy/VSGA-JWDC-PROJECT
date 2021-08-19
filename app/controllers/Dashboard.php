<?php

if (!isset($_SESSION)) {
    session_start();
}

class Dashboard extends Controller {

	public function index() {

		if(isset($_SESSION['username'])) {
			$data['title'] = 'Dashboard';
			$this->view('template/dashboard-header', $data);
			$this->view('dashboard/index');
			$this->view('template/dashboard-footer'); 
		}
		// Redirect to Login
		else {
			$this->view('template/login-header');
			$this->view('login/index');
			$this->view('template/login-footer');
		}
	
	}

}