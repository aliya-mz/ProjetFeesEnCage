<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Gestion de la table "utilisateur"
 */

function readUserByEmail($email){
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = "SELECT * FROM utilisateur WHERE email = :email";

  //si le prepare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':email', $email, PDO::PARAM_STR);

    if($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}

function readUserById($idUser){
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = "SELECT * FROM utilisateur WHERE idUser LIKE :idUser";

  //si le prepare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':idUser', $idUser, PDO::PARAM_INT);

    if($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}

function createUser($pseudo, $email, $motDePasse){

  var_dump($pseudo);
  var_dump($email);
  var_dump($motDePasse);
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = "INSERT INTO `utilisateur` (`pseudo`, `email`, `motDePasse`) VALUES ( :pseudo, :email, :motDePasse)";

  //si le prepare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $ps->bindParam(':email', $email, PDO::PARAM_STR);
    $ps->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);

    $answer = $ps->execute();
    if($answer){
      echo "L'utilisateur' a bien été créé";
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
    echo "Un problème est survenu lors de la création de l'utilisateur";
  }

  return $answer;
}
