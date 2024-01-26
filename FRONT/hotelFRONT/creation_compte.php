<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php

if(isset($_POST['Valider']))
{
    include('functions/hotel_config.php');

    $data = array(
        "nom" => $_POST['name'],
        "prenom" => $_POST['prenom'],
        "email" => $_POST['mail'],
        "telephone" => $_POST['telephone'],
        "password" => $_POST['password'],
        "devise" => "Euro"
    );

    $api_url = $adresseBDD."/clients/create";

    $ch = curl_init($api_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
    curl_setopt($ch, CURLOPT_POST, true);            // Méthode POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Convertir les données en JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // En-tête JSON

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        $response_array = json_decode($response, true);

        if (isset($response_array['hotelId'])) {
            $hotel_id = $response_array['hotelId'];
        } else {
            echo "ID de l'hôtel non trouvé dans la réponse JSON";
        }
    }

    curl_close($ch);

 
    ?>


    <div class="login-container">
        <h2>Bienvenue !</h2>
        <p>Votre compte à bien été créé. Pour vous connecter, veuillez renseigner le code suivant ainsi que votre mot de passe:</p>
        <p><strong><?php
            echo $hotel_id;
        ?></strong></p>
        <p><a href="index.php">Se connecter</a></p>
    </div>

    <?php
    }
    else {

    ?>

<div class="login-container">
    <h2>Creer un compte</h2>
    <form method="post" action="?">
        <input type="text" name="name" placeholder="Votre Nom" required>
        <br>
        <input type="text" name="prenom" placeholder="Votre Prénom" required>
        <br>
        <input type="text" name="mail" placeholder="Votre Email" required>
        <br>
        <input type="text" name="telephone" placeholder="Numéro de téléphone" required>
        <br>
        <input type="password" name="password" placeholder="Votre mot de passe" required>
        <br>
        <button type="submit" name="Valider">Valider</button>
    </form>
    <p style="color: red;"><?php echo isset($error_message) ? $error_message : ''; ?></p>
</div>

<?php
    }

?>

</body>
</html>