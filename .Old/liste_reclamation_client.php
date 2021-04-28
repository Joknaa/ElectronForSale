<?php
session_start();
    $connect= new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
    if(isset($_SESSION['ID_CLIENT']))
    {
        $id_client = $_SESSION['ID_CLIENT'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <link href='../font-awesome-4.7.0/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <link href='logo1.png' rel='icon'>
        <title>Liste Réclamation</title>
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
            *::before, *::after{
                box-sizing: border-box;
            }
            table{
                width: 100%;
                border-collapse: collapse;
                margin: 20px auto;
            }
            th, td{
                padding: 5px;
                text-align: left;
                border: solid 1px #fff;
            }
            th{
                background-color: #204636;
                color: #fff;
            }
            tr:nth-child(odd){
                background-color: #eee;
            }

            @media only  screen and (max-width: 700px){
                table, thead, tbody, tr, th, td{
                    display: block;
                }
                thead{
                    display: none;
                }
                td:nth-child(odd){
                    background-color: #eee;
                }
                td{
                    padding-left: 150px;
                    position: relative;
                    margin-top: -1px;
                    background: #fff;
                }
                td::before{
                    padding: 5px;
                    content: attr(data-label);
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 130px;
                    bottom: 0;
                    background-color: #204636;
                    color: #fff;
                    display: flex;
                    align-items: center;
                    font-weight: bold;
                }
            }
        </style>
    <div class="menu-bar">
            <ul>
                <li><a href="client.php">Compte <br><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li><a href="#">Facture <br><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                    <div class="sub-menu-1">
                        <ul>
                            <li class="hover-me"><a href="liste_facture_client.php"><i class="fa fa-list" aria-hidden="true"></i> Consulter </a>
                            </li>
                            <li class="hover-me"><a href="saisir_facture.php"><i class="fa fa-plus" aria-hidden="true"></i> Saisir </a>
                            </li>
                        </ul>
                    </div>
                </li>        
                <li><a href="#"> Réclamation <br><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                    <div class="sub-menu-1">
                        <ul>
                            <li><a href="liste_reclamation_client.php"><i class="fa fa-list" aria-hidden="true"></i> Consulter</a></li>
                            <li><a href="saisir_reclamation.php"><i class="fa fa-plus" aria-hidden="true"></i> Saisir </a></li>
                        </ul>
                    </div>
                </li> 
                <li><a href="deconnexion.php" class="deconnexion">Déconnexion <br><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <center><h1>Liste des réclamations</h1><center>
        <table>
            <thead>
                <tr>
                    <th>Objet</th>
                    <th>Message</th>
                    <th>Date d'envoie</th>
                    <th>Etat</th>
                    <th>Réponse</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $connect = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root', '' );
                    $requette=$connect->prepare("SELECT * FROM reclamation WHERE ID_CLIENT = $id_client ORDER BY DATE_MESSAGE DESC");
                    $requette->execute();  
                    while($resultat=$requette->fetch())
                    {                 
                ?>
                <tr>
                    <td data-label="Objet"><?php echo $resultat['OBJET_RECLAMATION'];?></td>
                    <td data-label="Message"><?php echo $resultat['MESSAGE_RECLAMATION'];?></td>
                    <td data-label="Date d'envoie"><?php echo $resultat['DATE_MESSAGE'];?></td>
                    <td data-label="Etat"><?php echo $resultat['ETAT_RECLAMATION'];?></td>
                    <td data-label="Réponse"><?php echo $resultat['REPONSE_RECLAMATION'];?></td>
                </tr>
                    <?php
                        }
                        $requette->closeCursor();
                    ?>
            </tbody>
        </table>
    </body>
</html>

<?php
    }
?>