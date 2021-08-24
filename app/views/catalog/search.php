<?php
    if(!isset($_SESSION)){
        session_start();
    }

    // include "./ajax/cari.php";
?>

<!-- Include Header -->
<?php 
    include "../app/views/template/catalog_header.php";
?>

<body>

    <style>

        #konten {
            padding-left: 100px;
            padding-right: 100px;
        }

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            a.btn {
                width: 100%;
            }

            .book-list {
                width: 100%;
            }

            #konten {
                padding-left: 0;
                padding-right: 0;
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            a.btn {
                width: 100%;
            }

            .book-list {
                width: 700px;
            }
        } 

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            .book-list { 
                width: 900px;
            }
        }
        
    </style>

    <!-- Include Navbar -->
    <?php
        include "../app/views/template/catalog_navbar.php";
    ?>
    
    <div class="jumbotron text-white text-center" style="padding-top:100px">
        <h1 class="display-4">Welcome to GoLibrary</h1>
        <p class="lead">E-Library platform that you can access anytime and anywhere</p>
        <hr class="my-4">
        <form class="form-inline my-2 my-lg-0 d-flex justify-content-center" autocomplete="off" method="post" action="<?= BASE_URL ?>/Catalog/search">
            <input class="form-control" style="width: 50%" name="keyword" type="text" placeholder="Find Book" aria-label="Search" id="keyword" value="<?= isset($data['keyword']) ? $data['keyword'] : '' ?>">
            <button class="btn btn-success mx-2 my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <div class="container pt-5">
        <div class="row d-flex justify-content-center flex-column" id="konten">
            <div class="col-12 mb-4 text-center">
                <h1>Search Results for <span style="color: #007bff;">"<?= $data['keyword']?>"</span></h1>
            </div>
            <?php if(!empty($data['book'])) { ?>
                <ul class="list-group d-flex justify-content-center p-3">
                <?php
                    foreach($data['book'] as $key => $book) {
                ?>
                    <li class="list-group-item">
                        <div class="row book-list">
                            <div class="col-sm-0 col-md-2 d-flex justify-content-center">
                                <img class="img-katalog" src="<?= BASE_URL ?>/images/books/<?= $book['cover'] ?>" alt="" srcset="">
                            </div>
                            <div class="col-sm-12 col-md-10" style="width: 100%;">
                                <h4><?= $book['title']; ?></h4>
                                <p style="color:#9788a7;"><?= $book['publisher']; ?></p>
                                <?php
                                    $writers = explode(",", $book['writer']);
                                    foreach($writers as $writer) {
                                        echo "
                                            <span class='badge badge-info'>$writer</span>
                                        ";
                                    }
                                ?>
                                <div class="addition mt-3 text-right d-flex flex-row justify-content-end">
                                    <div class="year mr-3">
                                        <p><span style="color:#9788a7;">Year:</span> <?= $book['year']; ?></p>
                                    </div>
                                    <div class="language mr-3">
                                        <p style="text-transform: capitalize;"><span style="color:#9788a7;">Status:</span> <?= $book['status']; ?></p>
                                    </div>
                                    <div class="category">
                                        <p><span style="color:#9788a7;">Category:</span> <?= $book['category']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
            <?php
                    }
                echo "</ul>";
                }
                else {
                    echo "<h3 class='text-center'><span class='badge badge-warning'>No result found</span></h3>";
                }
            ?>
            
        </div>
    </div>
    

    <!-- Include Footer -->
    <?php 
        include "../app/views/template/catalog_footer.php"; 
    ?>
    
    <script src="<?= BASE_URL ?>/js/script.js"></script>

</body>
</html>

