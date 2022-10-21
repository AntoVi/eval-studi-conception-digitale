<?php
require_once 'init.php';

require_once 'inc/header.php';
require_once 'inc/nav.php';

// Si l'indice 'action' est définit dans l'URL et qu'il a pour valeur 'deconnexion', cela veut dire que l'internaute a cliqué sur le lien de deconnexion et par conséquent qu'i;l a envoyé dans l'URL 'action=deconnexion'
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
    // On vide le tableau ['admin'] dans la session lorsque l'internaute clique sur le lien de deconnexion
    unset($_SESSION['user']);
}

?>

<h1 class="text-center my-5">Site de gestion agents et mission</h1>

<p class="text-center my-5"> Bienvenue sur la page d'accueil de l'application de gestion de missions, vous pouvez créer vos missions et les modifier en plus de leur 
    assigner des agents  et suivre leur statut </p>

    <button class="btn btn-primary mx-auto" > <a href="agents/listeAgent.php" class="text-light"> Accès aux agents </a></button> 
    <button class="btn btn-primary mx-auto" > <a href="contacts/listeContact.php" class="text-light"> Accès aux contacts </a></button>
    <button class="btn btn-primary mx-auto" > <a href="cibles/listeCible.php" class="text-light"> Accès aux cibles </a></button>
    <button class="btn btn-primary mx-auto" > <a href="planques/listePlanque.php" class="text-light"> Accès aux planques </a></button>