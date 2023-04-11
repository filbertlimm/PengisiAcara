<?php
    include "connect.php";

    $nrp = "nrp_contoh";

    if (isset($_GET["stat"])) {
        if ($_GET["stat"] == 1) {
            echo "<script>alert('Data anda berhasil tersimpan.')</script>";
        }
    }

    if (isset($_POST["simpan"])) {
        $nama_panitia = $_POST["nama"];
        $contact_panitia = $_POST["kontak"];
        $deskripsi_panitia = $_POST["deskripsi"];

        $updated = false;

        $stmt = $pdo->query("SELECT * FROM `panitia`");
        while ($row = $stmt->fetch()) {
            if ($row["nrp"] == $nrp && $row["nama_kepanitiaan" == $nama_panitia]) {
                $sql_update = "UPDATE `panitia` SET `deskripsi_panitia`='$deskripsi_panitia',`contact_person`='$contact_panitia' WHERE `nrp` = '$nrp' AND `nama_kepanitiaan` = '$nama_panitia'";
                $pdo->exec($sql_update);
                
                $updated = true;
            }
        }

        if ($updated == false) {
            $sql_insert = "INSERT INTO `panitia`(`id`,`nrp`, `nama_kepanitiaan`, `deskripsi_panitia`, `contact_person`) 
            VALUES (NULL,'$nrp', '$nama_panitia', '$deskripsi_panitia', '$contact_panitia')";
            $pdo->exec($sql_insert);    
        }

        header("Location: hal1.php?stat=1");
    }
    
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
</head>

<body>
    <div id="isi_hal1" class="container">
        <form action="#" method="POST">
            <div class="mt-3 row">
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label">Nama Acara Panitia</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label">Contact Person</label>
                    <input type="text" class="form-control" name="kontak">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" style="resize: none; height: 250px;" name="deskripsi"></textarea>
            </div>

            <center>
                <button type="submit" class="btn btn-success" name="simpan">SAVE</button>
            </center>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>