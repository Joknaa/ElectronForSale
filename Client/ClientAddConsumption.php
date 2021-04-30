<?php
require "../Scripts/S_Consumption.php";

session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if ($conn->connect_error) die("failed to connect :" . $conn->connect_error);

if (!isset($_GET['id'])) header('Location: ../Login.php');
$id_client = intval($_GET['id']);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/Import/DialogBox.css">
    <link rel="stylesheet" href="../CSS/ClientMenu.css"/>
    <meta charset='utf-8'>
    <title>Ajouter Consommation</title>
</head>
<body>
<?php include "../Include/ClientMenu.php"; ?>
<div class="Div_Input">
    <form method="POST">
        <center>
            <h1> Saisie de consommation </h1>
            <hr>
            <br>
            <label>
                <select class="submit" name="month">
                    <option selected value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <input class="input" type="text" name="consommation" placeholder="consommation" required>
            </label><br>
            <input class="submit" type="Submit" name="submit" value="Submit">
            <a class="Btn_Back" href="Client.php?id=<?php echo $id_client ?>">Annuler</a>
        </center>
    </form>
</div>
</body>
<html>
<?php
if (isset($_POST['submit'])) AddConsumption($conn, $id_client);