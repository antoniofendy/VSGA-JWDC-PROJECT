<?php	

if (!isset($_SESSION)) {
    session_start();
}

class Login extends Controller {
	
	public function login_handler() { 

		$required = array('username', 'password');

		$error = "";

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL);
			die();
		}
		
		$hashed_password = md5($_POST['password']);
		$data = [
			"username" => $_POST['username'],
			"password" => $hashed_password
		];

		$result = $this->model('LoginModel')->find($data);

		if ($result) {
			$_SESSION['userid'] = $result['id'];
			$_SESSION['username'] = $result['username'];
			$_SESSION['start'] = time();
		
			if ($remember) {
				setcookie('cUsername', $username, time() + 7200, '/', NULL);
				setcookie('cPassword', $password, time() + 7200, "/", NULL);
				setcookie('cRemember', $password, time() + 7200, "/", NULL);
			} else {
				setcookie('cUsername', null, -1, "/", null);
				setcookie('cPassword', null, -1, "/", null);
				setcookie('cRemember', null, -1, "/", null);
			}
			
			header('location:' . BASE_URL . '/Dashboard');
		} else {
			Flasher::setFlash('Invalid username or password', 'danger');
			header('location:' . BASE_URL);
		}

	}

	public function logout_handler() {
		if (!isset($_SESSION)) {
			session_start();
		}
		
		session_destroy();
		
		header('location:' . BASE_URL);
	}

}