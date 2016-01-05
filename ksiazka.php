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
?>
<body>
    <div class="container well well-sm">
    <?php
  
    if($stmt = $mysqli->prepare("call ksiazka2(?)"))
         {
         $stmt->bind_param('i',$_GET['kid']);
         $stmt->execute();
         $q=$stmt->get_result();
        $stmt->fetch();
    $stmt->close();
            echo '<div class=col-md-4><img width=400 height=500 class="img-thumbnail"   src="okladki/'.$_GET["kid"].'.jpg"></td></div>';
       $dostepnosc=0;
        while($row=$q->fetch_array())
        {
            echo'

             <div class=col-md-8><h2>Tytuł książki: '.$row[0].'<br><br></h2>
           <h3> <b>Dostępna: </b> '.$row[4].'<br><br>
            <b>Rok Wydania:</b> '.$row[1].'<br>
            <b>Liczba Stron: </b>'.$row[2].'<br>
            <b>Numer seryjny:</b> '.$row[3].'<br>
             <b>Wydawnictwo: </b>'.$row[5].'</td><br><br>
             <b>Autorzy:</b> <br>';
            $dostepnosc=$row[4];
            
        }
        }
    $stmt2 = $mysqli->prepare("call autorzy(?)");
        if( false===$stmt2 )
        {
      die('prepare() failed: ' . htmlspecialchars($mysqli->error));        
            
        }
        else
    {
         $stmt2->bind_param('i',$_GET['kid']);
         $stmt2->execute();
         $q2=$stmt2->get_result();
            //jedno z tych jest potrzebne dow wywołania wielu 
            $stmt2->fetch();
    $stmt2->close();
  ?>                   

<?php
        while($row=$q2->fetch_array())
        {   

             echo'

             '.$row[0].' 
                '.$row[1].'<br>';
        }
            if($dostepnosc==1){
             echo'</h3></td></div>
             <div class="col-md-3 col-md-offset-4">
                <form class="navbar-form" role="search" action="zamowienia.php?kid='.$_GET['kid'].'
                                                              
                                                                " method="POST">
                <button type="submit" class="btn btn-primary btn-lg"> Zamów</button>
               </form>
        </div>';
            }
        }

    
?>

        
    
    </div>
   
    
    
    




<?php
   
    include_once "stopka.php";
    ?>
     
</body>