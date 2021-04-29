<?php 
session_start();
    $connect = new PDO ('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
    if(isset($_SESSION['NOM_F']))
    {
        $req = $connect->prepare('UPDATE client SET NOM_CLIENT= :nom, PRENOM_CLIENT= :prenom, ADRESSE_CLIENT= :adresse, TELEPHONE_CLIENT= :telephone, EMAIL_CLIENT= :email, STATUT_CLIENT= :statut WHERE ID_CLIENT= :id_client LIMIT 1');
        
        $req -> bindValue(':id_client', $_POST['ID_CLIENT'],PDO :: PARAM_INT);
        $req -> bindValue(':nom', $_POST['NOM_CLIENT'],PDO :: PARAM_STR);
        $req -> bindValue(':prenom', $_POST['PRENOM_CLIENT'],PDO :: PARAM_STR);
        $req -> bindValue(':adresse', $_POST['ADRESSE_CLIENT'],PDO :: PARAM_STR);
        $req -> bindValue(':telephone', $_POST['TELEPHONE_CLIENT'],PDO :: PARAM_INT);
        $req -> bindValue(':email', $_POST['EMAIL_CLIENT'],PDO :: PARAM_STR);
        $req -> bindValue(':statut', $_POST['STATUT_CLIENT'],PDO :: PARAM_STR);
        

        $result = $req->execute();

        if($result)
        {
            header('Location: liste_client.php');
        }
        else
?>
        <script> alert('Modification a échouée!!'); </script>
<?php
    }
?>  