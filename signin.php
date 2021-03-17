<?php
/*
  Date       : Mars 2021
  Auteur     : Aliya Myaz
  Sujet      : Page pour créer un compte
*/

include("backend/autoload.php");
session_start();

VerifierAccessibilite(false);

//récupérer les données du formulaire
$pseudo = FILTER_INPUT(INPUT_POST, "pseudo", FILTER_SANITIZE_STRING);
$email = FILTER_INPUT(INPUT_POST, "email", FILTER_SANITIZE_STRING);
$password = FILTER_INPUT(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$enregistrer = FILTER_INPUT(INPUT_POST, "enregistrer", FILTER_SANITIZE_STRING);

if($enregistrer){
  if($pseudo && $email && $password){
    //hasher le mot de passe
    $password = password_hash($password, PASSWORD_DEFAULT);

    //ajouter l'utilisateur dans la BD
    createUser($pseudo, $email, $password);

    //rediriger vers la page d'accueil
    header('Location: index.php');
    exit;
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" >
  </head>
  <body>
    <nav class="navAjouter">
      <td><a class="lienBouton boutonHome" href="index.php"><img src="img/home.png"/></a></td>
    </nav>
    <main>
    <form class="formAdd" action="" method="POST">
      <table>
        <tr>
          <td colspan="2"><input type="text" name="pseudo" value="" placeholder="Pseudo"></td>
        </tr>
        <tr>
          <td colspan="2"><input type="email" name="email" value="" placeholder="Email"></td>
        </tr>
        <tr>
          <td colspan="2"><input type="password" name="password" value="" placeholder="Mot de passe"></td>
        </tr>
        <tr>
          <td colspan="2"><button class="btnCreateIdea" type="submit" name="enregistrer" value="enregistrer">Je rejoins les génies</button></td>
        </tr>
      </table>
    </form>
  </main>
  </body>
</html>
