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
        
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Wyszukaj">
        </div>
        
            <div class="form-group">
              <select class="form-control" id="sel1">
                <option>Tytuł</option>
                <option>Autor</option>
                <option>ISBN</option>

              </select>
            </div>
         
        <button type="submit" class="btn btn-primary">Wyszukaj</button>
      </form>
        
 
    <div class="nav navbar-nav navbar-right">    
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
         <ul class="nav navbar-nav">
          <li>    
              <a href="edycja_danych.php"> 
              
<?php
           echo'zalogowany:' ;
           $u=mysqli_fetch_assoc($u);
           echo $u['login'];
 ?>             
               </a>   
           </li>  
         </ul> 
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
    </div>
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
   
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>