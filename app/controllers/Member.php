<?php

if (!isset($_SESSION)) {
    session_start();
}

class Member extends Controller {

	public function index() {
        $data['title'] = 'Members';

        $result = $this->model('MemberModel')->get();

        $data['members'] = $result;

		$this->view('template/dashboard-header', $data);
		$this->view('member/index', $data);
		$this->view('template/dashboard-footer'); 
	}

    public function create() {

    }

    public function store() {
        
    }

    public function edit($id) {
        
    }

    public function update() {
        
    }

    public function delet($id) {
        
    }

}