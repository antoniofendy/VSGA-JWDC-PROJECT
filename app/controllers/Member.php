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
        $data['title'] = 'Members | Create';

        $data['last_id'] = $this->getLastId();

        $this->view('template/dashboard-header', $data);
		$this->view('member/create', $data);
		$this->view('template/dashboard-footer'); 
    }

    public function store() {
        $required = array('id', 'name', 'sex', 'address');

		$error = "";

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL . '/member/create');
			die();
		}
    }

    public function edit($id) {
        
    }

    public function update() {
        
    }

    public function delete($id) {
        
    }

    private function getLastId() {
        $result = $this->model('MemberModel')->get();
        $stored_id = [];

        foreach ($result as $key => $member) {
            array_push($stored_id, substr($member['id'], -5, 5));
        }

        sort($stored_id);
        $last_id = end($stored_id);
        $last_id = intval($last_id) + 1;
        $last_id = str_pad(strval($last_id), 5, "0", STR_PAD_LEFT);

        return "AG" . $last_id;

    }

}