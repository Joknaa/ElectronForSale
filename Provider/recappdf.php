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
    $stmt = $conn->prepare("SELECT * FROM facturation.client WHERE ID = ?");
    $stmt->bind_param("i", $Client_ID);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $rows = $stmt_result->num_rows;
        do {
            $row = $stmt_result->fetch_assoc();
            echo '<tr><td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['Prenom'] . '</td>';
            echo '<td >' . $row['Email'] . '</td>';
            echo '<td>' . $row['Adresse'] . '</td>';
            echo '<td >' . $row['Dept'] . '</td></tr>';
            $rows--;
        } while ($rows > 0);
        echo "</table>";

    } ?>

</body>
</html>