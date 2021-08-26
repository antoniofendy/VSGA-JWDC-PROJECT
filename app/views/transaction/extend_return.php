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
                    <div class="table-responsive">
                            <table class="table table-bordered" id="transactionTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Book</th>
                                        <th>Borrow Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Book</th>
                                        <th>Borrow Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php

                                        foreach ($data['transaction'] as $key => $transaction) {

                                    ?><tr>
                                            <td class="align-middle"><?= $transaction['trans_id'] ?></td>
                                            <td class="align-middle"><?= $transaction['name'] ?></td>
                                            <td class="align-middle" width="30%"><?= $transaction['title'] ?></td>
                                            <td class="align-middle"><?= $transaction['borrow_date'] ?></td>
                                            <td class="align-middle"><?= $transaction['due_date'] ?></td>
                                            <td class="text-center align-middle">
                                                <?php
                                                    if(date('Y-m-d') > $transaction['due_date']) {
                                                        echo "Over time";
                                                    }
                                                    else {
                                                        if($transaction['return_date'] == "0000-00-00") {
                                                            echo "Borrowed";
                                                        }
                                                        else {
                                                            echo "Returned";
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center align-middle" width="20%">
                                                <?php
                                                    if(date('Y-m-d') <= $transaction['due_date'] && $transaction['extend_count'] == 0) {
                                                        echo "<a href='" . BASE_URL  ."/Transaction/extend_trans/" . $transaction['trans_id'] ."' class='btn btn-small btn-secondary'> Extend</a>";
                                                    }
                                                ?>
                                                <a href="<?= BASE_URL ?>/Transaction/return_trans/<?= $transaction['trans_id'] ?>" class="btn btn-small btn-info"> Return</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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

<link href="<?= BASE_URL; ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="<?= BASE_URL; ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL; ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {

        // Filling dataTable
        $('#transactionTable').DataTable({
        "order": [0, 'asc'],
        // "columns": [{
        //         "width": "30px"
        //     },
        //     {
        //         "width": "50px",
        //         "orderable": true
        //     },
        //     {
        //         "width": "50px",
        //         "orderable": true
        //     },
        //     {
        //         "searchable": true,
        //         "width": "60px",
        //         "orderable": true
        //     }
        // ],
        language: {
            emptyTable: "Tidak ada data yang dapat ditampilkan"
        }
        });
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

</script>