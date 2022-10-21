<?php
require_once '../init.php';

require_once '../inc/header.php';
// On démarre une session


if($_POST){
    if(isset($_POST['code']) && !empty($_POST['code'])
    && isset($_POST['adresse']) && !empty($_POST['adresse'])
    && isset($_POST['pays']) && !empty($_POST['pays'])
    && isset($_POST['type']) && !empty($_POST['type'])){
    
        // On nettoie les données envoyées
        $code = strip_tags($_POST['code']);
        $adresse = strip_tags($_POST['adresse']);
        $pays = strip_tags($_POST['pays']);
        $type = strip_tags($_POST['type']);
       
        

        $sql = 'INSERT INTO `planque` (`code`, `adresse`, `pays`, `type`) VALUES (:code, :adresse, :pays, :type);';

        $query = $db->prepare($sql);

        $query->bindValue(':code', $code, PDO::PARAM_INT);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindValue(':pays', $pays,  PDO::PARAM_STR);
        $query->bindValue(':type', $type, PDO::PARAM_STR);
      
        $query->execute();

        $_SESSION['message'] = "Planque ajoutée";
        require_once('../close.php');

        header('Location: listePlanque.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Planque</title>

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
                <h1>Ajouter une Planque</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" id="code" name="code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pays">Pays</label>
                        <input type="text" id="pays" name="pays" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" id="type" name="type" class="form-control">
                    </div>
                  
                    
                    
                    <button class="btn btn-primary mt-3">Envoyer</button>
                    <a href="listePlanque.php" class="btn btn-primary mt-3">Retour</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>