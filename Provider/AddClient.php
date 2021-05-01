<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="../CSS/Import/DialogBox.css"/>
    <link href='logo1.png' rel='icon'>
    <title>Ajouter Client</title>
    <style>
        .submit{
            padding: 2px;
            font-size: 15px;
            height: 30px;
        }
    </style>
</head>
<body>

<?php include "../Include/ProviderMenu.php"; ?>

<div class="head">
    <header>
        <img class="logo" src="logo1.png">

    </header>
</div>

<div class="Div_Input">
    <center>
        <h1>Ajouter Client</h1>
        <form action="" method="post" id="ajouter">
            <label>Nom :
                <input class="input" type="text" name="NOM_CLIENT" required>
            </label>
            <label>Prenom :
                <input class="input" type="text" name="PRENOM_CLIENT" required>
            </label>
            <label>Adresse :
                <input class="input" type="text" name="ADRESSE_CLIENT" required>
            </label>
            <label>Telephone :
                <input class="input" type="text" name="TELEPHONE_CLIENT" required>
            </label>
            <label>Email :
                <input class="input" type="email" name="EMAIL_CLIENT" required>
            </label>
            <input class="submit" type="submit" name="Submit" value="Ajouter">
            <input class="submit" type="reset" name="reset" value="Effacer">
        </form>
    </center>
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