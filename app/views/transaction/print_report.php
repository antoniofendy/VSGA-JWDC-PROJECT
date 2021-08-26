<?php

function date_funtion($tanggal){
    $bulan = array (
        1 =>   'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>

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
            padding: 10px;
        }
        td {
            font-size: 15px;
        }
    </style>
    <style type="text/css" media="print">
        @page { size: landscape; }
    </style>
</head>
<body>
    <div id="back-button">

    </div>
    <h1 class="text-center mb-3">Transaction Data</h1>
    <h4 class="text-left mb-5">Printed Date: <?= date('d-m-Y') ?></h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="align-middle">#</th>
                <th scope="col" class="align-middle">Transaction's ID</th>
                <th scope="col" class="align-middle">Member's ID</th>
                <th scope="col" class="align-middle">Name</th>
                <th scope="col" class="align-middle">Book's ISBN</th>
                <th scope="col" class="align-middle">Title</th>
                <th scope="col" class="align-middle">Borrow Date</th>
                <th scope="col" class="align-middle">Due Date</th>
                <th scope="col" class="align-middle">Return Date</th>
                <th scope="col" class="align-middle">Status</th>
            </tr>
        </thead>
        <tbody>
    
        <?php 
            $iteration = 1;

            foreach ($data as $key => $transaction) {
        ?>
                <tr>
                    <th scope="row" class="align-middle"><?= $iteration ?></th>
                    <td class="align-middle"><?= $transaction['trans_id'] ?></td>
                    <td class="align-middle"><?= $transaction['members_id'] ?></td>
                    <td class="align-middle"><?= $transaction['name'] ?></td>
                    <td class="align-middle"><?= $transaction['books_isbn'] ?></td>
                    <td class="align-middle"><?= $transaction['title'] ?></td>
                    <td class="align-middle"><?= date_funtion(date('Y-m-d', strtotime($transaction['borrow_date']))) ?></td>
                    <td class="align-middle"><?= date_funtion(date('Y-m-d', strtotime($transaction['due_date']))) ?></td>
                    <td class="align-middle">
                        <?php
                            if($transaction['return_date'] != "0000-00-00") {
                                echo date_funtion(date('Y-m-d', strtotime($transaction['return_date'])));
                            }
                            else {
                                echo "-";
                            }
                        ?>
                    </td>
                    <td class="align-middle">
                        <?php
                            if($transaction['return_date'] != "0000-00-00") {
                                echo "Returned";
                            }
                            else {
                                if(date('Y-m-d') > $transaction['due_date']) {
                                    echo "Over time";
                                }
                                else {
                                    echo "Borrowed";
                                }
                            }
                        ?>
                    </td>
                </tr>

        <?php
                $iteration++;
            }
        ?>
    </table>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script>
        window.print();
    </script>

</body>
</html>