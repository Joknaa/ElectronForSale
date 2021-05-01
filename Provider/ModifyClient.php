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
    <title>Modifier Client</title>
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

    <div class="Div_Input">
        <h1>Modifier Client</h1>

        <?php
        if (isset($_GET['id_client'])) {
            $id_client = intval($_GET['id_client']);
            $stmt = $conn->prepare('SELECT * FROM facturation.client where ID = ?');
            $stmt->bind_param('i', $id_client);
            $stmt->execute();
            $stmt_result = $stmt->get_result();
            if ($stmt_result->num_rows > 0) {
                $resultat = $stmt_result->fetch_assoc();
                if (!$stmt->execute()) echo "Error: " . $stmt . " <br> " . $conn->error;

            }
        }
        ?>

        <center>
        <form action="../Scripts/S_ModifyClient.php" method="post">
            <input name="id_client" class="input" value="<?php echo $resultat['ID'] ?>" type="hidden"><br>
            <label>Nom :
                <input class="input" type="text" name="NOM_CLIENT" value="<?php echo $resultat['Nom'] ?>">
            </label>
            <label>Prénom :
                <input class="input" type="text" name="PRENOM_CLIENT" value="<?php echo $resultat['Prenom'] ?>">
            </label>
            <label>Adresse :
                <input class="input" type="text" name="ADRESSE_CLIENT" value="<?php echo $resultat['Adresse'] ?>">
            </label>
            <label>Téléphone :
                <input class="input" type="text" name="TELEPHONE_CLIENT" value="<?php echo $resultat['Telephone'] ?>">
            </label>
            <label>Email :
                <input class="input" type="email" name="EMAIL_CLIENT" value="<?php echo $resultat['Email'] ?>">
            </label>
            <input class="submit" type="submit" name="Submit" value="Modifier">
            <input class="submit" type="reset" name="reset" value="Annuler">
        </form>
        </center>

    </div>
</body>
<html>