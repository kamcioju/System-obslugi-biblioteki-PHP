<?php
require_once "baza.php" ;
//echo "$_POST['login'];"
if($stmt = $mysqli->prepare("select * from uzytkownik where login=?"))
         {
         $stmt->bind_param('s',$_POST['login']);
         $stmt->execute();
         $q=$stmt->get_result();
                 #echo $stmt->num_rows;
        $q=$q->fetch_array();
    
    if($q['login'])
        echo $q['login'];
}
?>