<?php
session_start();
    $connect = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root','');
    if(isset($_SESSION['ID_FOURNISSEUR']))
    {
            if(isset($_POST['Submit']))
            {
                $_SESSION['REPONSE_RECLAMATION'] = $_POST['REPONSE_RECLAMATION'];
                $_SESSION['ETAT_RECLAMATION'] = $_POST['ETAT_RECLAMATION'];
            
                $req = $connect->prepare('UPDATE reclamation SET ID_CLIENT = :id_client, OBJET_RECLAMATION = :objet, MESSAGE_RECLAMATION = :msg, DATE_MESSAGE = :dat, ETAT_RECLAMATION = :etat, REPONSE_RECLAMATION= :reponse, ID_FOURNISSEUR= :idfour WHERE ID_RECLAMATION= :id_reclam LIMIT 1');
                
                $req -> bindValue(':id_reclam', $_SESSION['ID_RECLAMATION'],PDO :: PARAM_INT);
                $req -> bindValue(':id_client', $_SESSION['ID_CLIENT'],PDO :: PARAM_INT);
                $req -> bindValue(':objet', $_SESSION['OBJET_RECLAMATION'],PDO :: PARAM_STR);
                $req -> bindValue(':msg', $_SESSION['MESSAGE_RECLAMATION'],PDO :: PARAM_STR);
                $req -> bindValue(':dat', $_SESSION['DATE_MESSAGE'],PDO :: PARAM_STR);
                $req -> bindValue(':etat', $_SESSION['ETAT_RECLAMATION'],PDO :: PARAM_STR);
                $req -> bindValue(':reponse', $_SESSION['REPONSE_RECLAMATION'],PDO :: PARAM_STR);
                $req -> bindValue(':idfour', $_SESSION['ID_FOURNISSEUR'],PDO :: PARAM_INT);

                $result = $req->execute();

                if($result)
                {
                    header('Location: liste_reclamation_fournisseur.php');
                }

                else
?>
        <script> alert('Modification a échouée!!'); </script>
<?php
            }
            
    }
    
?>