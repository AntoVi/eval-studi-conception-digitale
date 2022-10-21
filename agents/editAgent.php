<?php
require_once '../init.php';

require_once '../inc/header.php';
require_once '../inc/nav.php';

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['birthdate']) && !empty($_POST['birthdate'])
    && isset($_POST['nationalite']) && !empty($_POST['nationalite'])
    && isset($_POST['specialite']) && !empty($_POST['specialite'])
    && isset($_POST['codename']) && !empty($_POST['codename'])){
        
        
        
        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $birthdate = strip_tags($_POST['birthdate']);
        $nationalite = strip_tags($_POST['nationalite']);
        $specialite = strip_tags($_POST['specialite']);
        $codename = strip_tags($_POST['codename']);


        $sql = 'UPDATE `agents` SET `nom`=:nom, `prenom`=:prenom, `birthdate`=:birthdate, `nationalite`=:nationalite, `specialite`=:specialite, `codename`=:codename 
        WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
        $query->bindValue(':nationalite', $nationalite, PDO::PARAM_STR);
        $query->bindValue(':specialite', $specialite, PDO::PARAM_STR);
        $query->bindValue(':codename', $codename, PDO::PARAM_STR);
        
        

        $query->execute();

        $_SESSION['message'] = "Agent modifié";
        require_once('../close.php');

        header('Location: listeAgent.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
  

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
    $nom = $query->fetch();

    // On vérifie si la liste existe
    if(!$id){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: listeAgent.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listeAgent.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un agent</title>

</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger mt-2" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Modifier un agent</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" value="<?= $nom['nom']?>">
                    </div>
    
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" value="<?= $nom['prenom']?>">
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Date de naissance</label>
                        <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?= $nom['birthdate']?>">
                    </div>
                    <div class="form-group">
                        <label for="nationalite">Nationalité</label>
                        <input type="text" id="nationalite" name="nationalite" class="form-control" value="<?= $nom['nationalite']?>">
                    </div>
                    <div class="form-group">
                        <label for="specialite">Spécialité</label>
                        <input type="text" id="specialite" name="specialite" class="form-control" value="<?= $nom['specialite']?>">
                    </div>
                    <div class="form-group">
                        <label for="codename">Nom de code</label>
                        <input type="text" id="codename" name="codename" class="form-control" value="<?= $nom['codename']?>">
                    </div>
                    <input type="hidden" value="<?= $nom['id']?>" name="id">
                    <button class="btn btn-primary mt-3">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>