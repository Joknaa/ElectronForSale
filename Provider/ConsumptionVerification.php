<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_GET['id']))  header('Location: ../Login.php');
$Provider_ID = intval($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consumption Verification</title>
</head>
<body>
<?php include "../Include/ProviderMenu.php"; ?>

<center>
    <h1>Liste des factures</h1>
    <button><a href="ClientAddConsumption.php?id=<?php echo $Provider_ID; ?>"> Ajouter Facture </a></button>
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
        #PrintBillsList($conn, $Provider_ID);
        ?>
        </tbody>
    </table>
</center>
</body>
</html>