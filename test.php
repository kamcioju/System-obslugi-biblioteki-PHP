<?php  
      function longdate($timestamp)
{
    return date("l F jS Y", $timestamp);
}
echo "dzisiejsza data to: ".longdate(time());

if(isset($_POST['wejscie']))
{
$zmienna=$_POST['wejscie'];
$zmienna+=4;
echo $zmienna;
 }   
    ?>
    <form action="test.php" method="post">
    <input type="text" name="wejscie">
    <input type="submit" value="wyslij">     
    
    
</form>