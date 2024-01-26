<?php
include('functions/hotel_config.php');

//var_dump($_SESSION);


// Traitement des dates
$datedebut = $_POST['datedebut'];
$datefin = $_POST['datefin'];

$origin = new DateTime($datedebut);
$target = new DateTime($datefin);
$interval = $origin->diff($target);
$diff = $interval->days;

$prixSuite = 200;
// Verification des fonds
$api_url_portefeuille = $adresseBDD."/portefeuille/afficher/".$_SESSION['portfeuille_id'];
//var_dump($api_url_portefeuille);
// Initialiser la session cURL pour le portefeuille
$ch_portefeuille = curl_init($api_url_portefeuille);

// Configurer les options de la requête pour le portefeuille
curl_setopt($ch_portefeuille, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
curl_setopt($ch_portefeuille, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // En-tête JSON

// Exécuter la requête pour le portefeuille
$response_portefeuille = curl_exec($ch_portefeuille);

// Vérifier les erreurs cURL pour le portefeuille
if (curl_errno($ch_portefeuille)) {
    echo 'Erreur cURL portefeuille: ' . curl_error($ch_portefeuille);
} else {
    // Décoder la réponse JSON pour le portefeuille
    $portefeuille_data = json_decode($response_portefeuille, true);

    $soldeClient = $portefeuille_data['solde'];
}


$calculverif = (($prixSuite * $diff)/2);

if($soldeClient < $calculverif)
{
    echo "<h2>Solde insufisant !";
}
else
{
    // création de la suite
    $api_url = $adresseBDD."/chambres/suite";

    // Initialiser la session cURL
    $ch = curl_init($api_url);

    // Configurer les options de la requête
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
    curl_setopt($ch, CURLOPT_POST, true);            // Méthode POST

    // Exécuter la requête
    $response = curl_exec($ch);

    // Vérifier les erreurs cURL
    if (curl_errno($ch)) {
        echo 'Erreur cURL création: ' . curl_error($ch);
    } else {
        // Décoder la réponse JSON
        $data = json_decode($response, true);

        // Récupérer l'ID de la suite
        $suite_id = $data['id'];

        // Afficher l'ID de la suite
        echo "ID de la suite : " . $suite_id;
    }

    // Fermer la session cURL
    curl_close($ch);


    // reservation
    // Données à envoyer
    $data = array(
        'clientId' => $_SESSION['id_client'],
        'portefeuilleId' => $_SESSION['portefeuille_id'],
        'chambreId' => $suite_id,
        'dateDebut' => $datedebut,
        'dateFin' => $datefin,
        'prixChambre' => $prixSuite
    );

    $api_url = $adresseBDD."/reservation/creer";

    // Initialiser la session cURL
    $ch = curl_init($api_url);

    // Convertir les données en format JSON
    $json_data = json_encode($data);

    // Configurer les options de la requête
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
    curl_setopt($ch, CURLOPT_POST, true);            // Méthode POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Données à envoyer
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // En-tête JSON

    // Exécuter la requête
    $response = curl_exec($ch);

    // Vérifier les erreurs cURL
    if (curl_errno($ch)) {
        echo 'Erreur cURL reservation: ' . curl_error($ch);
    } else {
        // Afficher la réponse de l'API
        echo $response;
    }

    // Fermer la session cURL
    curl_close($ch);

    // débiter le client
    $api_url = $adresseBDD."/portefeuille/debiter/".$_SESSION['portefeuille_id'];

    // Initialiser la session cURL
    $ch = curl_init($api_url);

    // Convertir l'entier en format JSON
    $json_data = json_encode($calculverif);

    // Configurer les options de la requête
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Récupérer la réponse
    curl_setopt($ch, CURLOPT_POST, true);            // Méthode POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Données à envoyer
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // En-tête JSON

    // Exécuter la requête
    $response = curl_exec($ch);

    // Vérifier les erreurs cURL
    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        // Afficher la réponse de l'API
        echo $response;
    }

    // Fermer la session cURL
    curl_close($ch);



    //header
    header('Location: mes_reservations.php');
}


?>