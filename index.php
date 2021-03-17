<?php
/*
  Date       : Mars 2021
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet
*/

session_start();
include("backend/autoload.php");

$feeSelect = FILTER_INPUT(INPUT_POST, "fee", FILTER_SANITIZE_STRING);
$action = FILTER_INPUT(INPUT_POST, "btnAction", FILTER_SANITIZE_STRING);
$fees = [];

//si un utilisateur est connecté
if(!isset($_SESSION["idUser"])){
  //Récupérer les fées de sa cage
  //$fees = readFeesByCage(readCageByUser($_SESSION["idUser"]));
  $fees = readFeesByCage(readCageByUser(0));
}

//si l'utilisateur appuie sur un bouton
if($action){
  if($action == "valider"){
    //La fée est libérée 
    //[animation appel à une fonction js]
    deleteFee($feeSelect);
  }
  else if($action == "infos"){
    //rediriger sur la page d'information de la fée en question
    header('Location: infosAction.php?idFee='.$feeSelect);
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
    <script type="text/javascript" src="backend/fonctions_js.js"></script>
  </head>
  <body>
    <nav>
      <form class="formSearch" action="" method="POST">
        <?php feeASelectionner($fees, 0); ?>
        <button type="submit" name="recherche" value="rechercher">Rechercher</button>
      </form>
      <div class="navigation">
      <?php
      //si un utilisateur est connecté
      if(isset($_SESSION["idUser"])){
        echo "<a class=\"lienBouton\" href=\"ajouterIdee.php\"><span>Nouvelle idée</span></a>";
        echo "<a class=\"lienBouton\" href=\"voirMesIdees.php\"><span>Mes idées</span></a>";
        echo "<a class=\"lienBouton\" href=\"logout.php\"><span>Déconnexion</span></a>";
      }
      //sinon
      else{
        echo "<a class=\"lienBouton\" href=\"login.php\"><span>Connexion</span></a>";
      }
      ?>
      </div>
    </nav>

    <main class="zoneAffichage">
      <img class="imgCage" src="img/cage.png"/>    
    </main>
  </body>
</html>