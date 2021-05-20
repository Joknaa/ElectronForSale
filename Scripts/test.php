<?php
if (isset($_SESSION['idag'])) {

    $uploaddir = './images/';
    $uploadfile = $uploaddir . basename($_FILES["fileag"]["name"]);

    if (move_uploaded_file($_FILES['fileag']['tmp_name'], $uploadfile)) {
        $myfile = fopen($uploadfile, "r") or die("Unable to open file!");
        $i = 0;
        while (!feof($myfile)) {
            $tabag[$i] = fgets($myfile);
            $i++;
        }

        $a = 0;
        $b = 0;

        for ($i = 0; $i < count($tabag); $i++, $b++, $a = 0) {
            $tok = strtok($tabag[$i], " ,");
            while ($tok !== false) {
                $tab2[$b][$a] = $tok;
                $a++;
                $tok = strtok(",");
            }
        }

    }
    for ($i = 0; $i < count($tab2); $i++) {
        $connexion_bd = new PDO('mysql:host=localhost;port=3308;dbname=pw2_tp2;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $requete1 = $connexion_bd->prepare('INSERT INTO `consommation_annuelle` (`ID_CLIENT`, `CONSOMMATION`, `ANNEE`, `ID_AGENT`) VALUES (?, ?, ?, ?);');
        $requete1->execute(array($tab2[$i][0], $tab2[$i][1], $tab2[$i][2], $tab2[$i][3]));
        $requete1->closeCursor();
    }
    echo "<div style='color: red; position: absolute; top: 30%; left : 20%; font-size: 30px;'>VOTRE FICHIER EST UPLOADER DANS LA BASE DE DONNEE AVEC SUCCES !!</div>";
    echo "<div class='connexion1'><a href = 'ag_dhb.php'><input type='button' name='acc' class='btn'  value='RETOUR' /></a><div>";
    fclose($myfile);
}