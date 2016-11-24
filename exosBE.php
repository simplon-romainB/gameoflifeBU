<?php
$connexion = new PDO(
'mysql:host=yyshfrqthpyysh.mysql.db; dbname=yyshfrqthpyysh', 'yyshfrqthpyysh', 'Magicstar198'
);
if ((isset($_GET["titre"]))&&(isset($_GET["Debut"]))&&(isset($_GET["fin"]))&&(isset($_GET["mailCreateur"]))) {
  $insert = "INSERT INTO calendar (titre, debut, fin, mail_createur)" ."VALUES (:titre, :debut, :fin, :mail_createur)";
  $qinsert = $connexion->prepare($insert);
  $titre = $_GET["titre"];
  $debut = $_GET["Debut"];
  $fin = $_GET["fin"];
  $mailcreateur = $_GET["mailCreateur"];
  $qinsert->bindParam(":titre",$titre, PDO::PARAM_STR);
  $qinsert->bindParam(":debut",$debut, PDO::PARAM_STR);
  $qinsert->bindParam(":fin",$fin, PDO::PARAM_STR);
  $qinsert->bindParam(":mail_createur",$mailcreateur, PDO::PARAM_STR);
  $qinsert->execute();
}
$requete = "SELECT * FROM calendar";
	$resultats = $connexion->query($requete);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="bootstrap.css" rel="stylesheet">
    <script src="bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <div class = "container">
      <div class = "row">
          <form name = "eventCalendar" method = "GET">
            <div>
              <input  placeholder = "titre" name= "titre">
              <input  placeholder = "début" name= "Debut">
              <input placeholder = "fin" name= "fin">
              <input  placeholder = "mail" name= "mailCreateur">
                <span class ="input-group-button">
                  <button type= "submit" class= "btn btn-default">enregistrer</button>
                </span>
                </form>
                </div>
                  <button class= "btn btl-large" onclick = "recData()">importer données</button>
                  <button class= "btn btl-large" onclick = "afficher()">afficher calendrier</button>
      </div>
      <div class = "row">
        <div class = "panel panel-default">
          <div class = "panel-body" id = "tableCal">
            <table id= "tableDonnees">
            <tr>
            <?php
            while( $calendar = $resultats->fetch() ){
              echo "<tr><td>".$calendar["titre"]."</td></tr>
                        <td>" .$calendar["debut"]."</td>
                        <td>".$calendar["fin"]."</td>
                        <td>".$calendar["mail_createur"]."</td>";
            }
             ?>
            </tr>
            </table>
            <script type ="text/javascript">
            caseMail1 = document.getElementById("mail1");
            casedebut1 = document.getElementById("debut1");
            casefin1 = document.getElementById("fin1");
            casesummary1 = document.getElementById("summary1");
            tabledonnes1 = document.getElementById("tableDonnees");
            tablegol = document.getElementById("tableCal");
            function recData(){
            recuperationCalendar = new XMLHttpRequest();
            recuperationCalendar.open("GET", "calendar.json", true);
            recuperationCalendar.send(null);
            recuperationCalendar.onload = resultatsTraite;
              function resultatsTraite() {
                datacalendar = JSON.parse(recuperationCalendar.responseText);
                for (var i = 0; i<(datacalendar.items.length)-1 ; i ++) {
                var elem = document.createElement("tr")
                tabledonnes1.appendChild(elem);
                var  elementaire = document.createElement("td");
                var  elementaire2 = document.createElement("td");
                var  elementaire3 = document.createElement("td");
                var  elementaire4 = document.createElement("td");
                  elementaire.innerHTML = datacalendar.items[i].creator.email;
                  elem.appendChild(elementaire);
                  elementaire2.innerHTML = datacalendar.items[i].start.dateTime;
                  elem.appendChild(elementaire2);
                  elementaire3.innerHTML = datacalendar.items[i].end.dateTime;
                  elem.appendChild(elementaire3);
                  elementaire4.innerHTML = datacalendar.items[i].summary;
                  elem.appendChild(elementaire4);
                   /*
                  tablegol.innerHTML = tablegol.innerHTML+datacalendar.items[i].summary;
                  tablegol.innerHTML = tablegol.innerHTML+datacalendar.items[i].start.dateTime;
                  tablegol.innerHTML = tablegol.innerHTML+datacalendar.items[i].end.dateTime;
                  tablegol.innerHTML = tablegol.innerHTML+datacalendar.items[i].organizer.email;
                  */
                }
              }





          }
            </script>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
