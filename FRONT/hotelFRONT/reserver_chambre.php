<?php
// fichier de configuration global
include('functions/hotel_config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #4caf50;
            padding: 10px;
            text-align: center;
            border-bottom: 2px solid #000;
            border-radius: 10px 10px 0 0;
        }

        nav {
            background-color: #4caf50;
            overflow: hidden;
            border-radius: 0 0 10px 10px;
            border: 2px solid #000;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #45a049;
        }

        nav a:last-child {
            float: right;
        }

        .main-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            min-height: 175px; 
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .footer-icons {
            font-size: 24px;
            margin: 0 5px;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>Mon Site d'Hôtel</h1>
</header>

<nav>
    <a href="accueil.php">Accueil</a>
    <a href="mes_reservations.php">Mes réservations</a>
    <a href="reserver_chambre.php">Réserver une chambre</a>
    <a href="mon_profil.php">Mon profil</a>
    <a href="deconnexion.php">Déconnexion</a>
</nav>

<div class="main-container">
    <h2>Chambre standard</h2>
    <p><img src="img/standard.jpeg"></p>
    <form method=post action=res_standard.php>
        Date de début: <input type=date name=datedebut><br>
        Date de fin: <input type=date name=datefin><br>
        <input type=submit name=reserverStandard value=Réserver>
    </form>
</div>

<div class="main-container">
    <h2>Chambre supérieure</h2>
    <p><img src="img/superieur.jpeg"></p>
    <form method=post action=res_superieur.php>
        Date de début: <input type=date name=datedebut><br>
        Date de fin: <input type=date name=datefin><br>
        <input type=submit name=reserverStandard value=Réserver>
    </form>
</div>

<div class="main-container">
    <h2>Suite</h2>
    <p><img src="img/suite.jpeg"></p>
    <form method=post action=res_suite.php>
        Date de début: <input type=date name=datedebut><br>
        Date de fin: <input type=date name=datefin><br>
        <input type=submit name=reserverStandard value=Réserver>
    </form>
</div>


</body>
</html>
