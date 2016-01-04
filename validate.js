 var XMLHttp = getXMLHttp();

    function validatelogin(field){
    XMLHttp.open("POST", "sprawdz_lohin.php");
XMLHttp.onreadystatechange = handlerFunction;
XMLHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
XMLHttp.send("login="+field);
    
   
function handlerFunction() {
  if (XMLHttp.readyState == 4) {
      if(XMLHttp.responseText.length>0)
          //if(XMLHttp.responseText.indexOf("istnieje")>-1  )
      { 
       $("input[name=login]").next().show(); 
       $("input[name=login]").next().html("Login: "+XMLHttp.responseText+" istnieje!");}
       else if(field.length>0) 
           {
       if(field.length<5)
          { 
       $("input[name=login]").next().show(); 
       $("input[name=login]").next().html("Nazwa użytkownika musi składać się z co najmniej 5 znaków!");}
      else if(/[^a-zA-Z0-9_-]/.test(field))
           { 
       $("input[name=login]").next().show(); 
       $("input[name=login]").next().html("Niewłasciwe znaki w nazwie użytkownika!");}
               else {
          $("input[name=login]").next().hide();
      }
               }
      
      
  }
}
 }
function validatepass(field)
    {
              if(field.length>0)
                  {
                if(field.length<6)
                    {
                $("input[name=haslo]").next().show(); 
                $("input[name=haslo]").next().html("hasło musi składać się z conajmniej 6 znaków.");              
                } 
                else if(!/[a-z]/.test(field)||
                        !/[A-Z]/.test(field)||
                        !/[0-9]/.test(field))
                    {
                $("input[name=haslo]").next().show(); 
                $("input[name=haslo]").next().html("Hasło musi zawierać conajmniej jednen znak z każdego z zakresów 0-9, a-z, A-Z");              
                }
                       else
                    {
                    $("input[name=haslo]").next().hide();
                    }
                  }
                else
                    {
                    $("input[name=haslo]").next().hide();
                    }
                
        }
    
function validate2pass(field)
    {
          if($("input[name=haslo]").val()==field) 
              {
                $("input[name=haslo2]").next().hide(); 
                }
        else
            {
               $("input[name=haslo2]").next().show(); 
            }
        
    }
    
    
 function validatepesel(pesel)
        {
           var reg = /^[0-9]{11}$/;
    if(reg.test(pesel) == false) 
    {
    $("input[name=pesel]").next().show(); 
    }
    else
    {
        var dig = (""+pesel).split("");
        var kontrola = (1*parseInt(dig[0]) + 3*parseInt(dig[1]) + 7*parseInt(dig[2]) + 9*parseInt(dig[3]) + 1*parseInt(dig[4]) + 3*parseInt(dig[5]) + 7*parseInt(dig[6]) + 9*parseInt(dig[7]) + 1*parseInt(dig[8]) + 3*parseInt(dig[9]))%10;
        if(kontrola==0) kontrola = 10;
        kontrola = 10 - kontrola;
        if(parseInt(dig[10])==kontrola)
        $("input[name=pesel]").next().hide(); 
        else
            {
    $("input[name=pesel]").next().show();   
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
    
