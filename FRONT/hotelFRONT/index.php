<?php
// fichier de configuration global
include('functions/hotel_config.php');

if(isset($_POST['Connexion']))
{
$api_url = $adresseBDD."/seconnecter";

$login = $_POST['login'];
$pass = $_POST['password'];
$data = array(
    "hotelID" => $login,
    "motdepasse" => $pass
);

$ch = curl_init($api_url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
curl_setopt($ch, CURLOPT_POST, true);            // Méthode POST
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Convertir les données en JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // En-tête JSON

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Erreur cURL : ' . curl_error($ch);
}

curl_close($ch);

$response_array = json_decode($response, true);

$retour = $response_array['resultat']['success'];
if($retour == TRUE)
{
    $_SESSION['id_client'] = $response_array['resultat']['clientId'];
    header('Location:functions/session_config.php');
}
if($retour == FALSE)
{
    $error_message = "Login et/ou mot de passe incorect";
}
}


?>
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

<div class="login-container">
    <h2>Login</h2>
    <form method="post" action="?">
        <input type="text" name="login" placeholder="Votre login" required>
        <br>
        <input type="password" name="password" placeholder="Votre mot de passe" required>
        <br>
        <button type="submit" name="Connexion">Se connecter</button>
    </form>
    <br><a href="creation_compte.php">Creer un compte</a>
    <p style="color: red;"><?php echo isset($error_message) ? $error_message : ''; ?></p>
</div>

</body>
</html>



