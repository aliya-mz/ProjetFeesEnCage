<?php
/*
  Date       : Mars 2021
  Auteur     : Aliya Myaz
  Sujet      : Page de déconnexion
*/

include("backend/autoload.php");
session_start();

//détruire la session
session_destroy();
$_SESSION = array();

//retourner sur la page d'accueil
header('Location: index.php');
exit;