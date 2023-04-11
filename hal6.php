<?php
// session_start();
include 'connect.php';
include 'navbar.html';

$nrp = $_SESSION["nrp"];

$stmt = $pdo->query("SELECT * FROM `admin` WHERE `nrp` LIKE '$nrp'");
if($row = $stmt->fetch()){
    // echo $nrp.' logged in';
    $id_ukm = $row['id_ukm'];
}else{
    header('Location: index.php');
}

$stmt = $pdo->query("SELECT * FROM `ukm` WHERE `id` = $id_ukm");
if($row = $stmt->fetch()){
    $nama_ukm = $row['nama'];
    $old_contact_person = $row['contact_person'];
    $old_deskripsi = $row['deskripsi'];
    $old_foto = $row['foto'];
    $old_logo = $row['logo'];
}

if(isset($_POST['submit'])){
    
    $date = date("d-M-Y H-i-s");
    
    $file_batch='';
    $countfiles = count($_FILES['file']['name']);
    if ($countfiles != 1){
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['file']['name'][$i];
            move_uploaded_file($_FILES['file']['tmp_name'][$i],'upload/'.$date.'-'.$filename);
            $file_batch .= ';upload/'.$date.'-'.$filename;
        }
        $sql1 = "UPDATE `ukm` SET `foto`='$file_batch' WHERE  `id`=$id_ukm";
        $pdo->query($sql1);
    }
    
    // $ukm = $_POST['ukm'];
    $deskripsi = $_POST['deskripsi'];
    $kontak = $_POST['kontak'];

    // $logo = $_POST['logo'];
    if(($_FILES['logo']['name'])!=""){
        $filename = $_FILES['logo']['name'];
        move_uploaded_file($_FILES['logo']['tmp_name'],'upload/'.$date.'-'.$filename); 
        $logo = 'upload/'.$date.'-'.$filename;

        $sql2 = "UPDATE `ukm` SET `logo`='$logo' WHERE  `id`=$id_ukm";
        $pdo->query($sql2);
    }
    

    // $sql = "INSERT INTO `ukm`(`id`, `nama`, `deskripsi`, `contact_person`, `foto`, `logo`) VALUES (NULL,'$ukm','$deskripsi','$kontak','$file_batch','$logo')";

    $sql = "UPDATE `ukm` SET `deskripsi`='$deskripsi',`contact_person`='$kontak' WHERE `id`=$id_ukm";
    $pdo->query($sql);

}
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title>Hello, world!</title>
    <style>
        @media only screen and (max-width: 1000px) {
            /* For tablets & phone */

        }

        @media only screen and (min-width: 1001px) {
            /* For desktop: */

        }
    </style>
</head>

<body>
    <div class="fluid container menu" style="row-gap: 15px;">
        <form method='post' action='' enctype='multipart/form-data'>
            <div class="row">
                <div class="mb-3 col-2">
                    <label for="exampleFormControlInput1" class="form-label">Nama UKM</label>
                    <input type="text" class="form-control" id="namaUKM" value="<?php echo $nama_ukm;?>" name="ukm" disabled>
                </div>
                <div class="mb-3 col-3">
                    <label for="exampleFormControlInput1" class="form-label">Contact Person (Line ID)</label>
                    <input name="kontak" type="text" class="form-control" value="<?php echo $old_contact_person;?>" id="contact" Required>
                </div>
            </div>

            <div class="mb-3 col-12">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea maxlength="250" name="deskripsi" style="height: 250px;" class="form-control" id="exampleFormControlTextarea1"
                    rows="3"><?php echo $old_deskripsi;?></textarea>
            </div>

            <div class="row">
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label">Foto dan Video</label>
                    <input class="form-control" type="file" name="file[]" id="file" multiple>
                    <center><h6 style="color:red; font-size:14px;">Video harus format .mp4 <br> Tidak boleh ada tanda "." dan ";" pada nama File!</h6></center>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label">Logo UKM</label>
                    <input name="logo" class="form-control" type="file">
                </div>
            </div>

            <center>
                <input class="btn btn-success" type='submit' name='submit' value='Upload'>
            </center>
        </form>

    </div>