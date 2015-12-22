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
<script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/md5.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
    
    
  function  hash(form)
    {
               if(form.haslo.value=CryptoJS.MD5(form.haslo.value))
return true;
  else{alert("blad javascript"); return false}      
    }
    
  </script>  
</head>
<body>



<?php
require_once("baza.php") ;
# logowanie
if (isset($_POST['login']) && isset($_POST['haslo']))
{
	$login=  filter_input(INPUT_POST, 'login',FILTER_SANITIZE_STRING);
	$haslo=  filter_input(INPUT_POST, 'haslo',FILTER_SANITIZE_STRING);
    
     if($stmt = $mysqli->prepare("select count(*) as cnt, id_uzytkownika as id_u  from uzytkownik where login=? and haslo=?;"))
         {
         $stmt->bind_param('ss',$login,$haslo);
         $stmt->execute();
         $q=$stmt->get_result();
         $q=$q->fetch_array();
         
	     if($q['cnt']) 
         {
             $id=md5(rand(-1000,1000).microtime());
# dodawanie do sesji w bazie
             if($stmt = $mysqli->prepare("insert into sesje(id_u,id,web,IP)
                 values(?,?,?,?); "))
                 {
                 $stmt->bind_param('iiss', $q['id_u'],$id,$_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR']);
                 $stmt->execute();
                
# tworzenie ciasteczka        
                setcookie('id',$id);
#rozpoczynanie sesji php  
                session_start();
                $_SESSION['id_u']=$q['id_u'];
         
     
?>
        <div class=" col-md-6 col-md-offset-3 alert alert-success">
            <center><h2>Zalogowano!</h2></center>
          <meta http-equiv="refresh" content="1;url=index.php">
        </div>
<?php
                } 
         }
         
	else {
?>      
        <div class="col-md-6 col-md-offset-3 alert alert-error"><center>
            <h2>Niepoprawne dane logowania!</h2></center>
        </div>
       
           
        
<?php
    }}
    
}
    else{?>
            <div class="col-md-4 col-md-offset-4 well well-lg " >

      <form method="post" class="form-signin" onsubmit="return hash(this)" action="zaloguj.php">
        <h2 class="form-signin-heading">Logowanie</h2>
        <label for="inputEmail" class="sr-only">login</label>
        <input type="text"  name=login class="form-control" placeholder="login" required autofocus>
        <label for="inputPassword" class="sr-only">hasło</label>
        <input type="password" name=haslo class="form-control" placeholder="hasło" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> zapamiętaj
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
      </form>
<a href="zarejestruj.php"> rejestracja nowego uzytkownika </a>
    </div><?php 
    }
   
?>
    