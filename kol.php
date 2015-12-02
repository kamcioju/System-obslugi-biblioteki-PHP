<head>
    
    
    <meta charset="utf-8">
    
</head>
<body>
        
<form action="kol.php" method="post">
<table>
    <tr><td>   login     <input type="text" name=login>     </tr></td>
     <tr><td>  pass     <input type="password" name=haslo>    </tr></td>
   <input type="submit" value="zarejestruj">
    
      
</table>
</form> 

<?php 
            
                                   
$link = mysqli_connect("localhost", "root", "", "kajusko");

     
if(isset($_POST['login']))
{
$_POST['login']=mysqli_real_escape_string($link, $_POST['login']);
$_POST['haslo']=md5(mysqli_real_escape_string($link, $_POST['haslo']));
    
    $q=mysqli_query($link,"insert into uzytkownik(login,haslo)
    values('{$_POST['login']}','{$_POST['haslo']}');") or die (mysqli_error($link));

if (strlen (mysqli_error($link)) > 0) {
		echo "<center><br><br>Nie dodano! <br><br></center>";
		
	} else
	{
		echo 'dodano';
	}
                                 
 }  

                                   
?>                                   
        
        
        
</body>