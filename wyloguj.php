<?php
include_once "stopka.php";
require_once "baza.php" ;
       


if($stmt = $mysqli->prepare("delete from sesje where id=?;"))
  {     
        session_start();
        $stmt->bind_param('i', $_COOKIE['id']);
        $stmt->execute();
        setcookie('id',0-1);
		unset($_COOKIE['id']);
        session_destroy();
  }
echo '<meta http-equiv="refresh" content="1;url=index.php">';
?>
