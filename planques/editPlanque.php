<?php
require_once '../init.php';

require_once '../inc/header.php';
require_once '../inc/nav.php';

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['code']) && !empty($_POST['code'])
    && isset($_POST['adresse']) && !empty($_POST['adresse'])
    && isset($_POST['pays']) && !empty($_POST['pays'])
    && isset($_POST['type']) && !empty($_POST['type'])){
        
        
        
        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $code = strip_tags($_POST['code']);
        $adresse = strip_tags($_POST['adresse']);
        $pays = strip_tags($_POST['pays']);
        $type = strip_tags($_POST['type']);
        
        


        $sql = 'UPDATE `planque` SET `code`=:code, `adresse`=:adresse, `pays`=:pays,`type`=:type
        WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':code', $code, PDO::PARAM_INT);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindValue(':pays', $pays, PDO::PARAM_STR);
        $query->bindValue(':type', $type, PDO::PARAM_STR);
      
        $query->execute();

        $_SESSION['message'] = "Contact modifiée";
        require_once('../close.php');

        header('Location: listeContact.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
  

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `planque` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère la liste
    $code = $query->fetch();

    // On vérifie si la liste existe
    if(!$id){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: listeCible.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listeCible.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une planque</title>

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
                <h1>Modifier une planque</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="number" id="code" name="code" class="form-control" value="<?= $code['code']?>">
                    </div>
    
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control" value="<?= $code['adresse']?>">
                    </div>
                    <div class="form-group">
                        <label for="pays">Pays</label>
                        <input type="text" id="pays" name="pays" class="form-control" value="<?= $code['pays']?>">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" id="type" name="type" class="form-control" value="<?= $code['type']?>">
                    </div>
                    
                    <input type="hidden" value="<?= $code['id']?>" name="id">
                    <button class="btn btn-primary mt-3">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>