<?php

if (!isset($_SESSION)) {
    session_start();
}

class Book extends Controller {
	
    public function index() {

        $data['title'] = 'Book';

        $result = $this->model('BookModel')->get();

        die(var_dump($result));

        $data['book'] = $result;

		$this->view('template/dashboard-header', $data);
		$this->view('book/index', $data);
		$this->view('template/dashboard-footer'); 

    }

    public function create() {

        

    }

    public function store() {

        

    }

    public function edit() {

        

    }

    public function update() {

        

    }

    public function delete() {

        

    }

}