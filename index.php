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



<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="nav navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Nawigacja</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="nav navbar-brand" href="#">Zamówienia</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li><a href="#">Ostatnio wyszukiwane</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"
          role="button" aria-haspopup="true" aria-expanded="false">
          Opcje wyszukiwania<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Tytuł</a></li>
            <li><a href="#">Autor</a></li>
            <li><a href="#">ISBN</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Wyszukiwanie zaawansowane</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Wyszukaj">
        </div>
        <button type="submit" class="btn btn-primary">Wyszukaj</button>
      </form>
        
 
    <div class="nav navbar-nav navbar-right ">    
<?php       
///logowanie i wylogowywanie
      require_once("baza.php") ;
      if(isset($_COOKIE['id']))
      {
        $l=mysqli_query($link, "select id_u from sesje where id='{$_COOKIE['id']}';")
            or die(mysqli_error($link));
	    $l=mysqli_fetch_assoc($l);
      
        if(isset($l['id_u']))
        {
          $u=mysqli_query($link, "select login from uzytkownik where id_uzytkownika='{$l['id_u']}';")
            or die(mysqli_error($link));
?>
          <div class="area nav navbar-nav navbar-left "> 
                    
                 
              
<?php
           echo'zalogowany:' ;
           $u=mysqli_fetch_assoc($u);
           echo $u['login'];
                  ?>             
          </div>
          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"
              role="button" aria-haspopup="true" aria-expanded="false">
                  Moje konto<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#">Wypożyczenia</a></li>
                <li><a href="edycja_danych.php">Dane osobowe</a></li>
                <li><a href="#">Zmiana hasła</a></li>
                <li><a href="#">Opcje powiadomień</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>

              </ul>
          </li>
         </ul>

<?php
        } else{
          //echo '<a href="zaloguj.php"><button type="button" class="btn btn-default">Zaloguj</button></a>';
?>
       <form class="navbar-form" role="search" action="zaloguj.php" method="POST">
           <button type="submit" class="btn btn-default">Zaloguj</button>
       </form>
<?php
        }
      } else{
?>
               <form class="navbar-form" role="search" action="zaloguj.php" method="POST">
           <button type="submit" class="btn btn-default">Zaloguj</button>
       </form>
<?php
      }
    
?>
    <style>
        #tlo {background: #123;}      
    </style>
     <div id="tlo"></div>
      </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container well well-sm">
    Grupa „Kampinos” – zgrupowanie partyzanckie Armii Krajowej walczące na terenie Puszczy Kampinoskiej w okresie powstania warszawskiego 1944.

Grupa „Kampinos” powstała na bazie struktur VIII Rejonu VII Obwodu „Obroża” Okręgu Warszawskiego AK oraz różnych oddziałów AK, które w wyniku akcji „Burza” znalazły się na terenie Puszczy Kampinoskiej. W sierpniu i wrześniu 1944 grupa wiązała znaczne siły nieprzyjaciela, odciążając tym samym powstańczą Warszawę. Jej oddziały stoczyły 47 bitew i potyczek oraz przejściowo wyzwoliły spod niemieckiej okupacji centralną i wschodnią część puszczy, zamieszkaną przez kilka tysięcy osób. Ponad 900 żołnierzy Grupy „Kampinos” wyruszyło także z odsieczą stolicy, biorąc udział w natarciach na Dworzec Gdański oraz w obronie Żoliborza.

Pod koniec września 1944 Grupa „Kampinos” podjęła próbę przejścia w Góry Świętokrzyskie. Początkowo polskie zgrupowanie skutecznie wymykało się niemieckiej obławie, lecz na skutek błędów dowództwa zostało 29 września otoczone i rozbite pod Jaktorowem. Wielu żołnierzom AK, w tym kilku zwartym oddziałom, udało się jednak wyrwać z okrążenia. Część z nich kontynuowała walkę aż do stycznia 1945 roku.
</div>
<div class='footer'>
      <div class='container'>
        <p>Stopka</p>
      </div>
    </div>
      </body>