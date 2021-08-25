<?php	

if (!isset($_SESSION)) {
    session_start();
}

class Transaction extends Controller {

	public function index() {

        $data['title'] = 'Transaction';

        $data['transaction'] = $this->model('TransactionModel')->get();

		$this->view('template/dashboard-header', $data);
		$this->view('transaction/borrow', $data);
		$this->view('template/dashboard-footer');
	
    }

    public function create() {

        $data['title'] = 'Transaction | Create';

        $data['trans_id'] = $this->getLastTransactionId();

        $data['available_books'] = $this->model('BookModel')->getTransactionable(); 
        $data['available_members'] = $this->model('MemberModel')->getTransactionable(); 

        $this->view('template/dashboard-header', $data);
		$this->view('transaction/create', $data);
		$this->view('template/dashboard-footer'); 

    }

    public function store() {
        
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
        
    }


    public function edit($id) {
        
        $data['title'] = 'Transaction | Edit';

        $this->view('template/dashboard-header', $data);
		$this->view('transaction/edit', $data);
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
        
    }

    public function delete($id) {
        
        $data['title'] = 'Transaction';

        $this->view('template/dashboard-header', $data);
		$this->view('transaction/index');
		$this->view('template/dashboard-footer');
	
    }

    private function getLastTransactionId() {

            $result = $this->model('TransactionModel')->getAllTransaction();
            $stored_id = [];
    
            foreach ($result as $key => $user) {
                // TR00000001
                array_push($stored_id, substr($user['trans_id'], -8, 8));
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
    
            $last_id = str_pad(strval($last_id), 8, "0", STR_PAD_LEFT);
    
            return "TR" . $last_id;
    
    }

}