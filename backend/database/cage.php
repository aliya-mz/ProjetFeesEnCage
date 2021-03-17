<?php
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Gestion de la table "note"
 */

//etat : ok

function readCageByUser($idUtilisateur){
  static $ps = null;
  $sql = "SELECT * FROM cage WHERE idUtilisateur = :idUtilisateur";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    if($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function createCage($idUtilisateur){
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = "INSERT INTO `cage` (`idUtilisateur`, `dateCreation`) VALUES ( :idUtilisateur, CURRENT_TIMESTAMP())";

  //si le prepare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function updateNote($idCage, $etat){
  static $ps = null;
  $sql = 'UPDATE cage SET etat = :etat WHERE idCage = :idCage';
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idCage', $idCage, PDO::PARAM_INT);
    $ps->bindParam(':etat', $etat, PDO::PARAM_STR);
    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function deleteCage($idCage){
  static $ps = null;
  $sql = 'DELETE FROM cage WHERE idCage = :idCage';
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idCage', $idCage, PDO::PARAM_INT);
    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}
