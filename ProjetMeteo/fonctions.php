<?php
/*
projet : 
auteur : ALiya Myaz
version : 1.0
date : Mai 2021
description : fonctions du projet
*/

define("KEY_IP", "d4fb62a10090dc46eff900d5da5eeca7");

//Fonctions pour récupérer et stocker les informations - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

function ExecuterProgrammeMeteo(){    

    //Récupérer les informations météo des 5 jours à venir
    $infosMeteo = RecupererInfosMeteo();

    //Les classer pour pouvoir les enregistrer
    $infosClassees = ClasserInfosMeteo($infosMeteo);

    //Ranger les informations dans des jours
    $infosRangees = ClasserInfosParJour($infosClassees);

    //Les enregistrer dans un objet
    $semaine = new semaine($infosRangees);

    //sauvegarder l'objet dans la session
    $_SESSION["meteo"] = $semaine;
}

function RecupererInfosMeteo(){
    //Appel de l'API
    $url = "http://api.openweathermap.org/data/2.5/forecast?q=Geneve&appid=".KEY_IP."&lang=fr";
    $result = file_get_contents($url);
    $infosMeteo = json_decode($result, true);

    //var_dump($infosMeteo["list"][2]);
    return $infosMeteo;
}

function ClasserInfosMeteo($infosMeteo){ 
    $nbJours = 5; 
    $nbEnregistrementsJour = 8;
    
    $infosEnregistrements = [];

    //Parcourir tous les enregistrements météo de la semaine
    for($i = 0; $i < $nbEnregistrementsJour*$nbJours; $i++){
        //enregistrer sous forme de dictionnaire les informations météo récupérées par l'API
        $infosEnregistrement = $array = [
            //Date de l'enregistrement
            "date" => explode(" ",$infosMeteo["list"][$i]["dt_txt"])[0],
            //Heure de l'enregistrement
            "heure" => explode(":", explode(" ",$infosMeteo["list"][$i]["dt_txt"])[1])[0],            
            //Récupérer la temperature
            "temperature" => round($infosMeteo["list"][$i]["main"]["temp"]-273.15),
            //Le groupe météorologique(pluie, neige...)
            "groupeMeteorologique" => $infosMeteo["list"][$i]["weather"][0]["main"],
            //La description de la météo
            "descriptionMeteo" => $infosMeteo["list"][$i]["weather"][0]["description"],
            //l'icone météo
            "icone" => $infosMeteo["list"][$i]["weather"][0]["icon"],
            //L'humidité
            "humidite" => $infosMeteo["list"][$i]["main"]["humidity"],
            //La vitesse du vent
            "vitesseVent" => $infosMeteo["list"][$i]["wind"]["speed"],
            //La probabilité de pécipitations
            "probPrecipitations" => $infosMeteo["list"][$i]["pop"],
        ];

        //Ajouter le relevé météo au tableau général
        array_push($infosEnregistrements, $infosEnregistrement);
    }

    //var_dump($infosEnregistrements);
    return $infosEnregistrements;
}

function ClasserInfosParJour($infosMeteo){
    $infosJours = [];
    $intervalEnreg = 3;
    //Récupérer la première heure disponible de la journée (les heures déjà passées ne sont pas données)
    $premierHeure = $infosMeteo[0]["heure"];
    //Calculer le nombre d'enregistrements météo restants pour la journée (une journée commence à minuit)
    $heuresRestantes = ((24-$premierHeure)/$intervalEnreg);

    //Supprimer les enregistrements du 6ème jour incomplet
    $heuresDernierJour = 8-$heuresRestantes;
    if($heuresDernierJour<8){
        $a = (count($infosMeteo) - $heuresDernierJour);
        for($i = count($infosMeteo)-1; $i >= $a; $i--){
            unset($infosMeteo[$i]);
        }
    }

    //var_dump($infosMeteo);

    //Créer un tableau contenant les jours, contenant eux-mêmes * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    $compteurEnregistrements = 0;
    //parcourir tous les jours (les 5 à venir)
    for($i = 0; $i < 5; $i++){
        $EnregistrementJour = [];
        //Tant que l'enregistrement suivant a la même date que le précédent
        do{
            //L'ajouter dans le jour actuel
            array_push($EnregistrementJour, $infosMeteo[$compteurEnregistrements]);
            //Incrémenter le compteur d'enregistrements
            $compteurEnregistrements += 1;
        }
        while($infosMeteo[$compteurEnregistrements-1]["date"] == $infosMeteo[$compteurEnregistrements]["date"] && $compteurEnregistrements < count($infosMeteo)-1);

        //ajouter la journée dans le tableau des journées
        array_push($infosJours, $EnregistrementJour);
    }
    //echo GetJourSemaineActuel();

    //var_dump($infosJours);

    return $infosJours;
}

//Fonctions d'affichage - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

function AfficherMeteoJour($numJour){
    $jour = $_SESSION["meteo"]->GetJour($numJour);

    echo "<table class=\"meteoTable\">";
    echo"<tr><div class=\"meteoBulle\" id=".$jour->GetDate().">";
    $temperatures = [];
    $heures = [];    
    //Parcourir les infos de toutes les heures
    for($i = 0; $i < count($jour->GetHeures()); $i++){
        $heure = $jour->GetHeure($i);
        array_push($heures, $heure->GetHeure());
        array_push($temperatures, $heure->GetTemperature());        
    }    
    echo "</div><tr>";

    //appel de la fonction qui affiche le graphique des températures
    echo "<script>DessinerGraphique(".$heures.",".$temperatures.",\"".$jour->GetDate()."\")</script>";
    echo "</table>";
}

function GetJourSemaine($numJour){
    $jours = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');

    //récupérer l'index du jour actuel et ajouter le nombre de jours indiqué en paramètre
    $index = date('w', date_timestamp_get(new DateTime('now'))) + $numJour;
    if($index > 6){
        $index = $index % 6;
    }

    return $jours[$index];
}