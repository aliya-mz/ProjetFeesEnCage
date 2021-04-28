/*
code utilisé : https://developers.google.com/chart/interactive/docs/gallery/barchart
*/


google.charts.load('current', {packages: ['corechart', 'bar']});

var dataA;
var identifiant;

function DessinerGraphique(heures, valeurs, laDate){
    identifiant = laDate;

	//Formater les données de températures par heure
	dataA = [
        ['Heure', 'Temperature'],
        ['0h', 8],
        ['3h', 4],
        ['6h', 5],
        ['9h', 10],
        ['12h', 14],
        ['15h', 18],
        ['18h', 15],
        ['21h', 13],
      ];
  
    //Créer et afficher le graphique
    google.charts.setOnLoadCallback(Afficher);
}

function Afficher(){
      var data = google.visualization.arrayToDataTable(dataA)

      var materialOptions = { 
        bars: 'horizontal',
        'width':700,
        'height':200,
        colors: ['#7DB4EA']
      };

      var materialChart = new google.charts.Bar(document.getElementById(identifiant));
      materialChart.draw(data, materialOptions);
}