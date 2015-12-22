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
<script>
    
    
    var XMLHttp = getXMLHttp();

    function sprlog(g){
    XMLHttp.open("POST", "sprawdz_lohin.php");
XMLHttp.onreadystatechange = handlerFunction;
XMLHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
XMLHttp.send("login="+g);
    
    }
function handlerFunction() {
  if (XMLHttp.readyState == 4) {
      if(XMLHttp.responseText.length>0)
          //if(XMLHttp.responseText.indexOf("istnieje")>-1  )
   { 
       $("input[name=login]").next().show(); 
       $("input[name=login]").next().html("Login: "+XMLHttp.responseText+" istnieje!");}
      else {
          $("input[name=login]").next().hide();
      }
  }
}

    
    
    
    
    
    
    function validate(form)
    {   
        fail="";
        fail+= validatepassword(form.elements['haslo'].value,form.elements['haslo2'].value);

    fail+= validatelogin(form.login.value);;
    fail+= validateimie(form.imie .value);
    fail+= validatenazwisko(form.nazwisko .value);
    fail+= validatepesel(form.pesel .value);
    fail+= validatetelefon(form.telefon .value);
    fail+= validateemail(form.email .value);
    if(fail==""){
//$("input[name=haslohash]").val(CryptoJS.MD5($("input[name=haslo]").val()) );
       form.haslo.value=CryptoJS.MD5(form.haslo.value);
        //$("input[name=haslo]").val("pass2");
        //$("input[name=haslo2]").val("pass3");
        //form.elements['haslohash'].value="asdf";
        return true;
        }
    else{alert(fail); return false}
        
        
        function validatelogin(field)
        {
            if(field=="") return "nie wpisano nazwy użytkownika.\n";
            else if(field.length<5)
             return "Nazwa użytkownika musi składać się z co najmniej 5 znaków.\n";
             else if(/[^a-zA-Z0-9_-]/.test(field))
             return "Niewłasciwe znaki w nazwie użytkownika";
            return "";
        }
        function validatepassword(field, field2)
        {
            if(field=="") return "nie wpisano hasła.\n";
                else if(field.length<6) return "hasło musi składać się z conajmniej 6 znaków.\n";
                else if(!/[a-z]/.test(field)||
                        !/[A-Z]/.test(field)||
                        !/[0-9]/.test(field))
                        return "Hasło musi zawierać conajmniej jednen znak z każdego z zakresów 0-9, a-z, A-Z.\n";
                else if(field!=field2)
                        return"Podane hasła nie są zgodne";
                        return "";
                
        }
        function validateimie(field)
        {
            return (field=="")? "nie wpisano imienia.\n":"";
        }
        function validatenazwisko(field)
        {
            return (field=="")? "nie wpisano nazwiska.\n":"";
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
<form method=post class="form-signin" id="rejestracja" onsubmit="return validate(this)" action="dodaj_uzytkownika.php">
<label for="inputLogin" class="sr-only">login</label>
        <input type="text" onblur="sprlog(this.value);"  name=login  class="form-control" placeholder="login" required autofocus>
        <div class="alert alert-danger">
</div>
        
        <label for="inputPassword" class="sr-only" >hasło</label>
        
        <input type="password" name=haslo class="form-control"  placeholder="hasło" required>
        <div class="alert alert-danger">
</div>
        <label for="inputPassword" class="sr-only">Powtórz hasło</label>
        <input type="password" name=haslo2 class="form-control" placeholder="hasło" required>
        <div class="alert alert-danger">Hasła nie są zgodne!
</div>
        <label for="inputImie" class="sr-only">Imie</label>
        <input type="text"  name=imie class="form-control" placeholder="Imie" required autofocus>
         <label for="inputNazwisko" class="sr-only">Nazwisko</label>
        <input type="text"  name=nazwisko class="form-control" placeholder="Nazwisko" required autofocus>
         <label for="inputpesel" class="sr-only">PESEL</label>
        <input type="text"  name=pesel class="form-control" placeholder="PESEL" required autofocus>
        <label for="inputtelefon" class="sr-only">Telefon</label>
        <input type="text"  name=telefon class="form-control" placeholder="Telefon" required autofocus>
        <label for="inputemail" class="sr-only">email</label>
        <input type="text" name=email class="form-control" placeholder="email"required autofocus>
        

<button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj Użytkownika</button>

</form>

    </div>



</body>

</html>
