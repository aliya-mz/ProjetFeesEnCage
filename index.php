<?php
/*
  Date       : Mars 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet
*/

session_start();
include("backend/autoload.php");

$feeSelect = FILTER_INPUT(INPUT_POST, "fee", FILTER_SANITIZE_STRING);
$action = FILTER_INPUT(INPUT_POST, "btnAction", FILTER_SANITIZE_STRING);
$fees = [];

//si un utilisateur est connecté
if(isset($_SESSION["idUser"])){
  //Récupérer les fées de sa cage
  $idees = readFeesByCage(readCageByUser($_SESSION["idUser"]));
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
  </head>
  <body>
    <nav>
      <form class="formSearch" action="" method="POST">
        <input type="text" name="tags" placeholder="mot(s)-clé" value="<?php echo $tags;?>">
        <?php //categorieToSelect($categories, $categorie); ?>
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