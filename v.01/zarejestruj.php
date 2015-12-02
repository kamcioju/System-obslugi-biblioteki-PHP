<!DOCTYPE HTML>

<html>
<head>
<meta charset="utf-8">
<title>Biblioteka</title>
</head>

<body>
<pre>
<center>
<h1> Rejestracja nowego czytelnika</h1>
<form method=post float:center action="dodaj_uzytkownika.php">
<table>
<tr><td>Login:</td><td><input type=text name=login required></td></tr>
<tr><td>Hasło:</td><td><input type=password name=haslo required></td></tr>
<tr><td>imie:</td><td><input type=text name=imie required></td></tr>
<tr><td>nazwisko:</td><td><input type=text name=nazwisko required></td></tr>
<tr><td>PESEL:</td><td><input type=intval name=pesel required ></td></tr>
<tr><td>telefon:</td><td><input type=text name=telefon required maxlength=11></td></tr>
<tr><td>email:</td><td><input type=email name=email required placeholder="Podaj prawidłowy adres email!"></td></tr>
<tr><td colspan=2><input type=submit value="Dodaj studenta"></td></tr>
</table>
</form>
</center>

</pre>



</body>

</html>