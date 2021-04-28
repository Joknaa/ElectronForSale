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
        div.choisir {
                padding-top:13%;
                float:right;
                padding-right: 8%;
            }
        div.choisir a{
            font-weight:bolder;
            text-transform: lowercase;
            font-size: 30px;
            text-decoration: none;
            text-align: center;
            color:#fff;
            border: 2px solid #fff;
            border-radius: 30px;
            width: 240px;
            padding: 10px;
            display: inline-block;
            margin: 10px;
        }
        div.choisir a:hover{
            color:#204636;
            font-weight: bolder;
            border-radius:30px;
            border-color: #fff;
            background-color: #fff;
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
            <div class="choisir">
                <a href="connexion_fournisseur.php">Fournisseur</a><br>
                <a href="connexion_client.php">Client</a>
            </div>
        </div>
    <footer>
        <div class="foot">
            <a class="footer" href="accueil.php">|| Accueil ||</a><br>
              ©Hilali_Hajar
        </div>
    </footer>

    </body>
</html>