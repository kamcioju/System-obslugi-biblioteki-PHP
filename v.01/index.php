<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Biblioteka</title>
</head>
<form method=post float:center action="zaloguj.php">
<table>
<tr><td>Login:</td><td><input type=text name=login required></td></tr>
<tr><td>Hasło:</td><td><input type=password name=haslo required></td></tr>
<tr><td colspan=2><input type=submit value="Zaloguj"></td></tr>
</table>
</form>

<body>
<center>
<a href="zarejestruj.php"> rejestracja nowego uzytkownika </a>
</ceter>
</body>
<form method=post float:center action="wyloguj.php">
<input type=submit value="Wyloguj">
</form>


<?
include "baza.php";
$l=mysqli_query($link,
"select id_u from sesje  where id='{$_COOKIE['id']}';") or die(mysqli_error($link));
	$l=mysqli_fetch_assoc($l);
	
if($l['id_u'])
{
	$u=mysqli_query($link,
"select login from uzytkownik  where id_uzytkownika='{$l['id_u']}';") or die(mysqli_error($link));
	echo "zalogowany: ";
	$u=mysqli_fetch_assoc($u);
	echo $u['login'];
}
else
{
	echo "nie zalogowany";
}
?>


</html>