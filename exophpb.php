<?php
  $connexion = new PDO(
  'mysql:host=localhost; dbname=config', 'root', 'Magicstar198'
);

if (isset($_GET['q'])) {
  $select = 'SELECT capitale FROM pays WHERE pays_pays ="'.$_GET['q']."'";
  $reponse = $connexion->query($select);
  $qresponse = $reponse->fetch();
  echo $qresponse[2];
}
