<?php
  $connexion = new PDO(
  'mysql:host=yyshfrqthpyysh.mysql.db; dbname=yyshfrqthpyysh', '', ''
);
if (isset($_GET["loadconfig"])) {
$donnees = $_GET["loadconfig"];
$select = "SELECT * FROM tablegol WHERE nomconfig = '".$donnees."'" ;
$qselect = $connexion->query($select);
$qselection = $qselect->fetch();


}
else if ((isset($_GET["vieCellules"]))&&(isset($_GET["nomconfig"]))&&(isset($_GET["cellsstart"]))&&(isset($_GET["cellswide"]))) {
$insert = "INSERT INTO tablegol(viecells, nomconfig, cellsstart, cellswide)" ."VALUES (:vie, :config, :cellsstart, :cellswide)";
$qinsert = $connexion->prepare($insert);
$cellsstart = $_GET["cellsstart"];
$cellswide = $_GET["cellswide"];
$vie = $_GET["vieCellules"];
$nomconfig = $_GET["nomconfig"];
$qinsert->bindParam(":cellsstart",$cellsstart, PDO::PARAM_STR);
$qinsert->bindParam(":cellswide",$cellswide, PDO::PARAM_STR);
$qinsert->bindParam(":vie",$vie, PDO::PARAM_STR);
$qinsert->bindParam(":config",$nomconfig, PDO::PARAM_STR);
$qinsert->execute();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="bootstrap.css" rel="stylesheet">
    <script src="bootstrap.min.js"></script>
    <link rel= "stylesheet" href="automate.css" type= "text/css" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <title></title>
  </head>
  <body onload = "init()">
  </nav>
  <div class = "container-fluid">
    <div class = "row" id = "titreid">
        <div id = "intro"><h1 class = "text-center" id = "introid">Conway's Game of Life</h1><button type="button" class="btn btn-lg btn-info" data-placement= "bottom" data-toggle="popover" title="rapide explication" data-content="Derriere ce sobriquet un peu pompeux se cache un principe relativement simple. chaque cellule vit ou meurt selon le nombre de cellules l'entourant à chaque nouvelle generation(une cellule revient à la vie si elle est encerclée par 3 cellules vivantes, et une cellulle reste vivante si elle a autour d'elle 2 ou 3 autres cellules vivantes). Voila !">mais qu'est ce que c'est que ça ??</button></div>
    </div>
  </div>
  <button class="btn btn-primary center-block" type="button" data-target="#MonCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="MonCollapse">En savoir plus</button>

<!-- le contenu masqué -->

<div id="MonCollapse" class="row collapse">
  <div class="well">
    <ul>
    <li><a href="https://fr.wikipedia.org/wiki/Automate_cellulaire">Article wikipedia sur les automates cellulaires</a></li>
    <li><a href="https://www.amazon.fr/grand-architecte-dans-lUnivers/dp/2738131964">Ouvrage de S.Hawking "Y a t-il un grand architecte dans l'univers ?" dont la dernière partie traite du jeu de la vie</a></li>
    <li><a href="https://sanojian.github.io/cellauto/">Jeu de la vie en Javascript et librairie custom</a></li>
    <li><a href="https://www.amazon.fr/New-Kind-Science-Stephen-Wolfram/dp/1579550088">Ouvrage de S.Wolfram "A new kind of science" pour aller plus loin</a></li>

    </ul>
  </div>
</div>

    <div class = "row">
      <div class="panel panel-default" id = "panel1">
        <div class="panel-heading"><h2 class = "text-center">exemple en ECMAscript 6</h2></div>
      <div class="panel-body">
            <div class= "col-md-5 col-ms-12">
              <div class="panel panel-default">
                <div class="panel-heading"><p class = "text-center">choisissez le nombre de cellules de départ(en %) ainsi que la taille d'un coté</p></div>
                <div class="panel-body">
    <form  name = "cellsNumber" method = "get">
          <div class = "input-group">
            <label for = "cellsstart">cellules de départ</label>
      <input class = "form-control" type = "text" placeholder = "cellules de départ" id = "cellsVal" name = "cellsstart"  <?php if (isset($_GET['loadconfig'])) { echo "value=".$qselection[3]."";}else {echo "value = '50'";  }  ?> >


          </div>
                <div class = "input-group">
                  <label for = "cellswide">nombre de cellules d'un coté</label>
                    <input class = "form-control"  type = "text" placeholder = "taille d'un coté" id = "cellsNum" name = "cellswide" <?php
            if (isset($_GET['loadconfig'])) { echo "value=".$qselection[4]."";
            }
            else {
              echo "value = '50'";
            }
          ?>  >
        </div>
      </div>
      <button class = "btn btn-primary center-block" type = "button" id = "validation" onclick = "config.reconfiguration()">valider</button>
    </div>
        <div class="panel panel-default" id = "panel2">
          <div class="panel-heading"><p class = "text-center">lancez une simulation et modifiez la vitesse à volonté !</p></div>
        <div class="panel-body">

          <div class = "btn-group center-block" role = "group" aria = "....">
      <button class = "btn btn-lg center-block perso1" type = "button" onclick = "config.slowTimer()"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span></button>
      <button class = "btn btn-lg center-block perso1" type = "button" onclick = "config.startTimer()"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></button>
      <button class = "btn btn-lg center-block perso1" type = "button" onclick = "config.stopTimer()"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></button>
      <button class = "btn btn-lg center-block perso1" type = "button" onclick = "config.fastTimer()"><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></button>
          </div>
      </div>
    </div>
    <div class="panel panel-default" id = "panel2">
      <div class="panel-heading"><p class = "text-center">modifier dynamiquement le nombre de cases permettant de revenir à la vie et sauvegardez votre configuration</p></div>
    <div class="panel-body">
      <input class= "form-control" type= "text" name = "vieCellules" id = "mortcells1" placeholder = "nombre de cellules pour revenir à la vie" <?php
            if (isset($_GET['loadconfig'])) { echo "value=".$qselection[2]."";
            }
            else {
              echo "value = '3'";
            }

       ?> >
      <input type = "text" name = "nomconfig" placeholder = "nom de votre configuration">
      <button class = "btn btn-default" type = "submit">sauvegarder</button>
  </form>

  <form name = "loading" method = "get">
    <input type ="text" placeholder = "nom de votre config" name = "loadconfig" >
    <button class = "btn btn-default" type ="submit">charger</button>

  </form>
</div>
</div>
</div>
<div class = "col-md-7 col-ms-12">

  <div id = "canvasContainer"><canvas id= "celullarGrid" onclick = "canvasGrid.setup()"></canvas></div>
  </div>
</div>
</div>
  <script type = "text/javascript" src= "script.js"></script>

</div>
</div>
</div>
</div>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
});
</script>
<style>
   body{
     background-color: #334d4d;
   }
   </style>
</body>
</html>
