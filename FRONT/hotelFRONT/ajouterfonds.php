<?php
// fichier de configuration global
include('functions/hotel_config.php');
include('functions/connexion.php');

if(isset($_POST['valider']))
{
    
    $data = $_POST['fonds'];

    
    $api_url = $adresseBDD."/portefeuille/crediter/".$_SESSION['portefeuille_id'];

   
    $ch = curl_init($api_url);
    //var_dump($api_url);
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
    curl_setopt($ch, CURLOPT_POST, true);            // Méthode POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);     // Données à envoyer
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // En-tête JSON

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        echo $response;
    }

    curl_close($ch);

    header('Location: mon_profil.php');
}
if(isset($_POST['annuler']))
{
    header('Location: mon_profil.php');
}

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
    <h2>Ajouter des fonds</h2>
            <form method=post action=ajouterfonds.php>
            <center>
                Fond à ajouter: <input type=text name=fonds>
                <input type=submit name=valider value=valider>
                <input type=submit name=annuler value=annuler>
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
