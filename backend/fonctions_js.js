/*
  Date       : Mars 2021
  Auteur     : Aliya Myaz
  Sujet      : Fonctions js pour le déplacement des fées
*/

//liste des fées présentes dans la cage de l'utilisateur
var fees = [];
//liste des directions des fées
var directions = [];

var hautimage = 0;
var gaucheimage = 0;

var goUp = "setInterval(mooveImage, 50, -2, 0)";
var goDown = "setInterval(mooveImage, 50, 0, -2)";
var goLeft = "setInterval(mooveImage, 50, 0, -2)";
var goRight = "setInterval(mooveImage, 50, -2, 2)";


function deplaceFees(top, left) {
    //parcourir les fées
    for(i = 0; i<fees.length(); i++){
        fee = fees[i];
        direction = directions[i];

        //Déplacer la fée en fonction de sa direction

        /*
        hautimage = hautimage + top;
        gaucheimage = gaucheimage + left;
        sprite.style.top = hautimage + "px";
        sprite.style.left = gaucheimage + "px";
        */
    }       
}

/*
monde.innerHTML += ""
*/