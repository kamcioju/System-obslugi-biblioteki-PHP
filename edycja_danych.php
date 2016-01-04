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
<script src="validate.js"></script>
</head>
<body>
<?php 
    session_start();
    include_once "baza.php";
    include_once "nawigacja.php"; 
        
     if(isset($_POST['imie'],$_POST['nazwisko'],$_POST['telefon'],$_POST['email']))
             {
               $stmt = $mysqli->prepare("update uzytkownik set imie=?, nazwisko=?, telefon=?, email=? where id_uzytkownika=? ;");
        if ( !$stmt ) {
            printf('errno: %d, error: %s', $mysqli->errno, $mysqli->error);
            die;} else
             {
             $stmt->bind_param('ssisi',$_POST['imie'],$_POST['nazwisko'],$_POST['telefon'],$_POST['email'],$_SESSION['id_u']);
             if($stmt->execute())  
                   echo '<div class="col-md-6 col-md-offset-3 alert alert-success" style="display: block">dane zmienione!
    </div>';
             }        
         
        }
    

    if($stmt = $mysqli->prepare("call dane_user(?)"))
         {
         $stmt->bind_param('i',$_SESSION['id_u']);
         $stmt->execute();
         $q=$stmt->get_result();
         $q=$q->fetch_array();
   
  ?>  
    
        
    

    
    
    <div class="col-md-6 col-md-offset-3  well-lg  " >
    <form method=post class="form-signin" id="rejestracja" onsubmit="return validate(this)" action="edycja_danych.php">
   
        <br>Imię:
        <input type="text"  name=imie class="form-control" value="<?php echo $q[1];?>" required autofocus>
        <br>Nazwisko:
        <input type="text"  name=nazwisko class="form-control" value="<?php echo $q[2];?>" required autofocus>
       <br>Telefon:
        <br><label for="inputtelefon" class="sr-only">Telefon</label>
        <input type="text"  name=telefon class="form-control" value="<?php echo $q[3];?>" required autofocus>
        <br>Mail:
        <input type="text" name=email class="form-control" value="<?php echo $q[4];?>"required autofocus>
        

<br><button class="btn btn-lg btn-primary btn-block" type="submit">Zatwierdź</button>

</form>
    
    
    </div>
    
    
    




<?php
         }
    include_once "stopka.php";
    ?>
    
</body>