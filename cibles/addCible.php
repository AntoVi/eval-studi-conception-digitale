<?php
require_once '../init.php';

require_once '../inc/header.php';
// On démarre une session


if($_POST){
    if(isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['birthdate']) && !empty($_POST['birthdate'])
    && isset($_POST['codename']) && !empty($_POST['codename'])
    && isset($_POST['nationalite']) && !empty($_POST['nationalite'])){
    
        // On nettoie les données envoyées
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $birthdate = strip_tags($_POST['birthdate']);
        $codename = strip_tags($_POST['codename']);
        $nationalite = strip_tags($_POST['nationalite']);
       
        

        $sql = 'INSERT INTO `cible` (`nom`, `prenom`,`birthdate`,`codename`, `nationalite` ) VALUES (:nom, :prenom, :birthdate, :codename, :nationalite );';

        $query = $db->prepare($sql);

        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':birthdate', $birthdate,  PDO::PARAM_STR);
        $query->bindValue(':codename', $codename, PDO::PARAM_STR);
        $query->bindValue(':nationalite', $nationalite, PDO::PARAM_STR);
      

        $query->execute();

        $_SESSION['message'] = "Cible ajoutée";
        require_once('../close.php');

        header('Location: listeCible.php');
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
    <title>Ajouter une cible</title>

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
                <h1>Ajouter une cible</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Date de naissance</label>
                        <input type="date" id="birthdate" name="birthdate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="codename">Nom de code</label>
                        <input type="text" id="codename" name="codename" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nationalite">Nationalité</label>
                        <input type="text" id="nationalite" name="nationalite" class="form-control">
                    </div>
                 
                    <button class="btn btn-primary mt-3">Envoyer</button>
                    <a href="listeCible.php" class="btn btn-primary mt-3">Retour</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>