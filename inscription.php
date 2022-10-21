<?php 
require_once 'init.php';

// Si l'internaute est connecté / authentifié sur le site, il n'a rien à faire sur la page inscription, on le redirige vers sa page profil
if(connect())
{
    header('location: -index.php');
}

// Exo : 
// 1. Contrôller en PHP que l'on receptionne bien toute les données saisie dans le formulaire
// echo '<pre>'; print_r($_POST); echo '</pre>';

if(isset($_POST['password'], $_POST['confirm_password'], $_POST['email'],$_POST['prenom'], $_POST['nom']))
{
    $border = 'border border-danger';
    $color = 'text-danger';

    
  
    // 3. Faites en sorte d'informer l'internaute si l'email est déjà existant en BDD
    $verifEmail = $db->prepare("SELECT * FROM admin WHERE email = :email");
    $verifEmail->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
    $verifEmail->execute();

    if($verifEmail->rowCount())
    {
        $errorEmail = "Compte existant. Merci de vous <a href='connexion.php' class='alert-link text-danger'>identifier</a>";

        $error = true;
    }
    elseif(empty($_POST['email']))
    {
        $errorEmail = "Merci de saisir votre adresse Email.";

        $error = true;
    }
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $errorEmail = "Merci de saisir une adresse Email valide (ex: exemple@gmail.com).";

        $error = true;
    }

    // 4. Faites en sorte d'informer l'internaute si les mots de passes ne correspondent pas 
    if($_POST['password'] != $_POST['confirm_password'])
    {
        $errorPassword = "Les mots de passe ne correspondent pas.";

        $error = true;
    }

    // 5. Faites en sorte d'informer l'internaute si les politiques de confidentialités ne sont pas cochés
    if(empty($_POST['gridCheck']))
    {
        $errorGridCheck = "Vous devez accepter les politiques de confidentialités.";

        $error = true;
    }

    // 6. Réaliser le traitement PHP + SQL afin d'insérer un nouveau membre dans la BDD à la validation du formulaire si l'internaute a correctement remplit le formulaire (PREPARE + BINDVALUE + EXECUTE)
    if(!isset($error))
    {
        // On ne conserve jamais les mots de passes en clair dans la BDD
        // password_hash : fonction prédéfinie permettant de créer une clé de hachage pour le mot de passe dans la BDD
        // arguments : password_hash(mot_de_passe, TYPE DE CRYPTAGE)
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $insert = $db->prepare("INSERT INTO admin (nom, prenom, email,password) VALUES (:nom, :prenom, :email, :password)");
        
        
        $insert->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $insert->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $insert->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $insert->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
        $insert->execute();

        // On stock dans le fichier de session de l'utilisateur un message de validation
        $_SESSION['validation_inscription'] = "Félicitations ! Vous êtes maintenant inscrit ! Vous pouvez dès à présent vous connecter !";

        // Après l'insertion, on redirige l'internaute vers la page de connexion
        header('location: connexion.php');
    }
}

require_once 'inc/header.php';
require_once 'inc/nav.php';
?>

    <h1 class="text-center my-5">Créer votre compte</h1>

    <?php if(isset($errorGridCheck)): ?>
        <p class="bg-danger col-md-4 mx-auto p-3 text-center text-white"><?= $errorGridCheck ?></p>
    <?php endif; ?>

    <form method="post" class="row g-3 mb-5">
        
        <div class="col-md-6">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control <?php if(isset($errorPassword)) echo $border; ?>" id="password" name="password">

            <?php if(isset($errorPassword)): ?>
                <small class="fst-italic text-danger"><?= $errorPassword ?></small>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label for="confirm_password" class="form-label">Confirmer votre mot de passe</label>
            <input type="password" class="form-control <?php if(isset($errorPassword)) echo $border; ?>" id="confirm_password" name="confirm_password">
        </div>
        <div class="col-6">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control <?php if(isset($errorEmail)) echo $border; ?>" id="email" name="email" placeholder="Saisir votre adresse email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">

            <?php if(isset($errorEmail)): ?>
                <small class="fst-italic text-danger"><?= $errorEmail ?></small>
            <?php endif; ?>

        </div>
        <div class="col-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir votre prénom">
        </div>
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir votre nom">
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input <?php if(isset($errorGridCheck)) echo $border; ?>" type="checkbox" id="gridCheck" name="gridCheck">
                <label class="form-check-label <?php if(isset($errorGridCheck)) echo $color; ?>" for="gridCheck">
                Accepter les <a href="" class="alert-link <?php if(isset($errorGridCheck)) echo $color; else echo 'text-dark' ?>">politiques de confidentialité</a>  
                </label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-dark">Continuer</button>
        </div>
    </form>

<?php 
