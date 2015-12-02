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


<body>

<a href="zarejestruj.php"> rejestracja nowego uzytkownika </a>

</body>
<?php


require_once("baza.php") ;
$l=mysqli_query($link,
"select id_u from sesje where id='{$_COOKIE['id']}';") or die(mysqli_error($link));
	$l=mysqli_fetch_assoc($l);
	
if($l['id_u'])
{
	$u=mysqli_query($link,
"select login from uzytkownik where id_uzytkownika='{$l['id_u']}';") or die(mysqli_error($link));
	echo "zalogowany: ";
	$u=mysqli_fetch_assoc($u);
	echo $u['login'];
echo<<<_END
    <form method=post float:center action="wyloguj.php">
<input type=submit value="Wyloguj">
</form>
_END;
}
else
{
 echo<<<_END
    <form method=post float:center action="zaloguj.php">
<table>
<tr><td>Login:</td><td><input type=text name=login required></td></tr>
<tr><td>Hasło:</td><td><input type=password name=haslo required></td></tr>
<tr><td colspan=2><input type=submit value="Zaloguj"></td></tr>
</table>
</form> 
_END;
	echo "<br>nie zalogowany";
}

?>
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Home</a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
</ul>

</html>