<?
include "baza.php";
if (isset($_POST['login'])){
$_POST['imie'] = mysqli_real_escape_string($link, $_POST['imie']);
$_POST['nazwisko'] = mysqli_real_escape_string($link , $_POST['nazwisko']);
$_POST['login'] = mysqli_real_escape_string($link , $_POST['login']);
$_POST['haslo'] = md5(mysqli_real_escape_string($link , $_POST['haslo']));
$_POST['pesel'] = mysqli_real_escape_string($link , $_POST['pesel']);
$_POST['telefon'] = mysqli_real_escape_string($link , $_POST['telefon']);
$_POST['email'] = mysqli_real_escape_string($link , $_POST['email']);
	$q=mysqli_query($link, "
	insert into uzytkownik (login, haslo, imie, nazwisko, pesel,telefon,email)
	values (
	'{$_POST['login']}', 
	'{$_POST['haslo']}' ,
	'{$_POST['pesel']}', 
	'{$_POST['telefon']}' ,
	'{$_POST['email']}' ,
	'{$_POST['imie']}' ,
	'{$_POST['nazwisko']}');
	");
	
	if (strlen (mysqli_error($link)) > 0) {
		echo "<center><br><br>Nie dodano! <br><br></center>";
		
	} else
	{
		echo "<center><br><br><h3>Uzytkownik dodany, kliknij w link potwierdzający otrzymany w mailu</h3><br><br></center>";
	}
	
}
?>
