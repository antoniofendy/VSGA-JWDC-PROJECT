<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print | All Members</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div id="back-button">

    </div>
    <h1 class="text-center mb-5">Members Data</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Address</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center">Picture</th>
            </tr>
        </thead>
        <tbody>
    
        <?php 
            $iteration = 1;

            foreach ($data as $key => $member) {
        ?>
                <tr>
                    <th scope="row" class="align-middle"><?= $iteration ?></th>
                    <td class="align-middle"><?= $member['id'] ?></td>
                    <td class="align-middle"><?= $member['name'] ?></td>
                    <td class="align-middle" style="text-transform: capitalize;"><?= $member['sex'] ?></td>
                    <td class="align-middle"><?= $member['address'] ?></td>
                    <td class="align-middle"><?= $member['status'] == 'not_borrowing' ? 'Not Borrowing' : 'Is Borrowing' ?></td>
                    <td class="text-center align-middle">
                        <?php
                            if(empty($member['picture'])) {
                                echo "<img src='" . BASE_URL . "/images/defaultuser.jpg' alt='' width='80px' heigth='80px' style='border-width: 2px !important;' class='m-2 border border-primary rounded-circle'>";
                            }
                            else {
                                echo "<img src='" . BASE_URL . "/images/members/" . $member['picture'] . "' alt='' width='80px' heigth='80px' style='border-width: 2px !important;' class='m-2 border border-primary rounded-circle'>";
                            }
                        ?>
                    </td>
                    <td>

                    </td>
                </tr>

        <?php
                $iteration++;
            }
        ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script>
        window.print();
    </script>

</body>
</html>