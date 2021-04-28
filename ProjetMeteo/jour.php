<?php
/*
projet : 
auteur : ALiya Myaz
version : 1.0
date : Mai 2021
description : classe Semaine, stocke les 8 heures de la journée possédant des informations meteo
*/

class Jour{
    //champs
    private $_enregistrements;
    private $_date;

    function __construct($infosMeteo){
        $this->_date = $infosMeteo[0]["date"];
        //Créer toutes les heures et les ajouter à la liste _heure
        $this->_enregistrements = [];
        for($i = 0; $i < count($infosMeteo); $i++){
            $enregistrement = new MeteoRecord($infosMeteo[$i]);
            array_push($this->_enregistrements, $enregistrement);
        }
    }

    public function GetDate(){
        return $this->_date;
    }

    public function GetHeures(){
        return $this->_enregistrements;
    }

    public function GetHeure($numHeure){
        return $this->_enregistrements[$numHeure];
    }
}