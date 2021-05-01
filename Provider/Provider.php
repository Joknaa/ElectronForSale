<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");

if (!isset($_GET['id'])) header('Location: ../Login.php');
$Provider_ID = intval($_GET['id']);
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/Client.css"/>
    <title> Espace fournisseur </title>
    <link href="logo1.png" rel="icon">
    <link href='bg.png' rel='icon'>
</head>

<body>
<?php include "../Include/ProviderMenu.php"; ?>

<div class="head">
    <header>
        <img class="logo" src="logo1.png">

    </header>
</div>
<center>
    <div class="Div_Input">
        <h1>Liste des factures</h1>
        <form action="AddClient.php" method="POST">
            <input class="submit_Confirme" type="submit" name="submit" value="Ajouter">
        </form>

        <div class="choisir">
            <br>
            <table>
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $stmt = $conn->prepare('SELECT * FROM facturation.client ORDER BY ID ASC');
                $stmt->execute();
                $stmt_result = $stmt->get_result();
                if ($stmt_result->num_rows > 0) {
                    $rows = $stmt_result->num_rows;
                    do {
                        $Client = $stmt_result->fetch_assoc();
                        ?>
                        <tr>
                            <td data-label="Nom"><?php echo $Client['Nom']; ?></td>
                            <td data-label="Prenom"><?php echo $Client['Prenom']; ?></td>
                            <td data-label="Email"><?php echo $Client['Email']; ?></td>
                            <td data-label="Action">
                                <button type="button" class="Modifier"><a
                                            href="ModifyClient.php?id_client=<?= $Client['ID'] ?>">Modifier</a>
                                </button>
                            </td>
                        </tr>
                        <?php
                        $rows--;
                    } while ($rows > 0);
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</center>

</body>
</html>