<?php
/*
projet : 
auteur : ALiya Myaz
version : 1.0
date : Mai 2021
description : classe Semaine, stocke les informations météorologiques d'une heure précise
*/

class MeteoRecord{
    //champs
    private $_heure;
    private $_temperature;   
    private $_groupeMeteorologique; //pluie, neige, etc...
    private $_descriptionMeteo;
    private $_icone;
    private $_humidite;
    private $_vitesseVent;
    private $_probPrecipitations;

    function __construct($infosMeteo){
        //Traiter les informations pour les classer dans les champs        
        $this->_heure = $infosMeteo["heure"];
        $this->_temperature = $infosMeteo["temperature"];;
        $this->_groupeMeteorologique = $infosMeteo["groupeMeteorologique"];
        $this->_descriptionMeteo = $infosMeteo["descriptionMeteo"];
        $this->_icone = $infosMeteo["icone"];
        $this->_humidite = $infosMeteo["humidite"];
        $this->_vitesseVent = $infosMeteo["vitesseVent"];
        $this->_probPrecipitations = $infosMeteo["probPrecipitations"];
    }
    
    public function GetHeure(){
        return $this->_heure;
    }

    public function GetTemperature(){
        return $this->_temperature;
    }

    public function GetGroupeMeteorologique(){
        return $this->_groupeMeteorologique;
    }

    public function GetDescriptionMeteo(){
        return $this->_descriptionMeteo;
    }

    public function GetIcone(){
        return $this->_icone;
    }

    public function GetHumidite(){
        return $this->_humidite;
    }

    public function GetVitesseVent(){
        return $this->_vitesseVent;
    }

    public function GetProbPrecipitations(){
        return $this->_probPrecipitations;
    }    

    //exemple structure données
    //https://openweathermap.org/forecast5
}