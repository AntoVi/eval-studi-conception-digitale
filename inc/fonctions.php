<?php

function connect()
{
    // Si l'indice 'user' N'EST PAS DEFINIT dans la session, cela veut dire l'internaute n'est pas passé par la page connexion, donc qu'il n'est pas authentifié sur le site
    if(!isset($_SESSION['user']))
        return false;
    else 
        return true;
}