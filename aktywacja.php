 <html>
<head><link rel="stylesheet" href="style.css">
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
 <?php

 include_once "baza.php";
 $hash=  filter_input(INPUT_GET, 'hash',FILTER_SANITIZE_STRING);
 if($stmt = $mysqli->prepare("call aktywuj(?)"))
         {
         $stmt->bind_param('s',$hash);
         $stmt->execute();
         $q=$stmt->get_result();
        $q=$q->fetch_array();
     if($q==1){
        echo '<div class=" col-md-6 col-md-offset-3 alert alert-success">
            <center><h2>Konto aktywowane!</h2></center>
          <meta http-equiv="refresh" content="1;url=index.php">
        </div>';
         }else
     {
        echo '<div class=" col-md-6 col-md-offset-3 alert alert-danger">
            <center><h2>Nie udało się aktywować konta, czy link aktywacyjny jest poprawny?</h2></center>
        </div>'; 
     }}
else die('prepare() failed: ' . htmlspecialchars($mysqli->error));

?>
     </body> </html>