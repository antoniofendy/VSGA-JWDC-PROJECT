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
            <h1 class="h3 mb-0 text-gray-800 accent-font col-6"><b>User Data</b></h1>
        </div>

        <?php Flasher::flash(); ?>

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <a href="<?= BASE_URL ?>/user" class="btn btn-sm btn-outline-primary shadow-sm accent-font-t mr-2">
                            <span class="fa fa-arrow-left"></span> Back
                        </a>
                        <h3 class="accent-font-t d-inline h5 align-middle"><b>Edit User</b></h3>
                        <hr>
                        <form action="<?= BASE_URL ?>/user/update" method="post" enctype="multipart/form-data" onsubmit="return validasiForm()">
                            <input type="hidden" name="password" value="<?= $data['password']; ?>">
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" name="id" id="id" value="<?= $data['id'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="members_id">Member's ID</label>
                                    <input type="text" class="form-control" name="members_id" id="members_id" value="<?= $data['members_id']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $data['name']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" value="<?= $data['username']; ?>">
                                    <small id="username-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password">
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="retype_password">Retype Password</label>
                                    <input type="password" class="form-control" name="retype_password" id="retype_password">
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <small id="password-error" style="color: red;"></small>
                                </div>
                            </div>

                            <p class="mb-3">All input fields must be filled.</p>

                            <input type="submit" value="Update" class="btn btn-outline-success shadow-sm accent-font-t mr-2" name="submit" id>
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

<!-- Validations -->
<script src="<?= BASE_URL ?>/js/formValidation/userEditValidation.js"></script>