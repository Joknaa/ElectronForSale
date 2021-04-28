<?php
require "Scripts/S_BillingTable.php";

session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_GET['id']))  header('Location: ClientLogin.php');
$id_client = intval($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/Client.css"/>
    <meta charset='utf-8'>
    <title>Client Space</title>
</head>
<body>
<?php include "Include/Menu.php"; ?>

<center>
    <h1>Liste des factures</h1>
    <button><a href="ClientAddConsumption.php?id=<?php echo $id_client; ?>"> Ajouter Facture </a></button>
    <table>
        <thead>
        <tr>
            <th>Facture N°</th>
            <th>Compteur</th>
            <th>Prix (HT)</th>
            <th>Prix (TTC)</th>
            <th>Date de Saisie</th>
            <th>Etat</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        PrintBillsList($conn, $id_client);
        ?>
        </tbody>
    </table>
</center>
</body>
</html>
