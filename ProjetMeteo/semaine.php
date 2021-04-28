<?php
/*
projet : 
auteur : ALiya Myaz
version : 1.0
date : Mai 2021
description : classe Semaine, stocke les 5 jours à venirs
*/

class Semaine{
    //Champs
    private $_jours;

    //Constructeurs
    public function __construct($infosMeteo){
        //Créer tous les jours et les ajouter à la liste _jours
        $this->_jours = [];
        for($i = 0; $i < count($infosMeteo); $i++){
            $jour = new Jour($infosMeteo[$i]);
            array_push($this->_jours, $jour);
        }
    }

    public function GetJours(){
        return $this->_jours;
    }

    public function GetJour($numJour){
        return $this->_jours[$numJour];
    }
}