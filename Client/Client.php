<?php
require "../Scripts/S_BillingTable.php";

session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_GET['id']))  header('Location: ../Login.php');
$id_client = intval($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/Client.css"/>
    <meta charset='utf-8'>
    <title>Client</title>
</head>
<body>
<?php include "../Include/ClientMenu.php"; ?>

<center>
    <br>
    <br>
    <h1>Liste des factures</h1>
    <form action="ClientAddConsumption.php?id=<?php echo $id_client; ?>" method="POST">
        <input class="submit_Confirme" type="submit" name="submit_AjouterFacture" value="Ajouter">
    </form>
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
