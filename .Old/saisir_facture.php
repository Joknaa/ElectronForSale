<?php
session_start();
    $connect= new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');

    if(isset($_SESSION['ID_CLIENT']))
    {

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <link href='../font-awesome-4.7.0/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <link href='logo1.png' rel='icon'>
        <title>Facture</title>
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
                height: 530px;
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
            .login-box input[type='button']
            {
                border:2px solid #204636;
                outline: none;
                height: 40px;
                width: 160px;
                margin-bottom: 25px;
                background-color: #204636;
                font-weight: bold;
                color: #fff;
                font-size: 18px;
                border-radius: 20px;
            }
            .login-box input[type='button']:hover
            {
                cursor: pointer;
                background-color: #fff;
                border-color: #fff;
                color: #204636;
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
        <h1>Saisir Facture</h1>
            <div class="login-box">
            <?php
                $connect=new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
                
                function Calcul_Temps($date){
                    $difference = date_diff(new DateTime($date),new DateTime(date("Y-m-d")));
                    return $difference;
                }
        
                $droit = $connect -> prepare("SELECT DATE_FACTURE FROM facture WHERE ID_CLIENT= :id_client ORDER BY DATE_FACTURE DESC LIMIT 1");
                $droit -> execute([':id_client' => $_SESSION['ID_CLIENT']]);
                $saisir = $droit -> fetch();
                if(!$saisir)
                {
                    ?>
                    <form action = "" method="post">
                    <input type="text" name="ID_CLIENT" hidden>
                    <input type="text" name="ID_FACTURE" hidden>
                    <input type="text" name="DATE_FACTURE" hidden>
                    <?php
                        $requete = $connect -> prepare('SELECT COUNT(*) AS nbr FROM facture WHERE ID_CLIENT= :id_client');
                        $requete -> execute([':id_client' => $_SESSION['ID_CLIENT']]);
                        $recherche = $requete -> fetch();
                        $_SESSION['nbr'] = $recherche['nbr'];
                            if($_SESSION['nbr']== 0)
                            {
                                ?>
                                <p>Dernière Saisie :</p><input type="text" id="consommation_ancienne" value="0" disabled><br>
                                <p>Valeur Actuelle du compteur :</p><input type="text" name="CONSOMMATION" id="consommation_actuelle" required><br>
                                <?php
                            }
                            else
                            {
                                $req = $connect -> prepare('SELECT CONSOMMATION FROM facture WHERE ID_CLIENT = :id_client ORDER BY DATE_FACTURE DESC LIMIT 1');
                                $req -> execute([':id_client' => $_SESSION['ID_CLIENT']]);
                                $compteur = $req -> fetch();
                                if($compteur)
                                {
                                    $_SESSION['CONSOMMATION'] = $compteur['CONSOMMATION'];
                                ?>
                                    <p>Dernière Saisie :</p><input type="text" id="consommation_ancienne" value="<?= $_SESSION['CONSOMMATION'] ?>" disabled><br>
                                    <p>Valeur Actuelle du compteur :</p><input type="text" name="CONSOMMATION" id="consommation_actuelle" required><br>
                                <?php
                                }
                                else
                                {
                                ?>
                                <script>
                                    alert('Erreur: Récupération de la DERNIERE SAISIE échouée');
                                </script>
                                <?php
                                }
                            }
                    ?>
                    <p>Prix HT :</p><input type="text" name="PRIX_HT" id="ht"><br>
                    <p>Prix TTC :</p><input type="text" name="PRIX_TTC" id="ttc"><br>
                    <input type="button" onclick="Calcul_Prix()" value="Calculer Prix">
                    <script>
                        function Calcul_Prix()
                        {
                            var consommation_ancienne = document.getElementById("consommation_ancienne").value;
                            var consommation_actuelle = document.getElementById("consommation_actuelle").value;
                            var consommation = consommation_actuelle - consommation_ancienne;
                            var prix_ht = document.getElementById("ht");
                            var prix_ttc = document.getElementById("ttc");
                            var ht, ttc;
                            
                            if(consommation <= 100 && consommation > 0)
                            {
                                ht = consommation * 0.91;
                            }
                            else if(consommation >= 101 && consommation <= 200)
                            {
                                ht = consommation * 1.01;
                            }
                            else if(consommation >= 201)
                            {
                                ht = consommation * 1.12;
                            }
                            else
                            {
                                alert('Veuillez entrer une valeur valide');
                            }
                            ttc = ht + ht * 0.014;
                            prix_ht.setAttribute("value", ht);
                            prix_ttc.setAttribute("value", ttc);
                        }
                    </script>
                    <br>
                    <input type="text" name="ID_FOURNISSEUR" value="0" hidden>
                    <input type="submit" name="Enregistrer" value="Enregistrer Facture">
                    <input type="submit" name="Payer" value="Payer Facture">
                    <input type="reset" name="reset" value="Effacer">
    
                </form>
                <?php
                    if(isset($_POST["Enregistrer"]))  
                    {   
                        $_SESSION['PRIX_HT'] = $_POST["PRIX_HT"];
                        $_SESSION['PRIX_TTC'] = $_POST["PRIX_TTC"];
                        $idfournisseur = 0;
                        $etat_enregistrer = 'Non Payée';
                        $query = "INSERT INTO facture (ID_CLIENT, DATE_FACTURE, CONSOMMATION, PRIX_HT, PRIX_TTC, ETAT_FACTURE, ID_FOURNISSEUR ) VALUES ( :id_client, :date_f, :consommation, :prix_ht, :prix_ttc, :etat_facture, :id_fournisseur )";
                        $reqpre = $connect->prepare($query);
                        $result=$reqpre->execute([
                            'id_client' => $_SESSION["ID_CLIENT"],
                            'date_f' => date('Y-m-d'),
                            'consommation' => $_POST["CONSOMMATION"],
                            'prix_ht' => $_SESSION["PRIX_HT"],
                            'prix_ttc' => $_SESSION["PRIX_TTC"],
                            'etat_facture' => $etat_enregistrer,
                            'id_fournisseur' => $idfournisseur
    
                        ]);
                ?>
                    <script>
                        window.location.replace("liste_facture_client.php");
                    </script>
                <?php
                    }
                    else if(isset($_POST["Payer"]))
                    {   
                        $idfournisseur = 0;
                        $etat_payer = 'Payée';
                        $query = "INSERT INTO facture (ID_CLIENT, CONSOMMATION, PRIX_HT, PRIX_TTC, ETAT_FACTURE, ID_FOURNISSEUR ) VALUES ( :id_client, :consommation, :prix_ht, :prix_ttc, :etat_facture, :id_fournisseur )";
                        $reqpre = $connect->prepare($query);
                        $result=$reqpre->execute([
                            'id_client' => $_SESSION["ID_CLIENT"],
                            'consommation' => $_POST["CONSOMMATION"],
                            'prix_ht' => $_POST["PRIX_HT"],
                            'prix_ttc' => $_POST["PRIX_TTC"],
                            'etat_facture' => $etat_payer,
                            'id_fournisseur' => $idfournisseur
    
                        ]);
                ?>
                
                <?php
                    }
                ?>
    
        
        <?php           
                }
                else
                {
                    $_SESSION['date'] = $saisir["DATE_FACTURE"];
        
                    $verification = Calcul_Temps($_SESSION['date']);
                    if($verification -> format("%a") < -1)
                    {
        ?>
                        <script>
                            alert('Il faut attendre un mois avant de saisir une autre facture!');
                            window.location.replace("liste_facture_client.php");
                        </script>
        <?php                
                    }
                    else
                    {
                
            ?>
            <form action = "" method="post">
                <input type="text" name="ID_CLIENT" hidden>
                <input type="text" name="ID_FACTURE" hidden>
                <input type="text" name="DATE_FACTURE" hidden>
                <?php
                    $requete = $connect -> prepare('SELECT COUNT(*) AS nbr FROM facture WHERE ID_CLIENT= :id_client');
                    $requete -> execute([':id_client' => $_SESSION['ID_CLIENT']]);
                    $recherche = $requete -> fetch();
                    $_SESSION['nbr'] = $recherche['nbr'];
                        if($_SESSION['nbr']== 0)
                        {
                            ?>
                            <p>Dernière Saisie :</p><input type="text" id="consommation_ancienne" value="0" disabled><br>
                            <p>Valeur Actuelle du compteur :</p><input type="text" name="CONSOMMATION" id="consommation_actuelle" required><br>
                            <?php
                        }
                        else
                        {
                            $req = $connect -> prepare('SELECT CONSOMMATION FROM facture WHERE ID_CLIENT = :id_client ORDER BY DATE_FACTURE DESC LIMIT 1');
                            $req -> execute([':id_client' => $_SESSION['ID_CLIENT']]);
                            $compteur = $req -> fetch();
                            if($compteur)
                            {
                                $_SESSION['CONSOMMATION'] = $compteur['CONSOMMATION'];
                            ?>
                                <p>Dernière Saisie :</p><input type="text" id="consommation_ancienne" value="<?= $_SESSION['CONSOMMATION'] ?>" disabled><br>
                                <p>Valeur Actuelle du compteur :</p><input type="text" name="CONSOMMATION" id="consommation_actuelle" required><br>
                            <?php
                            }
                            else
                            {
                            ?>
                            <script>
                                alert('Erreur: Récupération de la DERNIERE SAISIE échouée');
                            </script>
                            <?php
                            }
                        }
                ?>
                <p>Prix HT :</p><input type="text" name="PRIX_HT" id="ht"><br>
                <p>Prix TTC :</p><input type="text" name="PRIX_TTC" id="ttc"><br>
                <input type="button" onclick="Calcul_Prix()" value="Calculer Prix">
                <script>
                    function Calcul_Prix()
                    {
                        var consommation_ancienne = document.getElementById("consommation_ancienne").value;
                        var consommation_actuelle = document.getElementById("consommation_actuelle").value;
                        var consommation = consommation_actuelle - consommation_ancienne;
                        var prix_ht = document.getElementById("ht");
                        var prix_ttc = document.getElementById("ttc");
                        var ht, ttc;
                        
                        if(consommation <= 100 && consommation > 0)
                        {
                            ht = consommation * 0.91;
                        }
                        else if(consommation >= 101 && consommation <= 200)
                        {
                            ht = consommation * 1.01;
                        }
                        else if(consommation >= 201)
                        {
                            ht = consommation * 1.12;
                        }
                        else
                        {
                            alert('Veuillez entrer une valeur valide');
                        }
                        ttc = ht + ht * 0.014;
                        prix_ht.setAttribute("value", ht);
                        prix_ttc.setAttribute("value", ttc);
                    }
                </script>
                <br>
                <input type="text" name="ID_FOURNISSEUR" value="0" hidden>
                <input type="submit" name="Enregistrer" value="Enregistrer Facture">
                <input type="submit" name="Payer" value="Payer Facture">
                <input type="reset" name="reset" value="Effacer">

            </form>
            <?php
                if(isset($_POST["Enregistrer"]))  
                {   
                    $_SESSION['PRIX_HT'] = $_POST["PRIX_HT"];
                    $_SESSION['PRIX_TTC'] = $_POST["PRIX_TTC"];
                    $idfournisseur = 0;
                    $etat_enregistrer = 'Non Payée';
                    $query = "INSERT INTO facture (ID_CLIENT, DATE_FACTURE, CONSOMMATION, PRIX_HT, PRIX_TTC, ETAT_FACTURE, ID_FOURNISSEUR ) VALUES ( :id_client, :date_f, :consommation, :prix_ht, :prix_ttc, :etat_facture, :id_fournisseur )";
                    $reqpre = $connect->prepare($query);
                    $result=$reqpre->execute([
                        'id_client' => $_SESSION["ID_CLIENT"],
                        'date_f' => date('Y-m-d'),
                        'consommation' => $_POST["CONSOMMATION"],
                        'prix_ht' => $_SESSION["PRIX_HT"],
                        'prix_ttc' => $_SESSION["PRIX_TTC"],
                        'etat_facture' => $etat_enregistrer,
                        'id_fournisseur' => $idfournisseur

                    ]);
                }
                else if(isset($_POST["Payer"]))
                {   
                    $idfournisseur = 0;
                    $etat_payer = 'Payée';
                    $query = "INSERT INTO facture (ID_CLIENT, CONSOMMATION, PRIX_HT, PRIX_TTC, ETAT_FACTURE, ID_FOURNISSEUR ) VALUES ( :id_client, :consommation, :prix_ht, :prix_ttc, :etat_facture, :id_fournisseur )";
                    $reqpre = $connect->prepare($query);
                    $result=$reqpre->execute([
                        'id_client' => $_SESSION["ID_CLIENT"],
                        'consommation' => $_POST["CONSOMMATION"],
                        'prix_ht' => $_POST["PRIX_HT"],
                        'prix_ttc' => $_POST["PRIX_TTC"],
                        'etat_facture' => $etat_payer,
                        'id_fournisseur' => $idfournisseur

                    ]);
                }
            ?>

    </body>
</html>
<?php
        }
    }
}
?>