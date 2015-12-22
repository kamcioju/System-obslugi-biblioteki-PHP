<?php

include "baza.php";

if (isset($_POST['login'])){
$_POST['imie'] = mysqli_real_escape_string($link, $_POST['imie']);
$_POST['nazwisko'] = mysqli_real_escape_string($link , $_POST['nazwisko']);
$_POST['login'] = mysqli_real_escape_string($link , $_POST['login']);
$_POST['haslo'] = mysqli_real_escape_string($link , $_POST['haslo']);
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
    //dodawanie hashu do linku aktywacyjnego
    $id=mysqli_insert_id($link);
    $hash=md5(rand(-1000,1000).microtime());
	
    $q2=mysqli_query($link, "
	insert into aktywacje (id_uzytkownika, hash)
	values ('{$id}',
            '{$hash}');");
    $headers  = 'From: [your_gmail_account_username]@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
    if(mail("kamcioju@gmail.com","My subject","tresc"))
    {
        echo "wysłano<br>";
    }
    else echo "nie wysłano<br>";
    
    //mail($_POST['email'],"Biblioteka - aktywacja konta", $hash, $headers);
 //mail($_POST['email'],"Subject",$hash,"From: bibliotekapai2015@gmail.com");     
	if (strlen (mysqli_error($link)) > 0) {
		echo "<center><br><br>Nie dodano! <br><br></center>";
		echo mysqli_error($link);
	} else
	{
		echo '<center><br><br><h3>Uzytkownik dodany, kliknij w link potwierdzajacy otrzymany w mailu</h3><br><br></center>';
	}
	
}
?>
<?php
    include_once "stopka.php";
//<meta http-equiv="refresh" content="3;url=zaloguj.php">
    ?>