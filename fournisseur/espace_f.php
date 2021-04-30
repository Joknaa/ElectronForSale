<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../CSS/espace_f.css"/>
        <title> Espace fournisseur </title>
        <link href="logo1.png" rel="icon"> 
        <link href='bg.png' rel='icon'>
    </head>

    <body>

    <?php include "../Include/Menu.php"; ?>
    
    <div class="head">
        <header>
            <img class="logo" src="logo1.png">
           
        </header>
    </div>    
        <div class="Conteneur">
            <div class="choisir">

            <center>
                <a href="ajouter_client.php">Ajouter un client</a><br>
            </center>
            </div>
        </div>


        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>       
                    <th>Email</th>                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $connect = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8','root', '' );
                    $requette=$connect->prepare("SELECT * FROM facturation_client ORDER BY id_client ASC");
                    $requette->execute();  
                    while($resultat=$requette->fetch())
                    {                 
                ?>
                <tr>
                    <td data-label="Nom"><?php echo $resultat['NOM_CLIENT'];?></td>
                    <td data-label="Prenom"><?php echo $resultat['PRENOM_CLIENT'];?></td>
                    <td data-label="Email"><?php echo $resultat['EMAIL_CLIENT'];?></td>
                    <td data-label="Action">
                        <button type="button" class="Modifier"><a href="modifier_client.php?id_client=<?= $resultat['id_client']?>">Modifier</a></button> 
                    </td>
                </tr>
                    <?php
                        }
                        $requette->closeCursor();
                    ?>
            </tbody>
        </table>

        <footer>
            <div class="foot">
                <a class="footer" href="index.php"> Accueil </a><br>
              
            </div>
        </footer>
</body>
</html>