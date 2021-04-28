<?php
session_start();
    $connect= new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
    if(isset($_SESSION['ID_FOURNISSEUR']))
    {
        if(isset($_POST['Submit']))
        {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <link href='../font-awesome-4.7.0/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <link href='logo1.png' rel='icon'>
        <title>Réclamation</title>
    </head>
    <body>

        <style>
            *
            {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            body
            {
                font-family: sans-serif;
            }
            .menu-bar
            {
                background: #BACBC4;
                text-align: center;
                font-weight: bold;
            }
            .menu-bar ul
            {
                display: inline-flex;
                list-style: none;
                color: #204636;
            }
            .menu-bar ul li
            {
                width: 120px;
                margin: 15px;
                padding: 15px;
            }
            .menu-bar ul li a
            {
                text-decoration: none;
                color: #204636;
            }
            .menu-bar ul li:hover
            {
                background: #BACBC4;
                cursor: pointer;
            }
            .menu-bar li.deconnexion
            {
                padding: 100px;
            }
            .menu-bar .fa
            {
                margin-top: 5px;
            }
            .sub-menu-1
            {
                display: none;
            }
            .menu-bar ul li:hover .sub-menu-1
            {
                display: block;
                position: absolute;
                background: #BACBC4;
                margin-top: 15px;
                margin-left: -15px;
            }
            .menu-bar ul li:hover .sub-menu-1 ul
            {
                display: block;
                margin: 10px;
            }
            .menu-bar ul li:hover .sub-menu-1 ul li
            {
                width: 150px;
                padding: 10px;
                border-bottom: 1px dotted #fff;
                background: transparent;
                border-radius: 0;
                text-align: left;
            }
            .menu-bar ul li:hover .sub-menu-1 ul li:last-child
            {
                border-bottom: none;
            }
            .menu-bar ul li:hover .sub-menu-1 ul li a:hover
            {
                color: #fff;
            }
            .login-box
            {
                width: 720px;
                height: 820px;
                background: #BACBC4;
                color: #204636;
                position: absolute;
                margin-left: 25%;
                margin-top: 3%;
                box-sizing: border-box;
                padding: 15px 20px;
                border-radius: 3px;
            }
            h1
            {
                margin: 0;
                padding-top: 40px;
                text-align: center;
                font-size: 22px;
                color: rgb(68, 66, 66);
            }
            .login-box p
            {
                margin: 0;
                padding: 0;
                font-weight: bold;
            }
            .login-box input, .login-box button
            {
                width: 60%;
                margin-bottom: 20px;
            }
            .login-box input[type="text"]
            {
                border: none;
                border-bottom: 1px solid #204636;
                background: none;
                outline: none;
                height: 25px;
                font-weight: bold;
                color: #fff;
                font-size: 16px;
            }
            .login-box textarea
            {
                margin-top: 5px;
                border: none;
                border-bottom: 1px solid #204636;
                outline: none;
                font-weight: bold;
                color: black;
                font-size: 16px;
            }
            .login-box input[type="submit"], .login-box button
            {
                border:2px solid #204636;
                outline: none;
                height: 40px;
                background: none;
                font-weight: bold;
                color: #204636;
                font-size: 18px;
                border-radius: 20px;
                width: 30%;
                float: right;
                margin-right: 14%;
                margin-top: 5%;
            }
            .login-box input[type="submit"]:hover, .login-box button:hover
            {
                cursor: pointer;
                background-color: #204636;
                color: #fff;
            }
            a{
                text-decoration:none;
                color: #204636;
            }
            a:hover{
                cursor:pointer;
                color: #fff;
            }
        </style>

    <div class="menu-bar">
            <ul>
                <li><a href="fournisseur.php"> Compte<br><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li><a href="#">Client <br><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                    <div class="sub-menu-1">
                        <ul>
                            <li class="hover-me"><a href="liste_client.php"><i class="fa fa-list" aria-hidden="true"></i> Consulter </a>
                            </li>
                            <li class="hover-me"><a href="ajouter_client.php"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter </a>
                            </li>
                        </ul>
                    </div>
                </li>        
                <li><a href="#"> Facture <br><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                    <div class="sub-menu-1">
                        <ul>
                            <li><a href="liste_facture_fournisseur.php"><i class="fa fa-list" aria-hidden="true"></i> Consulter</a></li>
                            <li><a href="generer_facture.php"><i class="fa fa-plus" aria-hidden="true"></i> Générer </a></li>
                        </ul>
                    </div>
                </li> 
                <li><a href="#"> Réclamation <br><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                    <div class="sub-menu-1">
                        <ul>
                            <li><a href="liste_reclamation_fournisseur.php"><i class="fa fa-list" aria-hidden="true"></i> Consulter</a></li>
                        </ul>
                    </div>
                </li> 
                <li><a href="deconnexion.php" class="deconnexion">Déconnexion <br><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
        </div>

        <h1>Détail de Réclamation</h1>
            <div class="login-box">
            <form action = "repondre_reclamation.php" method="post">
            <?php
                
                $_SESSION['ID_RECLAMATION'] = $_POST['ID_RECLAMATION'];
                $_SESSION['ID_CLIENT'] = $_POST['ID_CLIENT'];
                $_SESSION['OBJET_RECLAMATION'] = $_POST['OBJET_RECLAMATION'];
                $_SESSION['MESSAGE_RECLAMATION'] = $_POST['MESSAGE_RECLAMATION'];
                $_SESSION['DATE_MESSAGE'] = $_POST['DATE_MESSAGE'];
                $_SESSION['ETAT_RECLAMATION'] = $_POST['ETAT_RECLAMATION'];
                $_SESSION['REPONSE_RECLAMATION'] = $_POST['REPONSE_RECLAMATION'];
                $id_fourn = $_POST['ID_FOURNISSEUR'];
                
                
                $fournisseur = $connect -> prepare("SELECT NOM_F, PRENOM_F FROM fournisseur WHERE ID_FOURNISSEUR= $id_fourn");
                $recup = $fournisseur -> execute();
                $recuperer = $fournisseur -> fetch(); 

                $requete=$connect->prepare("SELECT NOM_CLIENT, PRENOM_CLIENT From client WHERE ID_CLIENT= :id_client");
                $res=$requete->execute(['id_client'=> $_POST['ID_CLIENT']]);
                $ajouter=$requete->fetch();
                
            
        ?>
                <p>Réclamation</p><input type="text" name="ID_RECLAMATION" class="input" value="<?= $_SESSION['ID_RECLAMATION'] ?>" disabled="disabled"><br>
                <input type="text" name="ID_CLIENT" value="<?= $_SESSION['ID_CLIENT'] ?>" hidden>
                <p>Client :</p><input type="text" value="<?= $ajouter['NOM_CLIENT'] ." ".$ajouter['PRENOM_CLIENT'] ?>" disabled="disabled"><br><br>
                <p>Objet :</p><input type="text" name="OBJET_RECLAMATION" value="<?= $_SESSION['OBJET_RECLAMATION'] ?>" disabled="disabled"><br><br>
                <p>Message :</p><textarea name="MESSAGE_RECLAMATION" rows="8" cols="73" disabled="disabled"><?php echo $_SESSION['MESSAGE_RECLAMATION']; ?></textarea><br><br>
                <input type="text" name="DATE_MESSAGE" class="input" value="<?= $_SESSION['DATE_MESSAGE'] ?>" hidden>
                <input type="text" name="ETAT_RECLAMATION" class="input" value="<?= $_SESSION['ETAT_RECLAMATION'] ?>" hidden>
                <?php
                    if(strcasecmp($_SESSION['REPONSE_RECLAMATION'],"aucune")!==0)
                    {
                        
                ?>
                <p>Agent :</p><input type="text" value="<?= $recuperer['NOM_F'] ." ". $recuperer['PRENOM_F'] ?>" disabled="disabled"><br><br>
                <p>Réponse :</p><textarea rows="8" cols="73" disabled="disabled"><?php echo $_SESSION['REPONSE_RECLAMATION']; ?></textarea><br><br>
                <?php
                    }
                    else
                    {
                ?>
                    <p>Agent :</p><input type="text" value="- - - - - - - -"disabled="disabled"><br><br>
                    <p>Réponse :</p><textarea name="REPONSE_RECLAMATION" rows="8" cols="73" required></textarea><br><br>

                <?php
                    }
                ?>
                <input type="text" name="ID_FOURNISSEUR" value="<?= $_SESSION["ID_FOURNISSEUR"] ?>" hidden>
                <input type="submit" name="Submit" value="Terminer">
                <button type="button" name="Button"><a href="liste_reclamation_fournisseur.php">Retourner</a></button>
            </form>
            </div>
        </body>
</html>

<?php
        }   
}
?>