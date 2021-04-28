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
        <title>Accueil</title>
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
            div.user
            {
                font-weight: bolder;
                font-family:  sans-serif;
                color: #fff;
                width: 350px;
                height: 200px;
                background: #BACBC4;
                color: #204636;
                top: 55%;
                left: 50%;
                position: absolute;
                transform: translate( -50%, -50%);
                box-sizing: border-box;
                padding: 70px 60px;
            }
            .logo{
                width: 100px;
                height: 100px;
                border-radius: 50%;
                position: absolute;
                top: -50px;
                left: calc( 50% - 50px);
            }
            span.nom{
                margin-left: 35px;
                padding-bottom: 10px;
            }
            span.prenom{
                margin-left: 11px;
                margin-bottom: 10px;
            }
            span.email{
                margin-left: 28px;
                margin-bottom: 5px;
            }
            .foot{
                position: absolute;
                height: 45px;
                width: 100%;
                background-color: #BACBC4;
                text-align:center;
                color:#204636;
                padding-top: 10px;
                font-weight: bold;
                bottom: 0;
            }
            a.footer{
                text-decoration:none;
                font-family: Calibri, 'Trebuchet MS', sans-serif;
                color:#204636;
            }
        </style>
        <div class="menu-bar">
            <ul>
                <li><a href="fournisseur.php">Compte <br><i class="fa fa-home" aria-hidden="true"></i></a></li>
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
        <div class="user">
            <img src="login" class="logo">
            Nom:<span class="nom"><?php echo $_SESSION['NOM_F']; ?> </span><br><br>
            Prénom:<span class="prenom"><?php echo $_SESSION['PRENOM_F'];?></span><br><br>
            Email:<span class="email"><?php echo $_SESSION['EMAIL'];?></span>
        </div>
        <footer>
            <div class="foot">
                <a class="footer" href="accueil.php">|| Accueil ||</a><br>
                ©Hilali_Hajar
            </div>
        </footer>
    </body>
<html>
<?php
    }
?>