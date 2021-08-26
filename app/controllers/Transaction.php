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
        $required = array('trans_id', 'member', 'book', 'borrow', 'due');

		$error = false;

		foreach ($required as $field) {
			if (empty($_POST[$field])) $error = true;
		}

		if ($error) {
			Flasher::setFlash('Please fill all of the input form', 'danger');
			header('location: ' . BASE_URL . '/Transaction/create/');
			die();
		}

        $result = $this->model('TransactionModel')->save($_POST);

        // If success, then update member and book status
        if($result) {
            
            try {
                $update_member = $this->model('MemberModel')->updateStatus($_POST['member'], "is_borrowing");
                $update_book = $this->model('BookModel')->updateStatus($_POST['book'], "unavailable");
            }
            catch (Exception $err) {
                Flasher::setFlash('Error occured when add new transaction', 'danger');
                header('location: ' . BASE_URL . '/Transaction/create/');
                die();
            }

            Flasher::setFlash("Successfuly add new transaction", 'success');
            header('location: ' . BASE_URL . '/Transaction');

        }
        
    }


    public function extend_return() {
        
        $data['title'] = 'Transaction | Extend and Return';

        $data['transaction'] = $this->model('TransactionModel')->getReturnAble();

        $this->view('template/dashboard-header', $data);
		$this->view('transaction/extend_return', $data);
		$this->view('template/dashboard-footer');
	
    }

    public function extend_trans($trans_id) {
        
        $data = $this->model('TransactionModel')->find($trans_id);

        $due_date = strtotime($data['due_date']);
        $data['due_date'] = date('Y-m-d', strtotime("+7 day", $due_date));

        $result = $this->model('TransactionModel')->extend_transaction($data);

        if($result) {
            Flasher::setFlash("Successfuly processing an extend transaction", 'success');
            header('location: ' . BASE_URL . '/Transaction/extend_return');
        }
        else {
            Flasher::setFlash("Error occured when processing an extend transaction", 'danger');
            header('location: ' . BASE_URL . '/Transaction/extend_return');
        }
	
    }

    public function return_trans($trans_id) {
        
        $data = $this->model('TransactionModel')->find($trans_id);
        $data['return_date'] = date('Y-m-d');
        
        $result = $this->model('TransactionModel')->return_transaction($data);

        if($result) {
            try {
                $update_member = $this->model('MemberModel')->updateStatus($data['members_id'], "not_borrowing");
                $update_book = $this->model('BookModel')->updateStatus($data['books_isbn'], "available");
            }
            catch (Exception $err) {
                Flasher::setFlash('Error occured when processing a return transaction', 'danger');
                header('location: ' . BASE_URL . '/Transaction/extend_return');
                die();
            }
            Flasher::setFlash("Successfuly processing a return transaction", 'success');
            header('location: ' . BASE_URL . '/Transaction/extend_return');
        }
        else {
            Flasher::setFlash("Error occured when processing a return transaction", 'danger');
            header('location: ' . BASE_URL . '/Transaction/extend_return');
        }

    }

    public function delete($trans_id) {
        
        $find_data = $this->model('TransactionModel')->find($trans_id);

        $result = $this->model('TransactionModel')->delete($trans_id);

        // If success, then update member and book status
        if($result) {
            
            try {
                $update_member = $this->model('MemberModel')->updateStatus($find_data['members_id'], "not_borrowing");
                $update_book = $this->model('BookModel')->updateStatus($find_data['books_isbn'], "available");
            }
            catch (Exception $err) {
                Flasher::setFlash('Error occured when delete a transaction', 'danger');
                header('location: ' . BASE_URL . '/Transaction');
                die();
            }

            Flasher::setFlash("Successfuly delete a transaction", 'success');
            header('location: ' . BASE_URL . '/Transaction');

        }
	
    }

    public function print($trans_id) {

        $data = $this->model('TransactionModel')->findJoinedTable($trans_id);

		$this->view('transaction/print_note', $data);

    }

    public function print_report() {

        $data = $this->model('TransactionModel')->get();

		$this->view('transaction/print_report', $data);

    }

    private function getLastTransactionId() {

            $result = $this->model('TransactionModel')->getAllTransaction();
            $stored_id = [];
    
            foreach ($result as $key => $user) {
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