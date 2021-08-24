<?php	

if (!isset($_SESSION)) {
    session_start();
}

class UserLogin extends UserController {

	public function index() {
        $data['title'] = "User Login";
		$this->view('template/login-header', $data);
		$this->view('catalog/login');
		$this->view('template/login-footer');
	}
	
	public function login_handler() { 

		$required = array('catalog_username', 'catalog_password');

		$error = "";

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL. '/Catalog');
			die();
		}
		
		$hashed_password = md5($_POST['catalog_password']);
		$data = [
			"username" => $_POST['catalog_username'],
			"password" => $hashed_password
		];

		$username = $_POST['catalog_username'];
		$password = $_POST['catalog_password'];
		$remember = isset($_POST['remember']) ? $_POST['remember'] : '';

		$result = $this->model('UserModel')->findAccount($data);

		if ($result) {
			$_SESSION['catalog_userid'] = $result['id'];
			$_SESSION['catalog_username'] = $result['username'];
			$_SESSION['catalog_start'] = time();
		
			if ($remember) {
				setcookie('caUsername', $username, time() + 7200, '/', NULL);
				setcookie('caPassword', $password, time() + 7200, "/", NULL);
				setcookie('caRemember', $password, time() + 7200, "/", NULL);
			} else {
				setcookie('caUsername', null, -1, "/", null);
				setcookie('caPassword', null, -1, "/", null);
				setcookie('caRemember', null, -1, "/", null);
			}
			
			header('location:' . BASE_URL . '/Catalog');
		} else {
			Flasher::setFlash('Invalid username or password', 'danger');
			header('location:' . BASE_URL. '/Catalog');
		}

	}

	public function logout_handler() {
		
		// session_destroy();
		unset($_SESSION['catalog_username']);
		unset($_SESSION['catalog_userid']);
		unset($_SESSION['catalog_start']);

		
		header('location:' . BASE_URL . '/Catalog');
	}

}