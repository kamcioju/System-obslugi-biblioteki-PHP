<?
include "baza.php";
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
	mysqli_query($link,
	"insert into sesje(id_u,id,web,IP)
	values('{$q['id_u']}', '$id', '{$_SERVER['HTTP_USER_AGENT']}', '{$_SERVER['REMOTE_ADDR']}');
	") or die (mysqli_error($link));
	setcookie('id',$id);
	echo "zalogowano";
	}
	else {echo "błąd logowania";}
}
?>