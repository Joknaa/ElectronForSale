<?php
require "../Scripts/S_billsTable.php";

$conn = mysqli_connect("localhost", "root", "", "facturation");
if ($conn->connect_error) die("failed to connect :" . $conn->connect_error);
$Client_ID = intval($_GET["Client_ID"])?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <th>NAME</th>
        <th>PRENOM</th>
        <th>EMAIL</th>
        <th>ADRESSE</th>
        <th>DEPT</th>
    </tr>
    <?php


     ?>

</body>
</html>