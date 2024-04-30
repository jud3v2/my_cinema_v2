<?php

// ! Récupère l'email de l'uutilisateur et vas vérifier si la personne possèdent un abonnement, si la personne n'en possèdent pas retourner un tableau vide.

include_once "../../../Model/Subscription.php";

$subscription = new Subscription();
http_response_code(200);
header('Content-Type: application/json');
echo json_encode($subscription->joinUserAndMembership($_GET['email']));