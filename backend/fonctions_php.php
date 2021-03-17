<?php
/*
  Date       : Mars 2021
  Auteur     : Aliya Myaz
  Sujet      : Fonctions PHP du projet
*/

//Affichage des infos de la fée sélectionnée
function feeToHtmlTable($idFee){

    //récupérer la fée dans la bd
    $fee = ReadFeeById($idFee);

    echo "<tr>";
        //fabrication du conteneur avec des flexbox
        echo "<td>";
        echo "<div class=\"conteneurIdee\">
        <div class=\"en-teteIdee\"><div>".$fee['importance']."</div></div>
        <div class=\"corpsIdee\">        
        <div id=\"description\">".$fee['commentaire']."</div></div>";
    echo "</tr>";
}

function getUtilisateurConnecte(){
  if(isset($_SESSION["idUser"])){
    return $_SESSION["idUser"];
  }
  else{
    return false;
  }
}

//Affichage de la liste déroulante des fées
function feeASelectionner($fees, $feeSelect){
//afficher le select
echo "<select name=\"fee\">";
//pour chaque branche
foreach($fees as $fee){

  //si la branche est celle sélecionnée précédemment (sticky)
  if($fee["idFee"] == $feeSelect){
    echo "<option value=\"".$fee["idFee"]."\" selected>".$fee["commentaire"]."</option>";
  }
  //sinon
  else{
    echo "<option value=\"".$fee["idFee"]."\">".$fee["commentaire"]."</option>";
  }
}
echo "</select>";
}

function VerifierAccessibilite($connecte){
//$connecte = true => permettre aux personnes connectées
if($connecte){
  //tester si on doit pouvoir accéder à cette page
  if(!getUtilisateurConnecte()){
    //erreur, utilisateur déconnecté, renvoyer sur la page d'accueil
    header('Location: index.php');
    exit;
  }
}
else{
  //tester si on doit pouvoir accéder à cette page
  if(getUtilisateurConnecte()){
    //erreur, utilisateur déconnecté, renvoyer sur la page d'accueil
    header('Location: index.php');
    exit;
  }
}

}
