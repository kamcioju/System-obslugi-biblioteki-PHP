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
      if(isset($_GET['rid'])){

        
        if($stmt = $mysqli->prepare("call rez_status(?,?)"))
             {
            $status="Do odbioru";
             $stmt->bind_param('is',$_GET['rid'],$status);
             $stmt->execute();
             $stmt->close();
        }
     }
    
?>
<body>
   
 <table class="table table-hover ">
    <thead>
      <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>PESEL</th>
        <th>email</th>
        <th>dni spóźnienia</th>
        <th>kara</th>
      </tr>
    </thead>
    <tbody>   
    
<?php
      
    if($stmt = $mysqli->prepare("select * from spoznienia"))
         {
         $stmt->execute();
         $q=$stmt->get_result();
        
        
        
    while($row=$q->fetch_array())
    {
        echo'
       <tr>
         <td>'.$row[0].'</td>
         <td>'.$row[1].'</td>
         <td>'.$row[2].'</td>
         <td>'.$row[4].'</td>
         <td>'.$row[5].'</td>
         <td><form  action="uzytkownik.php?uid='.$row[3].'" method="POST"><button type="submit" class="btn btn-info">Uzytkownik</button></form></td>
         
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