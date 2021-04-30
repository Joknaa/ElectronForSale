<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_SESSION['NOM_F'])) echo "error";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="../CSS/ajouter_client.css"/>
    <link href='logo1.png' rel='icon'>


    <title>Ajouter Client</title>
</head>
<body>

<?php include "../Include/Menu.php"; ?>

<div class="head">
    <header>
        <img class="logo" src="logo1.png">

    </header>
</div>

<h1>Ajouter Client</h1>
<div class="login-box">
    <a href="modifier_client.php?id_client=1"> modifier</a>
    <form action="" method="post" id="ajouter">

        <p>Nom :</p><input type="text" name="NOM_CLIENT" required><br><br>
        <p>Prénom :</p><input type="text" name="PRENOM_CLIENT" required><br><br>
        <p>Adresse :</p><input type="text" name="ADRESSE_CLIENT" required><br><br>
        <p>Téléphone :</p><input type="text" name="TELEPHONE_CLIENT" required><br><br>
        <p>Email :</p><input type="email" name="EMAIL_CLIENT" required><br><br>
        <p>Mot de passe :</p><input type="text" name="MDP_CLIENT" id="MDP_CLIENT" required><br><br>
        <input type="submit" name="Submit" value="Ajouter">
        <input type="reset" name="reset" value="Effacer">

    </form>
</div>

<?php
if (isset($_POST['Submit'])) {
    $stmt = $conn->prepare("INSERT INTO facturation.client(Nom, Prenom, Adresse, Telephone, Email, Password) 
                                VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssiss", $_POST["NOM_CLIENT"], $_POST["PRENOM_CLIENT"], $_POST["ADRESSE_CLIENT"],
        $_POST["TELEPHONE_CLIENT"], $_POST["EMAIL_CLIENT"], $_POST["MDP_CLIENT"]);
    if (!$stmt->execute()) echo "Error: " . $stmt . " <br> " . $conn->error;
}
?>
</body>
<html>