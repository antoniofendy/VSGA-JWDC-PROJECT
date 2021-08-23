<?php	

if (!isset($_SESSION)) {
    session_start();
}

class User extends Controller {

	public function index() {

        $data['title'] = 'User';

        $result = $this->model('UserModel')->get();

        $data['user'] = $result;

		$this->view('template/dashboard-header', $data);
		$this->view('user/index', $data);
		$this->view('template/dashboard-footer');
	
    }

    public function edit($id) {
        
        $data['title'] = 'User | Edit';

        $data['user'] = $this->model('UserModel')->find($id);

        $data['username_temp'] = $this->model('UserModel')->getAllUsername();
        $data['username'] = [];

        foreach ($data['username_temp'] as $user) {
            array_push($data['username'], $user['username']);
        }

        unset($data['username_temp']);

        $this->view('template/dashboard-header', $data);
		$this->view('user/edit', $data);
		$this->view('template/dashboard-footer');
	
    }

    public function update() {
        
        // Check all non-filetype input
        $required = array('id', 'members_id', 'name', 'username');

		$error = false;

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL . '/User/edit/' . $_POST['id']);
			die();
		}
        
        if(empty($_POST['new_password'])) {
            unset($_POST['new_password']);
            unset($_POST['retype_password']);
        }
        else{
            $_POST['password'] = md5($_POST['new_password']);
            unset($_POST['new_password']);
            unset($_POST['retype_password']);
        }

        $result = $this->model('UserModel')->update($_POST);

        if($result) {
            Flasher::setFlash("Successfuly update user", 'success');
            header('location: ' . BASE_URL . '/User');
        }
        else {
            Flasher::setFlash("Error occured when try update user", 'danger');
            header('location: ' . BASE_URL . '/User/edit' . $_POST['id']);
        }
	
    }

}