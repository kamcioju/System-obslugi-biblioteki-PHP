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
     
    
?>
<body>
   
 <table class="table table-hover ">
    <thead>
      <tr>
       <th>PESEL</th>
        <th>Imie</th>
        <th>nazwisko</th>      
        <th>Telefon</th>
        <th>Email</th>
         <th>login</th>
        <th>Konto aktywne</th>
      </tr>
    </thead>
    <tbody>   
    
<?php
   try{   
        $stmt;
      switch ($_GET['opcja']) 
                {
               case 1:   $stmt = $mysqli->prepare("select id_uzytkownika, pesel, imie,                                  nazwisko, telefon,  email, login, aktywacja from uzytkownik where pesel=?") ;
                                 $stmt->bind_param('i',$_GET['szukane']);

              break;
               case 2:   $stmt = $mysqli->prepare("select id_uzytkownika, pesel, imie,                                  nazwisko, telefon, email, login, aktywacja from uzytkownik where 
      locate(LOWER(?),LOWER(login))!=0") ;
                                 $stmt->bind_param('s',$_GET['szukane']);

              break;
               case 3:   $stmt = $mysqli->prepare("select id_uzytkownika, pesel, imie,
                        nazwisko, telefon, email, login, aktywacja from uzytkownik where telefon=?") ;
                                 $stmt->bind_param('i',$_GET['szukane']);

              break;
               case 4:   $stmt = $mysqli->prepare("select id_uzytkownika, pesel, imie,                                  nazwisko, telefon, email, login, aktywacja from uzytkownik where locate(LOWER(?),LOWER(email))!=0") ;
                                 $stmt->bind_param('s',$_GET['szukane']);
              break;
               case 5:   $stmt = $mysqli->prepare("select id_uzytkownika, pesel, imie,                                  nazwisko, telefon, email, login, aktywacja from uzytkownik where locate(LOWER(?),LOWER(nazwisko))!=0") ;
                                 $stmt->bind_param('s',$_GET['szukane']);
              break;
          default: throw new RuntimeException('Wprowadzono zmiany w wyszukiwarce.');
   
                }
       
         if(!$stmt)
         {
             throw new RuntimeException('Błąd tworzenia zapytania.');
         }else
         {
         if(!$stmt->execute())
         {
              throw new RuntimeException('Błąd wyszukiwania.');
         }
             
        $q=$stmt->get_result();
        $stmt->fetch();
        $stmt->close();
        
        
    while($row=$q->fetch_array())
    {
        if ($row[7]==2)
            $row[7]="Admin";
        else if ($row[7]==1)
            $row[7]="Tak";
        else 
            $row[7]="Nie";
        echo'
       <tr>
         <td>'.$row[1].'</td>
         <td>'.$row[2].'</td>
         <td>'.$row[3].'</td>
         <td>'.$row[4].'</td>
         <td>'.$row[5].'</td>
         <td>'.$row[6].'</td>
         <td>'.$row[6].'</td>
         <td><form  action="uzytkownik.php?uid='.$row[0].'" method="POST"><button type="submit" class="btn btn-info">Wypozyczenia</button></form></td>
          <td><form  action="wypozyczenia_historia.php?uid='.$row[0].'" method="POST"><button type="submit" class="btn btn-info">Historia wypożyczeń</button></form></td>
         <td><form  action="usun_uzytkownika.php?id='.$row[0].'" method="POST"><button type="submit" class="btn btn-info">Usuń konto</button></form></td>        

      </tr></a>';
        
        
    }
        
    }}
        catch (RuntimeException $e) 
        {

           echo '<div class="col-md-6 col-md-offset-3 alert alert-danger" style="display: block">'.
                $e->getMessage()
                .'</div>';
        }
        
?>
    </tbody>
  </table>    

<?php
    include_once "stopka.php";
    ?>
    
</body>