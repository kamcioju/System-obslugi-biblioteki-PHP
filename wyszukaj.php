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
    $szukane=filter_input(INPUT_GET, 'szukane',FILTER_SANITIZE_STRING);
    if(strlen($szukane)>2)
    {
       
    if(isset($_SESSION['id_u']))
    {
    if($stmt = $mysqli->prepare("call dodaj_wyszukanie(?,?)"))
         {
         $stmt->bind_param('si',$szukane,$_SESSION['id_u']);
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
        <th>Egzemplarz ID</th>
        <th>Dostępność</th>
         <th>Nazwa wydawnictwa</th>
          <th>Język</th>
          <th>Gatunki</th>
           <th>Autorzy</th> 
      </tr>
    </thead>
    <tbody>     
<?php
    
     if($stmt = $mysqli->prepare("call ksiazka(?)"))
         {
         $stmt->bind_param('s',$szukane);
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
         <td>'.$row[5].'</td>
          <td>'.$row[6].'</td>
           <td>'.$row[7].'</td>
            <td>'.$row[8].'</td>
             <td>'.$row[9].'</td>
              </button>
      </tr></a>';
        
        
    }
    }
    }
    else
    {
        
        
    echo '<div class="col-md-6 col-md-offset-3 alert alert-info" style="display: block">Do wyszukania potrzebne są przynajmniej 3 znaki!
</div>';
    }
    
    
    
    
    
?>
    
    </tbody>
  </table>    
    
    
    
    




<?php
    include_once "stopka.php";
    ?>
    
</body>