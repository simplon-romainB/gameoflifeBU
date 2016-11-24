<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title></title>
  </head>
  <body>
    <div class = "container">
      <div class = "row">
        <div class = "col-md-6">
            <div class= "form-group" method= "GET" >
              <label for="idpays">pays</label>
              <input type = "text" class= "form-control" id = "idpays" placeholder= "entrez le nom du pays" name = "pays">
              <button type = "button" class = "btn btn-default" onclick = "afficherPays()">valider</button></br>
              <label for= "idcapitales">capitale</label>
              <input type = "text" class = "form-control" id = "idcapitales" placeholder= "capitale" name = "capitale">
              <label for = "iddrapeau">nombre de couleurs du drapeau</label>
              <input type = "text" class = "form-control" id = "iddrapeau" placeholder = "nombre de couleurs du drapeau">
              <button type = "submit" class = "btn btn-default">enregistrer un nouveau pays</button></br>
            </div>
        </div>
        <div class = "col-md-6">
            <div class = "form-group" method= "GET" >
              <label for = "idlangue">langue</label>
              <input type = "text" class = "form-control" id = "idlangue" placeholder = "entrez une langue" >
              <button type = "button" class = "btn btn-default">valider</button></br>
              <label for = "idpays2">pays</label>
              <input type = "text" class = "form-control" id = "idpays2" placeholder = "pays">
              <button type = "submit" class = "btn btn-default">enregistrer une nouvelle langue</button></br>
        </div>
      </div>
    </div>
    <script type = "text/javascript">
    function afficherPays(nom){
      var requete = new XMLHttpRequest();
      requete.open = ("GET", "exophpb?que="nom, true);
      requete.onload = function {
        document.querySelector("idcapitales").value =  ;
    }
    </script>

  </body>
</html>
