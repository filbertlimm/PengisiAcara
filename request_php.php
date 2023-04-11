<?php
include 'connect.php';
$id = $_GET['id'];
$status = $_GET['status'];
echo $id." - ".$status; 
$sql = "UPDATE `request` SET `status`='$status' WHERE id = $id";
$pdo->query($sql);
header('Location: hal5.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>