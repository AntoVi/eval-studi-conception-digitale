<?php 
// CONNEXION BDD 
$db = new PDO('mysql:host=localhost;dbname=studi', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

// SESSION 
session_start();


// Cette constante permettra d'enregistrée dans la BDD l'URL de l'image uplodé, on ne conserve jamais l'image elle même dans la BDD mais l'URL jusqu'au dossier où elle est enregistrée
define("URL", "http://localhost/eval");


// FAILLES XSS 
foreach($_POST as $key => $value)
{
    $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));
}

foreach($_GET as $key => $value)
{
    $_GET[$key] = htmlspecialchars(strip_tags(trim($value)));
}

require_once 'inc/fonctions.php';
