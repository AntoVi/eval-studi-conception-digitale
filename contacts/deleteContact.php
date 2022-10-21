<?php
// On démarre une session

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('../init.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `contact` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère la liste
    $liste = $query->fetch();

    // On vérifie si le contact existe
    if(!$liste){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: listeContact.php');
        die();
    }

    $sql = 'DELETE FROM `contact` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "contact supprimé";
    header('Location: listeContact.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listeContact.php');
}