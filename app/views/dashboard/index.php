<?php $current_page = 'dashboard'; ?>

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
        <h1 class="h3 mb-0 text-gray-800 accent-font col-6"><b>Dashboard</b></h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-10 col-12">
                <div class="card shadow mb-4">
                    <div class="card-body col-12 col-md-10 col-xl-8">
                        <h3 class="h5 accent-font-t font-weight-bold">Welcome to Dashboard</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->