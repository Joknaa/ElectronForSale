<?php
session_start();
    $connect= new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
    if(isset($_SESSION['NOM_F']))
    {
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
       
    <?php include "Include/Menu.php"; ?>
      
    <div class="head">
        <header>
            <img class="logo" src="logo1.png">
           
        </header>

        <h1>Modifier Client</h1>
            <div class="login-box">
            <?php
                $connect = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
                if(isset($_GET['id_client']))
                {
                    $mod=$connect->prepare('SELECT * FROM client where id_client = :id_client');
                    $mod->bindValue(':id_client', $_GET['id_client'],PDO :: PARAM_INT);
                    $result=$mod -> execute();
                    $resultat=$mod -> fetch();
                }
            ?>
            <form action = "modify_action.php" method="post">
            <input name="id_client" class="input" value="<?= $resultat['id_client'] ?>" type="hidden"><br>
                <p>Nom :</p><input type="text" name="NOM_CLIENT" value="<?= $resultat['NOM_CLIENT'] ?>"><br><br>
                <p>Prénom :</p><input type="text" name="PRENOM_CLIENT" value="<?= $resultat['PRENOM_CLIENT'] ?>"><br><br>
                <p>Adresse :</p><input type="text" name="ADRESSE_CLIENT" value="<?= $resultat['ADRESSE_CLIENT'] ?>"><br><br>
                <p>Téléphone :</p><input type="text" name="TELEPHONE_CLIENT" value="<?= $resultat['TELEPHONE_CLIENT'] ?>"><br><br>
                <p>Email :</p><input type="email" name="EMAIL_CLIENT" value="<?= $resultat['EMAIL_CLIENT'] ?>"><br><br>
                <p>Statut :</p><input type="text" name="STATUT_CLIENT" value="<?= $resultat['STATUT_CLIENT'] ?>"><br><br>
                <input type="submit" name="Submit" value="Modifier">
                <input type="reset" name="reset" value="Annuler">

            </form>
            
            </div>
    </body>
<html>
<?php
    }
?>