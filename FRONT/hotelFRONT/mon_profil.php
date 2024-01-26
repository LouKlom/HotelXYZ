<?php
// fichier de configuration global
include('functions/hotel_config.php');
include('functions/connexion.php');

//var_dump($_SESSION);

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
            min-height: 200px; 
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
    <h2>Mon profil</h2>
    <p>
        Nom: <?php echo $_SESSION['Nom']?><br>
        Prenom: <?php echo $_SESSION['prenom']?><br>
        Mail: <?php echo $_SESSION['adresse_mail']?><br>
        Numéro Telephone: <?php echo $_SESSION['telephone']?>
    </p><br>
    </p><center>
        <form method=post action=modifier_client.php>
            <button type=submit name=modifierclient>Modifier</button>
        </form>
    </center><p>
</div>

<div class="main-container">
    <h2>Mon portefeuille</h2>
    <?php 
        $api_url_portefeuille = $adresseBDD."/portefeuille/afficher/".$_SESSION['portefeuille_id'];
        
        $ch_portefeuille = curl_init($api_url_portefeuille);
    
        curl_setopt($ch_portefeuille, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
        curl_setopt($ch_portefeuille, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // En-tête JSON
    
        $response_portefeuille = curl_exec($ch_portefeuille);
    
        if (curl_errno($ch_portefeuille)) {
            echo 'Erreur cURL : ' . curl_error($ch_portefeuille);
        } else {
            $portefeuille_data = json_decode($response_portefeuille, true);
    
            echo "ID du portefeuille : " . $portefeuille_data['id'] . "<br>";
            echo "Solde du portefeuille : " . $portefeuille_data['solde'] . "<br>";
            echo "Devise du portefeuille : " . $portefeuille_data['devise'] . "<br>";
        }
        curl_close($ch_portefeuille);
        ?>
        <form method=post action=ajouterfonds.php>
            <center>
                <button type=submit name=ajouterfonds>Ajouter des fonds</button>
            </center>
        </form>
</div>


<footer>
    <p>Mentions légales</p>
    <a href="#" class="footer-icons"><i class="fab fa-facebook"></i></a>
    <a href="#" class="footer-icons"><i class="fab fa-twitter"></i></a>
    <a href="#" class="footer-icons"><i class="fab fa-instagram"></i></a>
    <a href="#" class="footer-icons"><i class="fab fa-telegram"></i></a>
</footer>

</body>
</html>
