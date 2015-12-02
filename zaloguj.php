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
<body>

    <div class="col-md-4 col-md-offset-4 well well-lg " >

      <form method="post" class="form-signin" action="zaloguj.php">
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
    </div> <!-- /container -->

<?php
require_once("baza.php") ;
if (isset($_POST['login']))
{
	$_POST['login'] = mysqli_real_escape_string($link , $_POST['login']);
	$_POST['haslo'] = md5(mysqli_real_escape_string($link , $_POST['haslo']));
	$q=mysqli_query($link, 
	"select count(*) as cnt, id_uzytkownika as id_u  from uzytkownik where 
	login='{$_POST['login']}' and haslo='{$_POST['haslo']}';") or die(mysqli_error($link));
	$q=mysqli_fetch_assoc($q);
	if($q['cnt']) {
	   $id=md5(rand(-1000,1000).microtime());
	   mysqli_query($link, "insert into sesje(id_u,id,web,IP)
       values('{$q['id_u']}', '$id', '{$_SERVER['HTTP_USER_AGENT']}',
       '{$_SERVER['REMOTE_ADDR']}'); ") or die (mysqli_error($link));
	   setcookie('id',$id);
?>
        <div class=" col-md-6 col-md-offset-3 alert alert-success">
            <center><h2>Zalogowano!</h2></center>
            <meta http-equiv="refresh" content="2;url=index.php">
        </div>
<?php
    }
	else {
?>
        <div class="col-md-6 col-md-offset-3 alert alert-error"><center>
            <h2>Niepoprawne dane logowania!</h2></center>
        </div>
<?php
    }
}
?>