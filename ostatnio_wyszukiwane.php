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
    
    if(isset($_SESSION['id_u']))
    {
        $stmt = $mysqli->prepare("call historia_wyszukan_user(?)");
         if ( !$stmt ) {
    printf('errno: %d, error: %s', $mysqli->errno, $mysqli->error);
    die;}
    else
         {
         $stmt->bind_param('i',$_SESSION['id_u']);
         $stmt->execute();
    
         $q=$stmt->get_result();
                 #echo $stmt->num_rows;
        ?>
        <table class="table table-hover ">
    <thead>
      <tr>
        <th>Szukane</th>
        <th>data</th>
      </tr>
    </thead>
    <tbody> 
        <?php
        while($row=$q->fetch_array())
    {
        echo'
       <tr>
         <td>'.$row[1].'</td>
         <td>'.$row[3].'</td>
      </tr></a>';
        
        
    }?>
       </tbody>
  </table> 
        
        
     <?php   
    }
    }
?>

<body>
    
    
    
    
    
    
    
    
    
    




<?php
    include_once "stopka.php";
    ?>
    
</body>