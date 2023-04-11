<?php
include 'connect.php';
    ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style>
        .accordion-item {
            border: 1px solid black;
        }

        .accordion-item:not(:first-of-type) {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div id="isi_hal4" class="container">
        <!-- <form method='post' action='' enctype='multipart/form-data'> -->
            <?php
        $id_ukm = 1;

        $stmt = $pdo->query("SELECT * FROM `request` WHERE `id_ukm` = $id_ukm");
        while($row = $stmt->fetch()){
            $id = $row["id"];
            $date_time = $row["date_time"];
            $request_info = $row["request_info"];
            $status = $row["status"];
            $id_panitia = $row["id_panitia"];
            

        $stmt_2 = $pdo->query("SELECT * FROM `panitia` WHERE id = $id_panitia");
        while ($row_2 = $stmt_2->fetch()){
            $nama_panitia = $row_2["nama_kepanitiaan"];
        } 
        ?>
            <div class="mt-3 accordion" id="accordionExample">
                <div class="mb-3 accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?php echo $id; ?>" aria-expanded="true"
                            aria-controls="collapseOne">
                            <div class="row" style="width: 100%;">
                                <div class="col-12 col-md-6">
                                    Request dari <b><?php echo $nama_panitia ?></b>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php echo $date_time ?>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $id; ?>" class="accordion-collapse collapse"
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                        echo $request_info;
                        ?>
                        </div>
                        <div style="padding: 20px;">
                            <?php
                    if($status == 3){
                        echo '
                        <a href="request_php.php?id='.$id.'&status=2" style="text-decoration:none">
                            <button class="btn btn-success">Accept</button>
                        </a>
                        <a href="request_php.php?id='.$id.'&status=1" style="text-decoration:none">
                            <button class="btn btn-danger">Deny</button>
                        </a>
                        ';
                    }elseif ($status == 1) {
                        echo '<button type="button" class="btn btn-danger btn_status" disabled>Declined</button>';
                    }elseif ($status == 2) {
                        echo '<button type="button" class="btn btn-success btn_status" disabled>Accepted</button>';
                    }
                    ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
        <!-- </form> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>