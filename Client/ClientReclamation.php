<?php
require "../Scripts/S_Reclamation.php";

session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_GET['id'])) header('Location: ../Login.php');
$id_client = intval($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/ClientReclamation.css">
    <link rel="stylesheet" href="../CSS/Menu.css">
    <meta charset='utf-8'>
    <title>Accueil</title>
</head>
<body>
<?php include "../Include/Menu.php"; ?>

<div class="user">
    <form method="POST">
        <center>
            <h1> Reclamation </h1><br>
            <input class="input" type="email" name="email" placeholder="email" required><br>
            <input class="input" type="text" name="subject" placeholder="Subject" required><br>
            <textarea class="input" name="body" placeholder="Write your reclamation here" required></textarea><br>
            <input type="Submit" name="submit" value="envoyer">
        </center>
    </form>
</div>
</body>
<html>
<?php
if (isset($_POST['submit'])) AddReclamation($conn, $id_client);