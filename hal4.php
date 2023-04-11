<?php
    include "connect.php";

    $id_panitia = 1;
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

    .btn_status {
        position: relative;
        float: right;
        top: -45px;
        left: -50px;
        z-index: 99;
        opacity: 1 !important;
        width: 92.5px;
    }

    @media (max-width: 768px) {
        .btn_status {
            top: -55px;
        }
    }
    </style>
</head>

<body>
    <div id="isi_hal4" class="container">
        <div class="mt-3 accordion" id="accordionExample">
            <?php 
            $stmt = $pdo->query("SELECT * FROM `request` WHERE id_panitia = $id_panitia");
            while ($row = $stmt->fetch()) {
                $id = $row["id"];
                $date_time = $row["date_time"];
                $request_info = $row["request_info"];
                $status = $row["status"];
                $id_ukm = $row["id_ukm"]; 

                $stmt_ukm = $pdo->query("SELECT * FROM `ukm` WHERE id = $id_ukm");
                while ($row_ukm = $stmt_ukm->fetch()){
                    $nama_ukm = $row_ukm["nama"];
                } 
            ?>
            <div class="mb-5 accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?php echo $id; ?>" aria-expanded="true" aria-controls="collapse1">
                        <div class="row" style="width: 100%;">
                            <div class="col-12 col-md-6">
                                Request untuk <b><?php echo $nama_ukm ?></b>
                            </div>
                            <div class="col-12 col-md-6">
                                <?php echo $date_time ?>
                            </div>
                        </div>
                    </button>
                    <?php if ($status == 1) { ?>
                    <button type="button" class="btn btn-danger btn_status" disabled>Declined</button>
                    <?php } elseif ($status == 2) { ?>
                    <button type="button" class="btn btn-success btn_status" disabled>Accepted</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-warning btn_status" disabled>Pending</button>
                    <?php } ?>
                </h2>
                <div id="collapse<?php echo $id; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php echo $request_info; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>