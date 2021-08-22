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
            <h1 class="h3 mb-0 text-gray-800 accent-font col-6"><b>Member Data</b></h1>
        </div>

        <?php Flasher::flash(); ?>

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="memberTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Status</th>
                                        <th>Picture</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Status</th>
                                        <th>Picture</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php

                                        foreach ($data['members'] as $key => $member) {

                                    ?><tr>
                                            <td class="align-middle"><?= $member['id'] ?></td>
                                            <td class="align-middle"><?= $member['name'] ?></td>
                                            <td class="align-middle" style="text-transform: capitalize;"><?= $member['sex'] ?></td>
                                            <td class="align-middle"><?= $member['status'] == 'not_borrowing' ? 'Not Borrowing' : 'Is Borrowing' ?></td>
                                            <td class="text-center align-middle">
                                                <?php
                                                    if(empty($member['picture'])) {
                                                        echo "<img src='" . BASE_URL . "/images/defaultuser.jpg' alt='' width='50px' heigth='50px' style='border-width: 2px !important;' class='border border-primary rounded-circle'>";
                                                    }
                                                    else {
                                                        echo "<img src='" . BASE_URL . "/images/members/" . $member['picture'] . "' alt='' width='50px' heigth='50px' style='border-width: 2px !important;' class='border border-primary rounded-circle'>";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center align-middle">
                                            <a href="<?= BASE_URL ?>/Member/printcard/<?= $member['id'] ?>" class="btn btn-small"><i class="fas fa-print"></i></a>
                                                <a href="<?= BASE_URL ?>/Member/edit/<?= $member['id'] ?>" class="btn btn-small"><i class="fas fa-pen"></i></a>
                                                <a onclick="deleteConfirm('<?= BASE_URL ?>/Member/delete/<?= $member['id'] ?>')" href="#" class="btn btn-small text-danger"><i class="fas fa-trash"></i></a>
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
        $('#memberTable').DataTable({
        "order": [0, 'asc'],
        // "columns": [{
        //     "width": "30px"
        //     },
        //     {
        //     "width": "300px",
        //     "orderable": true
        //     },
        //     {
        //     "width": "150px",
        //     "orderable": true
        //     },
        //     {
        //     "searchable": false,
        //     "width": "60px",
        //     "orderable": true
        //     },
        // ],
        language: {
            emptyTable: "Tidak ada data yang dapat ditampilkan"
        },
        "dom": "<'row'<'col-12 col-md-2 p-0 mb-2 mb-md-0 text-md-left text-center'<'#newBtn.btn btn-sm btn-primary shadow-sm p-0'><'#printBtn.btn ml-3 btn-sm btn-info shadow-sm p-0'>><'col-12 col-md-10 text-right d-inline-block'f>>t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });

        $('<a href="<?= BASE_URL ?>/Member/create" class="btn btn-sm btn-primary shadow-sm accent-font-t"><i id="newBtnText" class="fas fa-plus fa-sm text-white-50"></i> New</a>').appendTo('#newBtn');
        $('<a href="<?= BASE_URL ?>/Member/print" class="btn btn-sm btn-info shadow-sm accent-font-t"><i id="newBtnText" class="fas fa-print fa-sm text-white-50"></i> Print</a>').appendTo('#printBtn');
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

</script>