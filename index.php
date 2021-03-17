<?php
/*
  Date       : Novembre/décembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet
*/


session_start();
include("backend/autoload.php");

$categorie = FILTER_INPUT(INPUT_POST, "categorie", FILTER_SANITIZE_STRING);
$tags = FILTER_INPUT(INPUT_POST, "tags", FILTER_SANITIZE_STRING);
$recherche = FILTER_INPUT(INPUT_POST, "recherche", FILTER_SANITIZE_STRING);
$idees = [];
$categories = readCategories();
$mettreEnFavoris = FILTER_INPUT(INPUT_POST, "mettreEnFavoris", FILTER_SANITIZE_STRING);

//si on n'a pas cliqué sur une fée
if(!$recherche){
  //Afficher toutes les idées
  $idees = ReadIdees();
}
//sinon
else{
  //si au moins un champs du formulaire a été rempli
  if($tags || $categorie){
    //lire toutes les notes publiques qui correspondent aux critères
    if(isset($_SESSION["idUser"])){
      //si l'utilisateur est connecté, lui afficher également ses idées
      $idees = readIdeesByCritereExpansion($tags, $categorie, $_SESSION["idUser"]);
    }
    else{
      //si l'utilisateur n'est pas connecté, lui afficher les idées publiques des autres
      //$idees = readIdeesByCritereExpansion($tags, $categorie);
    }
  }
}

if($mettreEnFavoris){
  echo "Les favoris fonctionnent";
  //si un bonton favoris a été cliqué, changer l'état favoris/pas favoris de l'idée correspondante
  changerEtatFavoris($mettreEnFavoris);
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
        <?php categorieToSelect($categories, $categorie); ?>
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

    <main class="ideesUserMain">
      <table>
        <form method="post" action="voirMesIdees.php">
          <thead>
            <tr>
              <td colspan="5">Mes idées</td>
            </tr>
          </thead>
          <?php
            //affichage dynamique des idées 
            ideesToHtmlTable($idees, false, false);
          ?>
          </form>
      </table>      
    </main>
  </body>
</html>