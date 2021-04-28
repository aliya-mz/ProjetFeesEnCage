<?php
/*
projet : 
auteur : ALiya Myaz
version : 1.0
date : Mai 2021
description : page principale du projet
*/

require("requires.php");

//Récupérer et enregistrer les information météo utiles
ExecuterProgrammeMeteo();

$idJour = 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=UTF-8>
        <title>Home</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="functions.js"></script>
    </head>
    <body>
    <nav>

    </nav>
	<main>
        <?php        
        //Afficher les informations météo
        AfficherMeteoJour($idJour);
        ?>
        <div id="affichageG">
        </div>
	</main>
    </body>
</html>