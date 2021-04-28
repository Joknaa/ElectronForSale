<?php
session_start();
    $connect= new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
    if(isset($_SESSION['ID_FOURNISSEUR']))
    {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <link href='../font-awesome-4.7.0/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <link href='logo1.png' rel='icon'>
        <title>Liste Client</title>
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
            button
            {
                height:25px;
                border-radius: 10px;
                background:none;
                border: none;
                font-weight: bold;
                color:#010101;
            }
            button:hover{
                cursor:pointer;
            }
            a{
                text-decoration:none;
                color: #010101;
            }
            a:hover{
                cursor:pointer;
                color: #204636;
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
        <center><h1>Liste des clients</h1><center>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $connect = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root', '' );
                    $requette=$connect->prepare("SELECT * FROM client ORDER BY ID_CLIENT ASC");
                    $requette->execute();  
                    while($resultat=$requette->fetch())
                    {                 
                ?>
                <tr>
                    <td data-label="ID"><?php echo $resultat['ID_CLIENT'];?></td>
                    <td data-label="Nom"><?php echo $resultat['NOM_CLIENT'];?></td>
                    <td data-label="Prenom"><?php echo $resultat['PRENOM_CLIENT'];?></td>
                    <td data-label="Adresse"><?php echo $resultat['ADRESSE_CLIENT'];?></td>
                    <td data-label="Téléphone"><?php echo $resultat['TELEPHONE_CLIENT'];?></td>
                    <td data-label="Email"><?php echo $resultat['EMAIL_CLIENT'];?></td>
                    <td data-label="Statut"><?php echo $resultat['STATUT_CLIENT'];?></td>
                    <td data-label="Action">
                        <button type="button" class="Modifier"><a href="modifier_client.php?id_client=<?= $resultat['ID_CLIENT']?>">Modifier</a></button> 
                    </td>
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