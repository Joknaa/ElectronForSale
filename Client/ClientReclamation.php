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
    <link rel="stylesheet" href="../CSS/Import/DialogBox.css">
    <link rel="stylesheet" href="../CSS/ClientMenu.css">
    <meta charset='utf-8'>
    <title>Ajouter Reclamation</title>
</head>
<body>
<?php include "../Include/ClientMenu.php"; ?>

<div class="Div_Input">
    <form method="POST">
        <center>
            <h1> Reclamation </h1>
            <hr>
            <br>
            <input class="input" type="email" name="email" placeholder="email" required><br>
            <input class="input" type="text" name="subject" placeholder="Subject" required><br>
            <textarea class="input" name="body" placeholder="Write your reclamation here" required></textarea><br>
            <input class="submit" type="Submit" name="submit" value="Envoyer">
            <a class="Btn_Back" href="Client.php?id=<?php echo $id_client ?>">Annuler</a>
        </center>
    </form>
</div>
</body>
<html>
<?php
if (isset($_POST['submit'])) AddReclamation($conn, $id_client);