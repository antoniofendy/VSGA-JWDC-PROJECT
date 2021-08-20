<?php

if (!isset($_SESSION)) {
    session_start();
}

class Book extends Controller {
	
    public function index() {

        $data['title'] = 'Book';

        $result = $this->model('BookModel')->get();

        $data['book'] = $result;

		$this->view('template/dashboard-header', $data);
		$this->view('book/index', $data);
		$this->view('template/dashboard-footer'); 

    }

    public function create() {

        $data['title'] = 'Book | Create';

        $this->view('template/dashboard-header', $data);
		$this->view('book/create');
		$this->view('template/dashboard-footer'); 

    }

    public function store() {

        $required = array('isbn', 'title', 'status', 'category', 'writer', 'publisher', 'year');

		$error = false;

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL . '/book/create');
			die();
		}

        // Check Cover 
        $cover_uploaded = is_uploaded_file($_FILES['cover']['tmp_name']);
        $cover_new = "";
        $cover_temp = "";

        // Image validation
        $img_dir = "../sispus/images/books/";
        $acceptable = array(
            "png",
            "jpg",
            "jpeg"
        );
        $maxsize = 2097000;
        $cover_min_dimension = array(250, 250);

        // Check Book's cover
        if ($cover_uploaded) {
            // Get Image Dimension
            $cover_info = @getimagesize($_FILES["cover"]["tmp_name"]);
            $cover_width = $cover_info[0];
            $cover_height = $cover_info[1];
            $cover_ext = pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);

            // Check cover exists
            if (!file_exists($_FILES["cover"]["tmp_name"])) {
                Flasher::setFlash("Book's cover is not available", 'danger');
                header('location: ' . BASE_URL . '/book/create');
                die();
            }
            // Check cover extension
            else if (!in_array($cover_ext, $acceptable)) {
                Flasher::setFlash("Book's cover extension must be png/jpg/jpeg", 'danger');
                header('location: ' . BASE_URL . '/book/create');
                die();
            }
            // Check cover size
            else if (($_FILES["cover"]["size"] > $maxsize)) {
                Flasher::setFlash("Book's cover maximum size must be 2 MB", 'danger');
                header('location: ' . BASE_URL . '/book/create');
                die();
            }
            // Check cover dimension
            else if ($cover_width < $cover_min_dimension[0] || $cover_height < $cover_min_dimension[1]) {
                Flasher::setFlash("Book's cover dimension must be 250x250 px", 'danger');
                header('location: ' . BASE_URL . '/book/create');
                die();
            } else {
                $cover_new = $_POST['isbn'] . "_cover." . $cover_ext;
                $cover_temp = $_POST['isbn'] . "_cover_temp." . $cover_ext;
                move_uploaded_file($_FILES["cover"]["tmp_name"], $img_dir . $cover_temp);
                rename($img_dir . $cover_temp, $img_dir . $cover_new);
            }
        } else {
            Flasher::setFlash("Book's cover must be uploaded", 'danger');
            header('location: ' . BASE_URL . '/book/create');
            die();
        }

        $_POST['cover'] = $cover_new;

        // If Book's cover Successfully Uploaded, Add to DB
        $result = $this->model('BookModel')->save($_POST);

        if($result) {
            Flasher::setFlash("Successfuly add new book", 'success');
            header('location: ' . BASE_URL . '/book');
        }
        else {
            Flasher::setFlash("Error occured when try add new book", 'danger');
            header('location: ' . BASE_URL . '/book/create');
        }

    }

    public function edit($id) {

        $data['title'] = 'Book | Edit';

        $data['book'] = $this->model('BookModel')->find($id);

        $this->view('template/dashboard-header', $data);
		$this->view('book/edit', $data['book']);
		$this->view('template/dashboard-footer'); 

    }

    public function update() {

        

    }

    public function delete($id) {

        

    }

}