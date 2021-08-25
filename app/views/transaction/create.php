<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php include "../app/views/template/dashboard-sidebar.php"; ?>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Topbar -->
    <?php include "../app/views/template/dashboard-navbar.php"; ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
            <h1 class="h3 mb-0 text-gray-800 accent-font col-6"><b>Transaction Data</b></h1>
        </div>

        <?php Flasher::flash(); ?>

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <a href="<?= BASE_URL ?>/Transaction" class="btn btn-sm btn-outline-primary shadow-sm accent-font-t mr-2">
                            <span class="fa fa-arrow-left"></span> Back
                        </a>
                        <h3 class="accent-font-t d-inline h5 align-middle"><b>New Transaction</b></h3>
                        <hr>
                        <form action="<?= BASE_URL ?>/Transaction/store" method="post" enctype="multipart/form-data" id="form-body" onsubmit="return validasiForm()">
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="trans_id">Transaction's ID</label>
                                    <input type="text" class="form-control" name="trans_id" id="trans_id" value="<?= $data['trans_id'] ?>" readonly>
                                    <small id="trans_id-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <div class="row d-flex align-items-end">
                                        <div class="col">
                                            <label for="member">Member's ID</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="member" id="member" value="">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" id="verify-member">Verify</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="member_name" id="member-name" readonly>
                                        </div>
                                    </div>
                                    <small id="member-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8 mb-1">
                                    <div class="row d-flex align-items-end">
                                        <div class="col">
                                            <label for="book">Book's ISBN</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="book" id="book" value="">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" id="verify-book">Verify</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="book_name" id="book-name" value="" readonly>
                                        </div>
                                    </div>
                                    <small id="book-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="borrow">Borrow Date</label>
                                    <input type="date" class="form-control" name="borrow" id="borrow" value="">
                                    <small id="borrow-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="due">Due Date</label>
                                    <input type="date" class="form-control" name="due" id="due" value="" readonly>
                                    <small id="due-error" style="color: red;"></small>
                                </div>
                            </div>

                            <input type="submit" value="Save" class="btn btn-outline-success mt-3 shadow-sm accent-font-t mr-2" name="submit" id>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<script>
    <?php
        $booksArray = $data['available_books'];
        $membersArray = $data['available_members'];
    ?>

    let books = <?php echo json_encode($booksArray); ?>;
    let members = <?php echo json_encode($membersArray); ?>;

    let member_verify = document.getElementById('verify-member');
    let member_input = document.getElementById('member');
    let member_name = document.getElementById('member-name');
    
    let book_verify = document.getElementById('verify-book');
    let book_input = document.getElementById('book');
    let book_name = document.getElementById('book-name');

    // Validate Member
    member_verify.addEventListener('click', () => {

        let lastElement = members[members.length - 1];

        for(let i = 0; i < members.length; i++) {
            if(member_input.value == members[i].id) {
                member_name.value = members[i].name;
                break;
            }
            else {
                if(members[i].id == lastElement.id) {
                    member_name.value = "Member not found";
                    member_input.value = "";
                    break;
                }
            }
        }
    
    });

    // Validate Book
    book_verify.addEventListener('click', () => {

        let lastElement = books[books.length - 1];

        for(let i = 0; i < books.length; i++) {
            if(book_input.value == books[i].isbn) {
                book_name.value = books[i].title;
                break;
            }
            else {
                if(books[i].isbn == lastElement.isbn) {
                    book_name.value = "Book not found";
                    book_input.value = "";
                    break;
                }
            }
        }

    });

    // Autofill Due Date
    
    let borrow_date = document.getElementById('borrow');
    let due_date = document.getElementById('due');

    borrow_date.addEventListener('input', () => {
        let date1 = new Date(borrow_date.value);

        // 7 (days) * 24 (hours) * 60 (minutes) * 60 (seconds) * 1000 (milliseconds ) = 604800000 or 7 days in milliseconds.
        let due = new Date(date1.getTime() + (7 * 24 * 60 * 60 * 1000));

        let month = due.getMonth()+1;
        let days = due.getDate();

        if(String(month).length == 1) {
            month = `0${due.getMonth()+1}`;
        }

        if(String(due.getDate()).length == 1) {
            days = `0${due.getDate()}`;
        }

        due_date.value = `${due.getFullYear()}-${month}-${days}`;
    });

</script>

<script src="<?= BASE_URL ?>/js/formValidation/TransactionInputValidation.js"></script>





