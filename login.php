<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page pour créer un compte
*/

include("backend/autoload.php");
session_start();

VerifierAccessibilite(false);

//récupérer les données du formulaire
$email = FILTER_INPUT(INPUT_POST, "email", FILTER_SANITIZE_STRING);
$password = FILTER_INPUT(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$connexion = FILTER_INPUT(INPUT_POST, "connexion", FILTER_SANITIZE_STRING);

if($connexion){
  //si les champs sont remplis
  if($email && $password){
    //récupérer l'utilisateur dans la BD avec son ID
    $user = readUserByEmail($email);

    //tester le mot de passe
    if(password_verify($password, $user["motDePasse"])){
      //enregister l'utilisateur dans la session
      $_SESSION = ["idUser" => $user["idUser"]];

      //rediriger vers la page d'accueil
      header('Location: index.php');
      exit;
    }
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
          <td colspan="2"><input type="email" name="email" value="" placeholder="Email"></td>
        </tr>
        <tr>
          <td colspan="2"><input type="password" name="password" value="" placeholder="Mot de passe"></td>
        </tr>
        <tr>
          <td colspan="2"><button class="btnCreateIdea" type="submit" name="connexion" value="connexion">Connexion</button></td>
        </tr>
        <tr>
          <td colspan="2"><a href="signin.php">Je n'ai pas encore de compte</a></td>
        </tr>
      </table>
    </form>
  </main>
  </body>
</html>
