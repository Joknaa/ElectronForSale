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
        <title>Liste Facture</title>
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
            input[type="Submit"]
            {
                background: none;
                font-weight: bold;
                border: none;
            }
            input[type="Submit"]:hover
            {
                color: #204636;
                cursor: pointer;
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
        <center><h1>Liste des factures</h1><center>
        <table>
            <thead>
                <tr>
                    <th>Facture N°</th>
                    <th>Compteur</th>
                    <th>Prix (HT)</th>
                    <th>Prix (TTC)</th>
                    <th>Date de Saisie</th>
                    <th>Etat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $requette=$connect->prepare("SELECT * FROM facture WHERE ID_CLIENT = $id_client ORDER BY DATE_FACTURE DESC");
                    $requette->execute();  
                    while($resultat=$requette->fetch())
                    {        
                        $_SESSION['ID_FACTURE'] = $resultat['ID_FACTURE'];
                        $_SESSION['DATE_FACTURE'] = $resultat['DATE_FACTURE'];
                        $_SESSION['CONSOMMATION'] = $resultat['CONSOMMATION'];
                        $_SESSION['PRIX_HT'] = $resultat['PRIX_HT'];
                        $_SESSION['PRIX_TTC'] = $resultat['PRIX_TTC'];
                        $_SESSION['ETAT_FACTURE'] = $resultat['ETAT_FACTURE'];
                ?>
                <tr>
                    <td data-label="Facture N°"><?php echo $_SESSION['ID_FACTURE'];?></td>
                    <td data-label="Compteur"><?php echo $_SESSION['CONSOMMATION'];?> KWH</td>
                    <td data-label="Prix (HT)"><?php echo $_SESSION['PRIX_HT'];?> DH</td>
                    <td data-label="Prix (TTC)"><?php echo $_SESSION['PRIX_TTC'];?> DH</td>
                    <td data-label="Date de Saisie"><?php echo $_SESSION['DATE_FACTURE'];?></td>
                    <td data-label="Etat"><?php echo $_SESSION['ETAT_FACTURE'];?></td>
                    <td data-label="Action">
                        <form action="" method="post">
                            <input type="submit" name="Payer" value="Payer">
                        </form>
                        </td>
                </tr>
                    <?php
                    }
                    if(isset($_POST['Payer']))
                    {
                        if(strcasecmp($_SESSION['ETAT_FACTURE'],"Non Payée")!==0)
                        {
                    ?>
                    <script>
                        alert("Facture déjà payée !!");
                    </script>
                    <?php
                        }
                        else
                        {
                            $req = $connect->prepare('UPDATE facture SET ETAT_FACTURE = :etat, DATE_FACTURE = :date_f WHERE ID_FACTURE= :id_facture LIMIT 1');
                            $etat = 'Payée';
                            $req -> bindValue(':id_facture', $_SESSION['ID_FACTURE'],PDO :: PARAM_INT);
                            $req -> bindValue(':date_f', date("Y-m-d"),PDO :: PARAM_STR);
                            $req -> bindValue(':etat', $etat,PDO :: PARAM_STR);
                    ?>
                        <script>
                            window.location.replace("liste_facture_client.php");
                        </script>
                    <?php
                        
                        
                        $requette->closeCursor();

                        $result = $req->execute();

                        if(!$result)
                        {
                        
                        ?>
                            <script> alert('Modification a échouée!!'); </script>
                        <?php
                        }
                    }
                }
                        ?>
                            
            </tbody>
        </table>
    </body>
</html>

<?php
    }
?>