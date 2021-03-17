<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Gestion de la table "utilisateur"
 */

//etat : ok

function readUserByEmail($email){
  static $ps = null;
  $sql = "SELECT * FROM utilisateur WHERE email = :email";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':email', $email, PDO::PARAM_STR);
    if($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function readUserById($idUtilisateur){
  static $ps = null;
  $sql = "SELECT * FROM utilisateur WHERE idUtilisateur LIKE :idUtilisateur";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    if($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function createUser($pseudo, $email, $motDePasse, $idCage){
  static $ps = null;
  $sql = "INSERT INTO `utilisateur` (`pseudo`, `email`, `motDePasse`) VALUES ( :pseudo, :email, :motDePasse)";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $ps->bindParam(':email', $email, PDO::PARAM_STR);
    $ps->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);

    $answer = $ps->execute();
    if($answer){
      echo "L'utilisateur a bien été créé";
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
    echo "Un problème est survenu lors de la création de l'utilisateur";
  }
  return $answer;
}
