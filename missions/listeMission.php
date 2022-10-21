<?php
require_once '../init.php';

require_once '../inc/header.php';
require_once '../inc/nav.php';
// On démarre une session

$sql = 'SELECT * FROM `mission`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('../close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes des missions</title>

</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
            <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger mt-5" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success mt-5" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Listes des missions</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>titre</th>
                        <th>description</th>
                        <th>Nom de code</th>
                        <th>Pays</th>   
                        <th>Agents</th>  
                        <th>Contacts</th>  
                        <th>Cibles</th>  
                        <th>Statut</th>  
                        <th>Planque</th>  
                        <th>Spécialité</th>  
                        <th>date de début</th>  
                        <th>date de fin</th>                   
                        <th> </th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $liste){
                        ?>
                            <tr>
                                <td><?= $liste['id'] ?></td>
                                <td><?= $liste['titre'] ?></td>
                                <td><?= $liste['description'] ?></td>
                                <td><?= $liste['codename'] ?></td>
                                <td><?= $liste['pays'] ?></td>
                                <td><?= $liste['agents'] ?></td>
                                <td><?= $liste['contacts'] ?></td>
                                <td><?= $liste['cibles'] ?></td>
                                <td><?= $liste['statut'] ?></td>
                                <td><?= $liste['planque'] ?></td>
                                <td><?= $liste['specialite'] ?></td>
                                <td><?= $liste['startdate'] ?></td>
                                <td><?= $liste['enddate'] ?></td>
                                <?php if(connect()): ?>  
                                <td><a href="editMission.php?id=<?= $liste['id'] ?>" class="btn btn-info">Modifier</a> 
                                <a href="deleteMission.php?id=<?= $liste['id'] ?>" class="btn btn-danger">Supprimer</a> 
                                </td>
                                <?php endif; ?>
                            </tr>
                            
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>

                <?php if(connect()): ?>          
                    <a href="addMission.php" class="btn btn-primary">Ajouter une mission</a>
                <?php endif; ?>

            </section>
        </div>
    </main>
</body>
</html>