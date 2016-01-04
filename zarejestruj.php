<!DOCTYPE HTML>

 <html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>Dodawanie użytkownika</title>
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/md5.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="xmlhttp.js"></script>
<script src="validate.js"></script>




</head>

<body>

 <div class="col-md-4 col-md-offset-4  well well-lg  " >
<h3 class="form-signin-heading"> Rejestracja nowego czytelnika</h3>
<form method=post class="form-signin" id="rejestracja" onsubmit="return validate(this)" action="dodaj_uzytkownika.php">
<label for="inputLogin" class="sr-only">login</label>
        <input type="text" onblur="validatelogin(this.value);"  name=login  class="form-control" placeholder="login" required autofocus>
        <div class="alert alert-danger">
</div>
        
        <label for="inputPassword" class="sr-only" >hasło</label>
        
        <input type="password" onblur="validatepass(this.value);" name=haslo class="form-control"  placeholder="hasło" required>
        <div class="alert alert-danger">haslo
</div>
        <label for="inputPassword" class="sr-only">Powtórz hasło</label>
        <input type="password" onblur="validate2pass(this.value);" name=haslo2 class="form-control" placeholder="hasło" required>
        <div class="alert alert-danger">Hasła nie są zgodne!
</div>
        <label for="inputImie" class="sr-only">Imie</label>
        <input type="text"  name=imie class="form-control" placeholder="Imie" required autofocus>
         <label for="inputNazwisko" class="sr-only">Nazwisko</label>
        <input type="text"  name=nazwisko class="form-control" placeholder="Nazwisko" required autofocus>
         <label for="inputpesel" class="sr-only">PESEL</label>
        <input type="text" onblur="validatepesel(this.value);"  name=pesel class="form-control" placeholder="PESEL" required autofocus>
        <div class="alert alert-danger">Niepoprawny PESEL!
</div>
        <label for="inputtelefon" class="sr-only">Telefon</label>
        <input type="text"  name=telefon class="form-control" placeholder="Telefon" required autofocus>
        <label for="inputemail" class="sr-only">email</label>
        <input type="text" name=email class="form-control" placeholder="email"required autofocus>
        

<button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj Użytkownika</button>

</form>

    </div>



</body>

</html>
