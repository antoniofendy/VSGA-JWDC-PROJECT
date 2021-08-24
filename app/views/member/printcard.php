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
            align-items: center;
            color: #333;
            display: flex;
            font-family: sans-serif;
            justify-content: center;
            margin: 0;
            min-height: 100vh;
        }
        img {
            border-radius: 50%;
            height: 200px;
            max-height: 200px;
            margin-right: 50px;
            object-fit: cover;
            width: 200px;
            border: 2px solid white;
        }
        table {
            border-collapse: collapse !important;
            border-radius: 1em !important;
            overflow: hidden !important;
            min-width: 100% !important;
        }

        th, td {
            padding: 1em !important;
            background: #ddd !important;
            border-bottom: 2px solid white !important; 
        }
        td {
            color: #344966;
        }
        section {
            align-items: center;
            background: #344966;
            border: 2px solid black;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            padding: 40px; 
            width: 750px;
            max-width: 750px;
        }
    </style>
</head>
<body>
    <div id="back-button">

    </div>

    <section>
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-4 align-self-center px-5">
                <?php
                    if(empty($data['picture'])) {
                        echo "<img src='" . BASE_URL . "/images/defaultuser.jpg' alt='' width='50px' heigth='50px' style='border-width: 2px !important;'>";
                    }
                    else {
                        echo "<img src='" . BASE_URL . "/images/members/" . $data['picture'] . "?" . time() ."' alt='' width='50px' heigth='50px' style='border-width: 2px !important;'>";
                    }
                ?>
            </div>
            <div class="col-8 align-self-center px-5">

                <table class="table table-borderless w-100">
                    <tr style="background: white;">
                        <td>ID</td>
                        <td>:</td>
                        <td><?= $data['id'] ?></td>
                    </tr>
                    <tr style="background: white;">
                        <td>Name</td>
                        <td>:</td>
                        <td><?= $data['name'] ?></td>
                    </tr>
                    <tr style="background: white;">
                        <td>Sex</td>
                        <td>:</td>
                        <td style="text-transform: capitalize;"><?= $data['sex'] ?></td>
                    </tr>
                    <tr style="background: white;">
                        <td>Address</td>
                        <td>:</td>
                        <td style="overflow-wrap: anywhere !important;"><?= $data['address'] ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </section> 
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script>
        window.print();
    </script>

</body>
</html>