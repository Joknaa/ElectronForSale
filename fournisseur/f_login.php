<?php
    session_start();
        $connect = new PDO('mysql:host=localhost;dbname=facturation','root','');

        if(isset($_POST["Submit"]))
        {
            $login = $_POST["EMAIL"];
            $mdp_f = $_POST["MDP_F"];

            if($login && $mdp_f)
            {
                $requette = $connect->prepare("SELECT * FROM fournisseur WHERE EMAIL = '$login'");
                $requette->execute(['EMAIL'=> $login]);
                $resultat = $requette->fetch();

                if($resultat)
                {
                    if(password_verify($mdp_f,$resultat["MDP_F"]))
                    {
                        $_SESSION["ID_FOURNISSEUR"] = $resultat["ID_FOURNISSEUR"];
                        $_SESSION["NOM_F"] = $resultat["NOM_F"];
                        $_SESSION["PRENOM_F"] = $resultat["PRENOM_F"];
                        $_SESSION["EMAIL"] = $resultat["EMAIL"];
                        $_SESSION["MDP_F"] = $resultat["MDP_F"];
                        header('location:fournisseur.php');
                    }
                    else
                    {
                        echo '<script> alert("Données incorrectes!")</script>';
                    }
                }
            }
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Connexion </title>
        <link href="logo1.png" rel="icon">
    </head>

    <body>

    <style>
        body{
            padding: 0;
            margin: 0;
        }
        div.head{
            position: relative;
            height: 70px;
            background-color: #BACBC4;
            padding-top: 2px;
            
        }
        h1{
            color: #204636;
            text-transform: uppercase;
        }
        img.logo{
            width: 40px;
            height:auto;
            padding-left: 1%;
            float:left;
            padding-right: 23%;
        }
        .Conteneur{
            background-image: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url("bg.jpg");
            background-position: center center;
            -webkit-background-size: cover;
            background-size: cover;
            height: 80vh;
        }
        .box{
            width: 300px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 20px;
            transform: translate(70%,-50%);
            background-color: rgba(168, 178, 186, 0.3);
            text-align: center;
        }
        .box h1{
            color: #fff;
            text-transform: uppercase;
            font-weight: bolder;
            opacity: 1;
        }
        .box input[type="email"], .box input[type="password"]{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            font-weight: bolder;
            border: 2px solid #54DFA5;
            padding: 14px 10px;
            width: 200px;
            outline: none;
            color: #ECF2F7;
            border-radius: 24px;
            transition: 0.25s;
        }
        .box input[type="email"]:focus, .box input[type="password"]:focus{
            width: 280px;
            border-color: #54DFA5;
            opacity:1;
        }
        .box input[type="submit"]{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            font-weight: bolder;
            border: 2px solid #32C487;
            padding: 14px 40px;
            outline: none;
            color: #ECF2F7;
            border-radius: 24px;
            transition: 0.25s;
            cursor:pointer;
        }
        .box input[type="submit"]:hover{
            background-color:#32C487;
            opacity:1.5;
           
        }
        .foot{
            position: relative;
            height: 45px;
            background-color: #BACBC4;
            text-align:center;
            color:#204636;
            padding-top: 10px;
            font-weight: bold;
        }
        a.footer{
            text-decoration:none;
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#204636;
        }

    </style>
    <div class="head">
        <header>
            <img class="logo" src="logo1.png">
            <h1> Contrôler Vos Factures à Distance </h1>
        </header>
    </div>    
        <div class="Conteneur">
            <form class="box" method="post">
                <h1>Fournisseur</h1><br>
                <input class="input" type="email" name="EMAIL" placeholder="Email" required>
                <input class="input" type="password" name="MDP_F" placeholder="Mot de passe" required>
                <input type="Submit" name="Submit" value="Se Connecter">
            </form>
        </div>
    <footer>
        <div class="foot">
            <a class="footer" href="accueil.php">Accueil</a><br>
          
        </div>
    </footer>

    </body>
</html>