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
        <link rel="stylesheet" href="CSS/ajouter_client.css"/>
        <link href='logo1.png' rel='icon'>
        <title>Ajouter Client</title>
    </head>
    <body>
   
    <?php include "Include/Menu.php"; ?>
       
        

        <h1>Ajouter Client</h1>
            <div class="login-box">
            <form action = "" method="post" id="ajouter">
        
            <p>Nom :</p><input type="text" name="NOM_CLIENT" required><br><br>
                <p>Prénom :</p><input type="text" name="PRENOM_CLIENT" required><br><br>
                <p>Adresse :</p><input type="text" name="ADRESSE_CLIENT" required><br><br>
                <p>Téléphone :</p><input type="text" name="TELEPHONE_CLIENT" required><br><br>
                <p>Email :</p><input type="email" name="EMAIL_CLIENT" required><br><br>
                <p>Mot de passe :</p><input type="text" name="MDP_CLIENT" id="MDP_CLIENT"required><br><br>
                <p>Statut :</p><input type="text" name="STATUT_CLIENT" required><br><br>
                <input type="submit" name="Submit" value="Ajouter">
                <input type="reset" name="reset" value="Effacer">

            </form>
            </div>

            <?php
                $connect=new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
                if(isset($_POST['Submit']))
                {
                    $pass_client = $_POST['MDP_CLIENT'];

                    //Pour créer une clé de hachage pour le mot de passe;

                    $option =[
                        'cost' => 12,
                    ];
                    $hashpass = password_hash($pass_client,PASSWORD_BCRYPT,$option);

                    $aj = "INSERT INTO client (NOM_CLIENT, PRENOM_CLIENT, ADRESSE_CLIENT, TELEPHONE_CLIENT, EMAIL_CLIENT, MDP_CLIENT,STATUT_CLIENT) VALUES (:nom, :prenom, :adresse, :telephone, :email, :mdp, :statut)";
                    $ajo = $connect->prepare($aj);
                    $ajouter = $ajo->execute(array(
                        'nom' => $_POST['NOM_CLIENT'],
                        'prenom' => $_POST['PRENOM_CLIENT'],
                        'adresse' => $_POST['ADRESSE_CLIENT'],
                        'telephone' => $_POST['TELEPHONE_CLIENT'],
                        'email' => $_POST['EMAIL_CLIENT'],
                        'mdp' => $hashpass,
                        'statut' => $_POST['STATUT_CLIENT'],
                    ));
                    
                }
            ?>
    </body>
<html>
<?php
    }
?>