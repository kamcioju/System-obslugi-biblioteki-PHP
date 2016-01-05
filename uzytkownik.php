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
        <th>Tytuł</th>
        <th>Rok Wydania</th>
        <th>Liczba Stron</th>
        <th>Data wypożyczenia</th>
        <th>Planowana data zwrotu</th>
        <th>Prolongaty</th>
        <th> </th>
        <th>Kara</th>

      </tr>
    </thead>
    <tbody>   
    
<?php
        if( $_SESSION['aktywacja']==2)
        {
    $idu=$_GET['uid'];
    if(isset($_GET['rid'])){

        
        if($stmt = $mysqli->prepare("call rez_status(?,?)"))
             {
            $status="Do odbioru";
             $stmt->bind_param('is',$_GET['rid'],$status);
             $stmt->execute();
             $stmt->close();
        }
     }
        
    if(isset($_GET['oddaj_w_id'])){

        
        if($stmt = $mysqli->prepare("call oddaj(?)"))
             {
             $stmt->bind_param('i',$_GET['oddaj_w_id']);
             $stmt->execute();
             $stmt->close();
            }
    }
    if(isset($_GET['wypozycz_r_id'])){

        
        if($stmt = $mysqli->prepare("call wypozycz(?)"))
             {
             $stmt->bind_param('i',$_GET['wypozycz_r_id']);
             $stmt->execute();
             $stmt->close();
            }
    }
           
        
        
        
    if($stmt = $mysqli->prepare("call wypozyczenia_user(?)"))
         {
         $stmt->bind_param('i',$idu);
         $stmt->execute();
         $q=$stmt->get_result();
                $stmt->close(); 

        
    echo "<h4>Wypożyczenia:</h4>";  
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
         <td><form  action="uzytkownik.php?oddaj_w_id='.$row[7].'&uid='.$idu.'" method="POST"><button type="submit" class="btn btn-info">Oddano</button></form></td>
      </tr></a>';
        
        
    }
        
    }
?>
    </tbody>
  </table>    
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
       echo "<h4>Zamówienia:</h4>";
     
    
    if($stmt = $mysqli->prepare("call rezerwacje_user(?)"))
         {
         $stmt->bind_param('i',$idu);
         $stmt->execute();
         $q=$stmt->get_result();
        $stmt->close(); 
        
        
    while($row=$q->fetch_array())
    {
        
        echo'
       <tr>
         <td> <a href="ksiazka.php?kid='.$row[0].'">'.$row[1].'</td></button>
         <td>'.$row[2].'</td>
         <td>'.$row[3].'</td>
         <td>'.$row[4].'</td>
         <td>'.$row[5].'</td>
         <td>'.$row[6].'</td>';
         if($row[6]=="oczekuje")
             echo '
         <td><form  action="uzytkownik.php?rid='.$row[7].'&uid='.$idu.'" method="POST"><button type="submit" class="btn btn-info">Przygotowano</button></form></td></tr></a>';
         else
             echo '
         <td><form  action="uzytkownik.php?wypozycz_r_id='.$row[7].'&uid='.$idu.'" method="POST"><button type="submit" class="btn btn-info">Wydano</button></form></td></tr></a>';
         
      
        
        
    }
        
    }}
    ?>
    </tbody>
  </table>
  <?php
    include_once "stopka.php";


?>
</body>