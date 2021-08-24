<?php

if (!isset($_SESSION)) {
    session_start();
}

class Dashboard extends Controller {

	public function index() {

		$data['title'] = 'Dashboard';
		$this->view('template/dashboard-header', $data);
		$this->view('dashboard/index');
		$this->view('template/dashboard-footer'); 
	
	}

}