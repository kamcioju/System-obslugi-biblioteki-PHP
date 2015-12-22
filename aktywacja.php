<?php

 include_once "baza.php";
 $hash=  filter_input(INPUT_GET, 'hash',FILTER_SANITIZE_STRING);
 if($stmt = $mysqli->prepare("update uzytkownik set aktywacja=1 where id_uzytkownika
in(Select id_uzytkownika from aktywacje where hash=?);"))
         {
         $stmt->bind_param('s',$hash);
         $stmt->execute();
         $q=$stmt->get_result();
         }
else die('prepare() failed: ' . htmlspecialchars($mysqli->error));


?>