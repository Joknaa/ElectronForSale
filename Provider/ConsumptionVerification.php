<?php
require "../Scripts/S_Consumption.php";
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_GET['id'])) header('Location: ../Login.php');
$Provider_ID = intval($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Consumption.css"/>
    <meta charset="UTF-8">
    <title>Consumption Verification</title>
</head>
<body>
<?php include "../Include/ProviderMenu.php"; ?>

<center>
    <br>
    <h1>Liste des Consommations</h1>
    <br>

    <form method="POST">
        <label> Clients:
            <select name="clients">
                <?php PrintClientList($conn); ?>
            </select>
        </label>
        <input class="submit_Confirme" type="Submit" name="submit_SelectClient" value="Select">
    </form>
    <form method="POST">
        <input class="submit_Confirme" type="Submit" name="submit_verify" value="Verifier">
    </form>
    <table>
        <thead>
        <tr>
            <th>Client N°</th>
            <th>Facture N°</th>
            <th>Date</th>
            <th>Consommation Entree</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($_POST["submit_SelectClient"])) {
            $Client_ID = $_POST["clients"];
            PrintConsumptionsList($conn,$Provider_ID, $_POST["clients"]);
            ConfirmeConsumption($conn,$Provider_ID, $Client_ID);
        }
        ?>
        </tbody>
    </table>
</center>
</body>
</html>