<?php
// On démarre une session

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('../init.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `agents` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère la liste
    $liste = $query->fetch();

    // On vérifie si l'agent existe
    if(!$liste){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: listeAgent.php');
        die();
    }

    $sql = 'DELETE FROM `agents` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Agent supprimé";
    header('Location: listeAgent.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listeAgent.php');
}