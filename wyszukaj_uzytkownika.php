<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>Biblioteka</title>
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<?php 
    session_start();
    include_once "baza.php";
    include_once "nawigacja.php";
     if($_SESSION['aktywacja']==2)
     {
?>
<div class="col-md-6 col-md-offset-3  well-lg  " >
<br>Wyszukiwanie użytkownika:
<form method="GET" class="form" action="uzytkownicy.php" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Wyszukaj" name=szukane>
        </div>
        
            <div class="form-group">
              <select class="form-control" name="opcja">
                <option value="1">PESEL</option>
                <option value="2">login</option>
                <option value="3">Telefon</option>
                <option value="4">email</option>
                <option value="5">Nazwisko</option>
              </select>
            </div>
         
        <button type="submit" class="btn btn-default"> Wyszukaj</button>
</form >
    </div>

<?php }
    include_once "stopka.php";
    ?>