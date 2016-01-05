
<script type="text/javascript" src="http://ciasteczka.eu/cookiesEU-latest.min.js"></script>
<script type="text/javascript">

jQuery(document).ready(function(){
	jQuery.fn.cookiesEU();
});

</script>
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
      <a class="nav navbar-brand" href="zamowienia.php">Zamówienia</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li><a href="ostatnio_wyszukiwane.php">Ostatnio wyszukiwane</a></li>
        
      </ul>
      <form method="GET" class="navbar-form navbar-left" action="wyszukaj.php" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Wyszukaj" name=szukane>
        </div>
        
            <div class="form-group">
              <select class="form-control" id="sel1">
                <option>Tytuł</option>
                <option>Autor</option>
                <option>ISBN</option>

              </select>
            </div>
         
        <button type="submit" class="btn btn-default"> Wyszukaj</button>
      </form >
 <?
header("Cache-Control: no-store, no-cache, must-revalidate");  
header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
header("Pragma: no-cache");
?>
       
 
    <div class="nav navbar-nav navbar-right">    
<?php       
///logowanie i wylogowywanie
        //cookie
      if(isset($_COOKIE['id']))
      {
         # echo $_COOKIE['id'];
          /*
        $l=mysqli_query($link, "select id_u from sesje where id='{$_COOKIE['id']}';")or die(mysqli_error($link));
	    $l=mysqli_fetch_assoc($l);
     */
          ///sprawdzanie sesji i ciasteczka
         if($stmt = $mysqli->prepare("select id_u from sesje
             where id =?;"))
         {
                 $stmt->bind_param('i', $_COOKIE['id']);
                 $stmt->execute();
                 $l=$stmt->get_result();
                 #echo $stmt->num_rows;
                 $l=$l->fetch_array();
             #foreach($l as $k=>$v)
             #{ echo $k."kus".$v;}
         
                    ///sprawdzanie czy zalogowany
                if(isset($l['id_u']))
                {
                    if($stmt = $mysqli->prepare("select login, aktywacja from uzytkownik where           id_uzytkownika=?;"))
                     {
                     $stmt->bind_param('i', $l['id_u']);
                     $stmt->execute();
                     $u=$stmt->get_result();
                     $u=$u->fetch_array(); 
                     if($u['aktywacja']==2)
                     {
            ?>
 <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                          role="button" aria-haspopup="true" aria-expanded="false">
                              Admin<span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="rezerwacje.php">Rezerwacje</a></li>
                            <li><a href="wyszukaj_uzytkownika.php">Wyszukaj użytkownika</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="edycja_danych.php">Dane osobowe</a></li>
                            <li><a href="zmiana_hasla.php">Zmiana hasła</a></li>
                             <li><a href="wypozyczenia.php">Wypożyczenia</a></li>
                             <li><a href="wypozyczenia_historia.php">Wypożyczenia historia</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="dodaj_ksiazke.php">Dodaj książkę</a></li>
                            <li role="separator" class="divider"></li>
                             <li><a href="wyloguj.php">Wyloguj</a></li>

                          </ul>
                      </li>
                     </ul>             <?php  
                     }     
             ?>       
                     
                     <ul class="nav navbar-nav">
                      <li>    
                          <a href="edycja_danych.php"> 

            <?php
                       echo'zalogowany:' ;
                       echo $u['login'].'</a> </li></ul>  ';   

                    }
                    if($u['aktywacja']!=2){
             ?>             
                       
                     
                      <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                          role="button" aria-haspopup="true" aria-expanded="false">
                              Moje konto<span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="wypozyczenia.php">Wypożyczenia</a></li>
                            <li><a href="wypozyczenia_historia.php">Wypożyczenia historia</a></li>
                            <li><a href="edycja_danych.php">Dane osobowe</a></li>
                            <li><a href="zmiana_hasla.php">Zmiana hasła</a></li>
                            <li><a href="powiadomienia.php">Opcje powiadomień</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="wyloguj.php">Wyloguj</a></li>

                          </ul>
                      </li>
                     </ul>
                     
                </div>
        <?php
                    }
                
                } else{
                  //echo '<a href="zaloguj.php"><button type="button" class="btn btn-default">Zaloguj</button></a>';
        ?>
               <form class="navbar-form" role="search" action="zaloguj.php" method="POST">
                   <button type="submit" class="btn btn-default">Zaloguj</button>
               </form>
        <?php
                }
        } 
      } else{
?>
               <form class="navbar-form" role="search" action="zaloguj.php" method="POST">
           <button type="submit" class="btn btn-default">Zaloguj</button>
       </form>
<?php
      }
    
?>
   
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>