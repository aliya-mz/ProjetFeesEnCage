<?php
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Gestion de la table "action"
 */

//etat : ok

function readFeesByCage($idCage){
  static $ps = null;
  $sql = "SELECT * FROM fee WHERE idCage = :idCage";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idCage', $idCage, PDO::PARAM_INT);

    if($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function ReadFeeById($idFee)
{
  static $ps = null;
  $sql = "SELECT * FROM fee WHERE idFee = :idFee";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idFee', $idFee, PDO::PARAM_INT);

    if($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function createFee($idCage, $commentaire, $importance){
  static $ps = null;
  $sql = "INSERT INTO `fee` (`idCage`, `commentaire`, `importance`) VALUES ( :idCage, :commentaire, :importance)";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idCage', $idCage, PDO::PARAM_INT);    
    $ps->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $ps->bindParam(':importance', $importance, PDO::PARAM_INT);
    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}

function updateFee($idFee, $commentaire, $importance){
  static $ps = null;
  $sql = 'UPDATE fee SET commentaire = :commentaire, importance=:importance WHERE idFee = :idFee';
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idFee', $idFee, PDO::PARAM_INT);
    $ps->bindParam(':dateEcheance', $dateEcheance, PDO::PARAM_STR);
    $ps->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $ps->bindParam(':importance', $importance, PDO::PARAM_STR);
    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function deleteFee($idFee){
  static $ps = null;
  $sql = 'DELETE FROM fee WHERE idFee = :idFee';
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idFee', $idFee, PDO::PARAM_INT);
    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}
