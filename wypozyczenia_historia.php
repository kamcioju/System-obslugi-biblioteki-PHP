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
   
 <table class="table table-hover ">
    <thead>
      <tr>
        <th>Tytuł książki</th>
        <th>data</th>
        <th>prolongaty</th>
        <th>planowana data zwrotu</th>
        <th>data zwrotu</th>
        <th>kara</th>
      

      </tr>
    </thead>
    <tbody>   
    
<?php
        $uid=$_SESSION['id_u'];
        if((isset($_GET['uid']))and( $_SESSION['aktywacja']==2))
            $uid=$_GET['uid']; 
        
              
    if($stmt = $mysqli->prepare("call historia_wyp_user(?)"))
         {
       
         $stmt->bind_param('i',$uid);
         $stmt->execute();
         $q=$stmt->get_result();
         
        
        
    while($row=$q->fetch_array())
    {
        echo'
       <tr>
           <td>'.$row[9].'</td>
         <td>'.$row[3].'</td>
         <td>'.$row[4].'</td>
         <td>'.$row[5].'</td>
         <td>'.$row[6].'</td>
          <td>'.$row[7].'</td>
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