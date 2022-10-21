<?php
require_once '../init.php';

require_once '../inc/header.php';



if($_POST){
    if(isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_POST['description']) && !empty($_POST['description'])
    && isset($_POST['codename']) && !empty($_POST['codename'])
    && isset($_POST['pays']) && !empty($_POST['pays'])
    && isset($_POST['agents']) && !empty($_POST['agents'])
    && isset($_POST['contacts']) && !empty($_POST['contacts'])
    && isset($_POST['cibles']) && !empty($_POST['cibles'])
    && isset($_POST['statut']) && !empty($_POST['statut'])
    && isset($_POST['planque']) && !empty($_POST['planque'])
    && isset($_POST['specialite']) && !empty($_POST['specialite'])
    && isset($_POST['startdate']) && !empty($_POST['startdate'])
    && isset($_POST['enddate']) && !empty($_POST['enddate'])){
    
        // On nettoie les données envoyées
        $titre = strip_tags($_POST['titre']);
        $description = strip_tags($_POST['description']);
        $codename = strip_tags($_POST['codename']);
        $pays = strip_tags($_POST['pays']);
        $agents = strip_tags($_POST['agents']);
        $contacts = strip_tags($_POST['contacts']);
        $cibles = strip_tags($_POST['cibles']);
        $statut = strip_tags($_POST['statut']);
        $planque = strip_tags($_POST['planque']);
        $specialite = strip_tags($_POST['specialite']);
        $startdate = strip_tags($_POST['startdate']);
        $enddate = strip_tags($_POST['enddate']);
       
        

        $sql = 'INSERT INTO `mission` (`titre`, `description`,`codename`,`pays`, `agents`, `contacts`, `cibles`, `statut`, `planque`, `specialite`, `startdate`, `enddate`) 
        VALUES (:titre, :description, :codename, :pays, :agents, :contacts, :cibles, :statut, :planque, :specialite, :startdate, :enddate );';

        $query = $db->prepare($sql);

        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':codename', $codename,  PDO::PARAM_STR);
        $query->bindValue(':pays', $pays, PDO::PARAM_STR);
        $query->bindValue(':agents', $agents, PDO::PARAM_INT);
        $query->bindValue(':contacts', $contacts, PDO::PARAM_INT);
        $query->bindValue(':cibles', $cibles, PDO::PARAM_INT);
        $query->bindValue(':statut', $statut, PDO::PARAM_STR);
        $query->bindValue(':planque', $planque, PDO::PARAM_INT);
        $query->bindValue(':specialite', $specialite, PDO::PARAM_STR);
        $query->bindValue(':startdate', $startdate, PDO::PARAM_STR);
        $query->bindValue(':enddate', $enddate, PDO::PARAM_STR);
      

        $query->execute();

        $_SESSION['message'] = "Mission ajoutée";
        require_once('../close.php');

        header('Location: listeMission.php');
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
    <title>Ajouter une Mission</title>

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
                <h1>Ajouter une Mission</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="codename">Nom de code</label>
                        <input type="text" id="codename" name="codename" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pays">Pays</label>
                        <input type="text" id="pays" name="pays" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="agents">Agents</label>
                        <input type="number" id="agents" name="agents" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contacts">Contacts</label>
                        <input type="number" id="contacts" name="contacts" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cibles">Cibles</label>
                        <input type="text" id="cibles" name="cibles" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <input type="text" id="statut" name="statut" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="planque">Planque</label>
                        <input type="number" id="planque" name="planque" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="specialite">specialite</label>
                        <input type="text" id="specialite" name="specialite" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="startdate">Date de début</label>
                        <input type="date" id="startdate" name="startdate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="enddate">Date de fin</label>
                        <input type="date" id="enddate" name="enddate" class="form-control">
                    </div>
                 
                    <button class="btn btn-primary mt-3">Envoyer</button>
                    <a href="listeMission.php" class="btn btn-primary mt-3">Retour</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>