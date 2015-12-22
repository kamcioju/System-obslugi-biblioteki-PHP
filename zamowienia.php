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
    include_once "baza.php";
    include_once "nawigacja.php"; 
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
      </tr>
    </thead>
    <tbody>   
    
<?php
    session_start();
    if($stmt = $mysqli->prepare("call rezerwacje_user(?)"))
         {
         $stmt->bind_param('i',$_SESSION['id_u']);
         $stmt->execute();
         $q=$stmt->get_result();
        
        
        
    while($row=$q->fetch_array())
    {
        echo'
       <tr>
         <td> <a href="ksiazka.php?kid='.$row[0].'">'.$row[1].'</td>
         <td>'.$row[2].'</td>
         <td>'.$row[3].'</td>
         <td>'.$row[4].'</td>
         <td>'.$row[5].'</td></button>
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