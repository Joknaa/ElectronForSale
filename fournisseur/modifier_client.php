<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_SESSION['NOM_F'])) echo "error";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="../CSS/modifier_client.css"/>
    <link href='logo1.png' rel='icon'>
    <title>Modifier Client</title>
</head>
<body>
<?php include "../Include/Menu.php"; ?>
<div class="head">
    <header>
        <img class="logo" src="logo1.png">
    </header>

    <h1>Modifier Client</h1>
    <div class="login-box">
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

        <form action="modify_action.php" method="post">
            <input name="id_client" class="input" value="<?php echo $resultat['ID'] ?>" type="hidden"><br>
            <p>Nom :</p><input type="text" name="NOM_CLIENT" value="<?php echo $resultat['Nom'] ?>"><br><br>
            <p>Prénom :</p><input type="text" name="PRENOM_CLIENT" value="<?php echo $resultat['Prenom'] ?>"><br><br>
            <p>Adresse :</p><input type="text" name="ADRESSE_CLIENT" value="<?php echo $resultat['Adresse'] ?>"><br><br>
            <p>Téléphone :</p><input type="text" name="TELEPHONE_CLIENT" value="<?php echo $resultat['Telephone'] ?>"><br><br>
            <p>Email :</p><input type="email" name="EMAIL_CLIENT" value="<?php echo $resultat['Email'] ?>"><br><br>
            <input type="submit" name="Submit" value="Modifier">
            <input type="reset" name="reset" value="Annuler">
        </form>

    </div>
</body>
<html>