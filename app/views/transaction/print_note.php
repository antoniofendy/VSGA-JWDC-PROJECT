<?php

function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
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
    <title>Print | Transaction Note</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            padding: 50px;
        }
        p {
            font-size: 25px;
        }
        td,li {
            font-size: 25px;
        }
    </style>
</head>
<body>
    <h2 class="text-center mb-2">Surat Keterangan Peminjaman Buku Perpustakaan</h2>
    <hr>
    <p class="mb-5 mt-5 text-right"><?= tgl_indo(date('Y-m-d')) ?></p>
    <p class="mb-3 mt-5">Saya selaku pengurus perpustakaan GoLibrary menegaskan bahwa:</p>

    <table class="table table-sm table-borderless mb-4" style="width: 50% !important;" border="0">
        <tbody>
            <tr>
                <td>ID Peminjam</td>
                <td>:</td>
                <td><?= $data['members_id'] ?></td>
            </tr>
            <tr>
                <td>Nama Peminjam</td>
                <td>:</td>
                <td><?= $data['name'];  ?></td>
            </tr>
        </tbody>
    </table>

    <p>
        Telah mengetahui dan berkomitmen untuk mengikuti persyaratan peminjaman buku di perpustakaan sebagai berikut:
        <ul class="text-justify">
            <li>Peminjam wajib mengembalikan buku sebelum batas waktu pengembalian yang tertera berakhir.</li>
            <li>Peminjam wajib membayar denda secara penuh apabila terlambat mengembalikan buku.</li>
            <li>Peminjam hanya dapat memperpanjang waktu peminjaman sebanyak satu kali (7 hari) sebelum masa peminjaman berakhir.</li>
            <li>Peminjam tidak dapat meminjam buku lain selama masih berstatus "meminjam".</li>
        </ul>
    </p>

    <p class="mb-3 mt-4">
        Adapun deskripsi transaksi peminjaman sebagai berikut:
    </p>
    <table class="table table-sm table-borderless mb-5" style="width: 100% !important; margin-bottom: 100px !important;" border="0">
        <tbody>
            <tr>
                <td width="35%">ID Transaksi</td>
                <td>:</td>
                <td><?= $data['trans_id'] ?></td>
            </tr>
            <tr>
                <td>ISBN Buku</td>
                <td>:</td>
                <td><?= $data['books_isbn'];  ?></td>
            </tr>
            <tr>
                <td>Judul Buku</td>
                <td>:</td>
                <td><?= $data['title'];  ?></td>
            </tr>
            <tr>
                <td>Tanggal Peminjaman</td>
                <td>:</td>
                <td><?= tgl_indo(date('Y-m-d', strtotime($data['borrow_date'])));  ?></td>
            </tr>
            <tr>
                <td>Tanggal Batas Peminjaman</td>
                <td>:</td>
                <td><?= tgl_indo(date('Y-m-d', strtotime($data['due_date'])));  ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row d-flex justify-content-between mt-5" style="heigth: 200px; padding-left: 10px; padding-right: 10px; margin-top: 50px;">
        <div class="col-6">
            <div class="person" style="margin-bottom: 80px !important">
                <p>Pengelola Perpustakaan</p>
            </div>
            <div class="name">
                <p><?= $_SESSION['admin_name']; ?></p>
            </div>
        </div>
        <div class="col-6 text-right">
            <div class="person" style="margin-bottom: 80px !important">
                <p>Peminjam</p>
            </div>
            <div class="name">
                <p><?= $data['name']; ?></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script>
        window.print();
    </script>

</body>
</html>