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
            <h1 class="h3 mb-0 text-gray-800 accent-font col-6"><b>Book Data</b></h1>
        </div>

        <?php Flasher::flash(); ?>

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <a href="<?= BASE_URL ?>/Book" class="btn btn-sm btn-outline-primary shadow-sm accent-font-t mr-2">
                            <span class="fa fa-arrow-left"></span> Back
                        </a>
                        <h3 class="accent-font-t d-inline h5 align-middle"><b>Edit Book</b></h3>
                        <hr>
                        <form action="<?= BASE_URL ?>/Book/update" method="post" enctype="multipart/form-data" onsubmit="return validasiForm()">
                            <div div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="cover">Book's Cover* </label>
                                    <?php
                                        if(empty($data['cover'])) {
                                            echo "<img src='" . BASE_URL . "/images/defaultbook.png' alt='' width='150px' heigth='200px' style='border-width: 1px !important;' class='border border-primary rounded d-block mb-3'>";
                                        }
                                        else {
                                            echo "<img src='" . BASE_URL . "/images/books/" . $data['cover'] . "' alt='' width='150px' heigth='200px' style='border-width: 1px !important;' class='border border-primary rounded d-block mb-3'>";
                                        }
                                    ?>
                                    <input type="file" class="form-control-file" accept="image/jpg, image/png, image/jpeg" name="cover" id="cover">
                                    <small class="form-text mt-1 mb-0 text-muted">Minimum Dimension 250x250 px.</small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" class="form-control" name="isbn" id="isbn" value="<?= $data['isbn'] ?>">
                                    <small id="isbn-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="<?= $data['title'] ?>">
                                    <small id="title-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" disabled>Select Status</option>
                                        <option value="available" <?= $data['status'] == 'available' ? "selected" : '' ?>>Available</option>
                                        <option value="unavailable" <?= $data['status'] == 'unavailable' ? "selected" : '' ?>>Unavailable</option>
                                        <small id="status-error" style="color: red;"></small>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" name="category" id="category" value="<?= $data['category'] ?>">
                                    <small id="category-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="writer">Writer</label>
                                    <input type="text" class="form-control" name="writer" id="writer" value="<?= $data['writer'] ?>">
                                    <small id="writer-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="publisher">Publisher</label>
                                    <input type="text" class="form-control" name="publisher" id="publisher" value="<?= $data['publisher'] ?>">
                                    <small id="publisher-error" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-row my-2">
                                <div class="col-12 col-lg-6 col-xl-8">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" name="year" id="year" value="<?= $data['year'] ?>">
                                    <small id="year-error" style="color: red;"></small>
                                </div>
                            </div>

                            <p class="m-0">All input fields must be filled.</p>
                            <p class="mb-3">*Picture maximum size is 2 MB.</p>

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
<script src="<?= BASE_URL ?>/js/formValidation/bookEditValidation.js"></script>