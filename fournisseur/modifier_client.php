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
        <link href='../font-awesome-4.7.0/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <link href='logo1.png' rel='icon'>
        <title>Modifier Client</title>
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
                width: 420px;
                height: 700px;
                background: #BACBC4;
                color: #204636;
                position: absolute;
                margin-left: 480px;
                margin-top: 35px;
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
            .login-box input
            {
                width: 100%;
                margin-bottom: 20px;
            }
            .login-box input[type="text"], .login-box input[type="email"]
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
            .login-box input[type="button"]{
                border: 0;
                background: none;
                display: block;
                margin: 2px auto;
                text-align: center;
                border: 2px solid #286955;
                padding: 10px 10px;
                outline: none;
                color: #286955;
                font-weight: bold;
                border-radius: 24px;
                transition: 0.25s;
                cursor:pointer;
            }
            .login-box input[type="button"]:hover{
                background-color: #50CEA8;
                border: 2px solid #50CEA8;
                color: #fff;
                cursor:pointer;
            
            }
            .login-box input[type="submit"], .login-box input[type="reset"]
            {
                border:2px solid #204636;
                outline: none;
                height: 40px;
                background: none;
                font-weight: bold;
                color: #204636;
                font-size: 18px;
                border-radius: 20px;
            }
            .login-box input[type="submit"]:hover , .login-box input[type="reset"]:hover
            {
                cursor: pointer;
                background-color: #204636;
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
        <h1>Modifier Client</h1>
            <div class="login-box">
            <?php
                $connect = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
                if(isset($_GET['id_client']))
                {
                    $mod=$connect->prepare('SELECT * FROM client where ID_CLIENT = :id_client');
                    $mod->bindValue(':id_client', $_GET['id_client'],PDO :: PARAM_INT);
                    $result=$mod -> execute();
                    $resultat=$mod -> fetch();
                }
            ?>
            <form action = "modifier_cl.php" method="post">
            <input name="ID_CLIENT" class="input" value="<?= $resultat['ID_CLIENT'] ?>" type="hidden"><br>
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