<?php	

if (!isset($_SESSION)) {
    session_start();
}

class Catalog extends UserController {

	public function index() {

        $data['title'] = 'Catalog';

        $result = $this->model('BookModel')->search('', '1');

        $data['book'] = $result;

		$this->view('catalog/index', $data);
	
    }

    public function search($page) {
        if(isset($_POST['keyword'])) {
            $_SESSION['keyword'] = $_POST['keyword'];
        }

        $result = $this->model('BookModel')->search($_SESSION['keyword'], $page);
        $total_page = $this->model('BookModel')->allRecord($_SESSION['keyword']);

        $data['book'] = $result;
        $data['total_page'] = $total_page;
        $data['keyword'] = $_SESSION['keyword'];
        $data['page'] = $page;

        $this->view('catalog/search', $data);

    }

}