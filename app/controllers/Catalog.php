<?php	

if (!isset($_SESSION)) {
    session_start();
}

class Catalog extends UserController {

	public function index() {

        $data['title'] = 'Catalog';

        $result = $this->model('BookModel')->get();

        $data['book'] = $result;

		$this->view('catalog/index', $data);
	
    }

    public function search() {
        $keyword = $_POST['keyword'];

        $result = $this->model('BookModel')->search($keyword);

        $data['book'] = $result;
        $data['keyword'] = $keyword;

        $this->view('catalog/search', $data);

    }

}