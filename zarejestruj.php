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

<script src="bootstrap/js/bootstrap.min.js"></script>

<script>
    function validate(form)
    {
    fail= validatelogin(form.login.value)
    fail+= validatepassword(form.password .value)
    fail+= validateimie(form.imie .value)
    fail+= validatenazwisko(form.nazwisko .value)
    fail+= validatepesel(form.pesel .value)
    fail+= validatetelefon(form.telefon .value)
    fail+= validateemail(form.email .value)
    if(fail="") return true
    else{alert(fail); return false}
        
        
        function validatelogin(field)
        {
            if(field=="") return "nie wpisano nazwy użytkownika.\n"
            else if(field.length<5)
             return "Nazwa użytkownika musi składać się z co najmniej 5 znaków.\n"
             else if(/[^a-zA-Z0-9_-]/.test(field))
             return "Niewłasciwe znaki w nazwie użytkownika" 
        }
        function validatepassword(field)
        {
            if(field=="") return "nie wpisano hasła.\n"
                else if(field.length<6) return "hasło musi składać się z conajmniej 6 znaków.\n"
                else if(!/[a-z]/.test(field)||
                        !/[A-Z]/.test(field)||
                        !/[0-9]/.test(field))
                        return "Hasło musi zawierać conajmniej jednen znak z każdego z zakresów 0-9, a-z, A-Z.\n"
                        return ""
                
        }
        function validateimie(field)
        {
            return (field=="")? "nie wpisano imienia.\n":""
        }
        function validatenazwisko(field)
        {
            return (field=="")? "nie wpisano nazwiska.\n":""
        }
        function validatepesel(pesel)
        {
           var reg = /^[0-9]{11}$/;
    if(reg.test(pesel) == false) {
    return "niepoprawny PESEL.\n";}
    else
    {
        var dig = (""+pesel).split("");
        var kontrola = (1*parseInt(dig[0]) + 3*parseInt(dig[1]) + 7*parseInt(dig[2]) + 9*parseInt(dig[3]) + 1*parseInt(dig[4]) + 3*parseInt(dig[5]) + 7*parseInt(dig[6]) + 9*parseInt(dig[7]) + 1*parseInt(dig[8]) + 3*parseInt(dig[9]))%10;
        if(kontrola==0) kontrola = 10;
        kontrola = 10 - kontrola;
        if(parseInt(dig[10])==kontrola)
        return "";
        else
        return "niepoprawny PESEL.\n";
        }
        }
        function validatetelefon(field)
        {
            return (field=="")? "nie wpisano telefonu.\n":""
        }
        function validateemail(field)
        {
            return (field=="")? "nie wpisano maila.\n":""
        
        }
}
    
    
    
    
    </script>




</head>

<body>

 <div class="col-md-4 col-md-offset-4  well well-lg  " >
<h3 class="form-signin-heading"> Rejestracja nowego czytelnika</h3>
<form method=post class="form-signin" onsubmit="return validate(this)" action="dodaj_uzytkownika.php">
<label for="inputLogin" class="sr-only">login</label>
        <input type="text"  name=login class="form-control" placeholder="login" required autofocus>
        <label for="inputPassword" class="sr-only">hasło</label>
        <input type="password" name=haslo class="form-control" placeholder="hasło" required>
        <label for="inputImie" class="sr-only">Imie</label>
        <input type="text"  name=imie class="form-control" placeholder="Imie" required autofocus>
         <label for="inputNazwisko" class="sr-only">Nazwisko</label>
        <input type="text"  name=nazwisko class="form-control" placeholder="Nazwisko" required autofocus>
         <label for="inputpesel" class="sr-only">PESEL</label>
        <input type="text"  name=pesel class="form-control" placeholder="PESEL" required autofocus>
        <label for="inputtelefon" class="sr-only">Telefon</label>
        <input type="text"  name=telefon class="form-control" placeholder="Telefon" required autofocus>
        <label for="inputemail" class="sr-only">email</label>
        <input type="text"  name=email class="form-control" placeholder="email" required autofocus>

<button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj Użytkownika</button>

</form>

    </div>



</body>

</html>