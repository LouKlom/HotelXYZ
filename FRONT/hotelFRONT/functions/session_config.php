<?php
// fichier de configuration global
include('hotel_config.php');

$api_url = $adresseBDD."/clients/".$_SESSION['id_client'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
curl_setopt($ch, CURLOPT_HTTPGET, true);         
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Erreur cURL : ' . curl_error($ch);
}

curl_close($ch);

$response_array = json_decode($response, true);

$_SESSION['varverif'] = 1337;

$_SESSION['Nom'] = $response_array['nom'];
$_SESSION['prenom'] = $response_array['prenom'];
$_SESSION['adresse_mail'] = $response_array['email'];
$_SESSION['telephone'] = $response_array['telephone'];
$_SESSION['portefeuille_id'] = $response_array['portefeuilleid'];



header('Location: ../accueil.php');