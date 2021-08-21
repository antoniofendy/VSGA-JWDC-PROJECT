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

        $data['title'] = 'Member | Create';

        $data['last_id'] = $this->getLastId();

        $this->view('template/dashboard-header', $data);
		$this->view('member/create', $data);
		$this->view('template/dashboard-footer'); 

    }

    public function store() {
        
        // Check all non-filetype input
        $required = array('id', 'name', 'sex', 'address', 'status');

		$error = false;

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL . '/member/create');
			die();
		}

        // Check Member Picture
        $picture_uploaded = is_uploaded_file($_FILES['picture']['tmp_name']);
        $picture_new = "";
        $picture_temp = "";

        // Image validation
        $img_dir = "../sispus/images/members/";
        $acceptable = array(
            "png",
            "jpg",
            "jpeg"
        );
        $maxsize = 2097000;
        $picture_min_dimension = array(250, 250);

        // Check Member Picture
        if ($picture_uploaded) {
            // Get Image Dimension
            $picture_info = @getimagesize($_FILES["picture"]["tmp_name"]);
            $picture_width = $picture_info[0];
            $picture_height = $picture_info[1];
            $picture_ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);

            // Check picture exists
            if (!file_exists($_FILES["picture"]["tmp_name"])) {
                Flasher::setFlash("Member's picture is not available", 'danger');
                header('location: ' . BASE_URL . '/member/create');
                die();
            }
            // Check picture extension
            else if (!in_array($picture_ext, $acceptable)) {
                Flasher::setFlash("Member's picture extension must be png/jpg/jpeg", 'danger');
                header('location: ' . BASE_URL . '/member/create');
                die();
            }
            // Check picture size
            else if (($_FILES["picture"]["size"] > $maxsize)) {
                Flasher::setFlash("Member's picture maximum size must be 2 MB", 'danger');
                header('location: ' . BASE_URL . '/member/create');
                die();
            }
            // Check picture dimension
            else if ($picture_width < $picture_min_dimension[0] || $picture_height < $picture_min_dimension[1]) {
                Flasher::setFlash("Member's picture dimension must be 250x250 px", 'danger');
                header('location: ' . BASE_URL . '/member/create');
                die();
            } else {
                $picture_new = $_POST['id'] . "_picture." . $picture_ext;
                $picture_temp = $_POST['id'] . "_picture_temp." . $picture_ext;
                move_uploaded_file($_FILES["picture"]["tmp_name"], $img_dir . $picture_temp);
                rename($img_dir . $picture_temp, $img_dir . $picture_new);
            }
        } else {
            Flasher::setFlash("Member's picture must be uploaded", 'danger');
            header('location: ' . BASE_URL . '/member/create');
            die();
        }

        $_POST['picture'] = $picture_new;

        // If Member's Picture Successfully Uploaded, Add to DB
        $result = $this->model('MemberModel')->save($_POST);
        $_POST['user_id'] = $this->getLastIdUser();
        $result2 = $this->model('UserModel')->save($_POST);

        if($result && $result2) {
            Flasher::setFlash("Successfuly add new member", 'success');
            header('location: ' . BASE_URL . '/member');
        }
        else {
            Flasher::setFlash("Error occured when try add new member", 'danger');
            header('location: ' . BASE_URL . '/member/create');
        }

    }

    public function edit($id) {
        
        $data['title'] = 'Member | Edit';

        $data['member'] = $this->model('MemberModel')->find($id);

        $this->view('template/dashboard-header', $data);
		$this->view('member/edit', $data['member']);
		$this->view('template/dashboard-footer'); 

    }

    public function update() {

        // Check all non-filetype input
        $required = array('name', 'sex', 'address', 'status');

		$error = false;

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL . '/member/edit/' . $_POST['id']);
			die();
		}

        // Check Member Picture
        $picture_uploaded = is_uploaded_file($_FILES['picture']['tmp_name']);
        $picture_new = "";
        $picture_temp = "";

        // Image validation
        $img_dir = "../sispus/images/members/";
        $acceptable = array(
            "png",
            "jpg",
            "jpeg"
        );
        $maxsize = 2097000;
        $picture_min_dimension = array(250, 250);

        $result = false;

        // If Picture Uploaded
        if($picture_uploaded) {
            // Get Image Dimension
            $picture_info = @getimagesize($_FILES["picture"]["tmp_name"]);
            $picture_width = $picture_info[0];
            $picture_height = $picture_info[1];
            $picture_ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);

            // Check picture exists
            if (!file_exists($_FILES["picture"]["tmp_name"])) {
                Flasher::setFlash("Member's picture is not available", 'danger');
                header('location: ' . BASE_URL . '/member/edit/' . $_POST['id']);
                die();
            }
            // Check picture extension
            else if (!in_array($picture_ext, $acceptable)) {
                Flasher::setFlash("Member's picture extension must be png/jpg/jpeg", 'danger');
                header('location: ' . BASE_URL . '/member/edit/' . $_POST['id']);
                die();
            }
            // Check picture size
            else if (($_FILES["picture"]["size"] > $maxsize)) {
                Flasher::setFlash("Member's picture maximum size must be 2 MB", 'danger');
                header('location: ' . BASE_URL . '/member/edit/' . $_POST['id']);
                die();
            }
            // Check picture dimension
            else if ($picture_width < $picture_min_dimension[0] || $picture_height < $picture_min_dimension[1]) {
                Flasher::setFlash("Member's picture dimension must be 250x250 px", 'danger');
                header('location: ' . BASE_URL . '/member/edit/' . $_POST['id']);
                die();
            } else {
                $picture_new = $_POST['id'] . "_picture." . $picture_ext;
                $picture_temp = $_POST['id'] . "_picture_temp." . $picture_ext;

                // Check If Member Has Old Image
                $old_data = $this->model('MemberModel')->find($_POST['id']);
                
                if($old_data['picture']) {
                    unlink($img_dir . $old_data['picture']);
                }

                move_uploaded_file($_FILES["picture"]["tmp_name"], $img_dir . $picture_temp);
                rename($img_dir . $picture_temp, $img_dir . $picture_new);
            }

            $_POST['picture'] = $picture_new;
            $result = $this->model('MemberModel')->update($_POST);
        }
        // If Picture Not Uploaded
        else {
            $result = $this->model('MemberModel')->update($_POST);
        }

        if($result) {
            Flasher::setFlash("Successfuly update member", 'success');
            header('location: ' . BASE_URL . '/member');
        }
        else {
            Flasher::setFlash("Error occured when try update member", 'danger');
            header('location: ' . BASE_URL . '/member/edit' . $_POST['id']);
        }
        
    }

    public function delete($id) {
    
        $result = $this->model('MemberModel')->delete($id);
        if($result) {
            
            Flasher::setFlash("Successfuly delete member", 'success');
            header('location: ' . BASE_URL . '/member');
        }
        else {
            Flasher::setFlash("Error occured when try delete member", 'danger');
            header('location: ' . BASE_URL . '/member');
        }

    }

    public function print() {
        $result = $this->model('MemberModel')->get();
        $this->view('member/print', $result);
    }

    public function printcard($id) {
        $result = $this->model('MemberModel')->find($id);
        $this->view('member/printcard', $result);
    }

    private function getLastId() {

        $result = $this->model('MemberModel')->get();
        $stored_id = [];

        foreach ($result as $key => $member) {
            array_push($stored_id, substr($member['id'], -5, 5));
        }

        sort($stored_id);
        $last_id = 1;
        foreach ($stored_id as $id) {
            if($last_id == $id) {
                $last_id++;
            }
            else {
                break;
            }
        }

        $last_id = str_pad(strval($last_id), 5, "0", STR_PAD_LEFT);

        return "AG" . $last_id;

    }

    private function getLastIdUser() {

        $result = $this->model('UserModel')->get();
        $stored_id = [];

        foreach ($result as $key => $user) {
            array_push($stored_id, substr($user['id'], -5, 5));
        }

        sort($stored_id);
        $last_id = 1;
        foreach ($stored_id as $id) {
            if($last_id == $id) {
                $last_id++;
            }
            else {
                break;
            }
        }

        $last_id = str_pad(strval($last_id), 5, "0", STR_PAD_LEFT);

        return "US" . $last_id;

    }

}