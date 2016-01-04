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
    
    //dodawanie rezerwacji
     if(isset($_GET['kid'])){

        
        if($stmt = $mysqli->prepare("call rezerwuj(?,?)"))
             {
             $stmt->bind_param('ii',$_SESSION['id_u'],$_GET['kid']);
             $stmt->execute();
             $stmt->close();
        }
     }
    //anuloowanie rezerwacji
    if(isset($_GET['rid'])){

        
        if($stmt = $mysqli->prepare("call usun_rezerwacje(?,?)"))
             {
             $stmt->bind_param('ii',$_SESSION['id_u'],$_GET['rid']);
             $stmt->execute();
             $stmt->close();
        }
     }
    
?>
<body>
   
 <table class="table table-hover ">
    <thead>
      <tr>
        <th>Tytuł</th>
        <th>Rok Wydania</th>
        <th>Liczba Stron</th>
        <th>Rezerwacja od</th>
        <th>Rezerwacja do</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>   
    
<?php
      
    if($stmt = $mysqli->prepare("call rezerwacje_user(?)"))
         {
         $stmt->bind_param('i',$_SESSION['id_u']);
         $stmt->execute();
         $q=$stmt->get_result();
        
        
        
    while($row=$q->fetch_array())
    {
        echo'
       <tr>
         <td> <a href="ksiazka.php?kid='.$row[0].'">'.$row[1].'</td></button>
         <td>'.$row[2].'</td>
         <td>'.$row[3].'</td>
         <td>'.$row[4].'</td>
         <td>'.$row[5].'</td>
         <td>'.$row[6].'</td>
         <td><form  action="zamowienia.php?rid='.$row[7].'" method="POST"><button type="submit" class="btn btn-info">Anuluj</button></form></td>
         
      </tr></a>';
        
        
    }
        
    }
?>
    </tbody>
  </table>    

<?php
    include_once "stopka.php";
    ?>
    
</body>