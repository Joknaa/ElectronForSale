<?php
    session_start();
        $connect = new PDO('mysql:host=localhost;dbname=facturation','root','');

        if(isset($_POST["Submit"]))
        {
            $email = $_POST["EMAIL_CLIENT"];
            $mdp = $_POST["MDP_CLIENT"];

            if($email && $mdp)
            {
                $requette = $connect->prepare("SELECT * FROM client WHERE EMAIL_CLIENT = '$email'");
                $requette->execute(['EMAIL_CLIENT'=> $email]);
                $resultat = $requette->fetch();

                if($resultat)
                {
                    if(password_verify($mdp,$resultat['MDP_CLIENT']))
                    {
                        $_SESSION["ID_CLIENT"] = $resultat["ID_CLIENT"];
                        $_SESSION["NOM_CLIENT"] = $resultat["NOM_CLIENT"];
                        $_SESSION["PRENOM_CLIENT"] = $resultat["PRENOM_CLIENT"];
                        $_SESSION["ADRESSE_CLIENT"] = $resultat["ADRESSE_CLIENT"];
                        $_SESSION["TELEPHONE_CLIENT"] = $resultat["TELEPHONE_CLIENT"];
                        $_SESSION["EMAIL_CLIENT"] = $resultat["EMAIL_CLIENT"];
                        $_SESSION["MDP_CLIENT"] = $resultat["MDP_CLIENT"];
                        header('location:ClientInfo.php');
                    }
                    else
                    {
                        echo '<script> alert("Le login ou le mot de passe n\'est pas correct!")</script>';
                    }
                }
            }
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Accueil </title>
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
                <h1>Client</h1><br>
                <input class="input" type="email" name="EMAIL_CLIENT" placeholder="Email" required>
                <input class="input" type="password" name="MDP_CLIENT" placeholder="Mot De Passe" required>
                <input type="Submit" name="Submit" value="Se Connecter">
            </form>
        </div>
    <footer>
        <div class="foot">
            <a class="footer" href="accueil.php">|| Accueil ||</a><br>
              ©Hilali_Hajar
        </div>
    </footer>

    </body>
</html>