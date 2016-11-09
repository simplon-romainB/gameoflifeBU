<?php
  $connexion = new PDO(
  'mysql:host=localhost; dbname=monsupersite;charset=utf8', 'root', 'magicstar198'
);
if ((isset($_GET["vieCellules"]))&&(isset($_GET["mortCellules"]))&&(isset($_GET["nomconfig"]))) {
$insert = "INSERT INTO tablegol(viecells, mortcells, nomconfig)" ."VALUES (:vie, :mort, :config)";
$qinsert = $connexion->prepare($insert);
$vie = $_GET["vieCellules"];
$mort = $_GET["mortCellules"];
$nomconfig = $_GET["nomconfig"];
$qinsert->bindParam(":vie",$vie, PDO::PARAM_STR);
$qinsert->bindParam(":mort",$mort, PDO::PARAM_STR);
$qinsert->bindParam(":config",$nomconfig, PDO::PARAM_STR);
$qinsert->execute();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel= "stylesheet" href="automate.css" type= "text/css" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  </head>
  <body onload = "init()">
  <div id = "intro"><h1>Automate cellulaire</h1></div>
  <div id = "canvasContainer"><canvas id= "celullarGrid" onclick = "canvasGrid.setup()"></canvas></div>
  <div id = "options">
    <form name = "cellsNumber" method = "get">
      <input type = "text" placeholder = "cellules de départ" id = "cellsVal" name = "cells" value = "50" />
      <button type = "button" onclick = "config.reconfiguration()"></button>
      <input type = "text" placeholder = "taille d'un coté" id = "cellsNum" name = "cells" value = "50"/>
      <button type = "button" onclick = "config.reconfiguration()"></button>
      <button type = "button" onclick = "config.startTimer()">start</button>
      <button type = "button" onclick = "config.stopTimer()">stop</button>
      <button type = "button" onclick = "config.slowTimer()">Slow</button>
      <button type = "button" onclick = "config.fastTimer()">Fast</button>
    </form></div>

    <form name = "saveConfig" method = "get">
      <input type= "text" name = "vieCellules" placeholder = "nombre de cellules pour revenir à la vie">
      <input type= "text" name = "mortCellules" placeholder = "nombre de cellules pour rester vivant">
      <input type = "text" name = "nomconfig" placeholder = "nom de votre configuration"
      <button type = "submit" onclick = "config.reconfiguration()">sauvegarder</button>


  <script type = "text/javascript" src= "script.js"></script>
  </body>
</html>
