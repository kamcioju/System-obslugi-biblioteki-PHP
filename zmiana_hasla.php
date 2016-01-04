<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>Biblioteka</title>
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/md5.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<?php 
         session_start(); 

    include_once "baza.php";
    include_once "nawigacja.php"; 
?>
<body>
    
    
    <script>
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
function validate(form)
    {   
        fail="";
        fail+= validatepassword(form.elements['haslo'].value,form.elements['haslo2'].value);
if(fail==""){       form.haslo.value=CryptoJS.MD5(form.haslo.value);
form.hasloold.value=CryptoJS.MD5(form.hasloold.value); form.haslo2.value="pass2";
return true;
            
            }
       else{alert(fail); return false}  
        
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
    }
    </script>
 <?php   
    if (isset($_POST['hasloold']) && isset($_POST['haslo']))
{
        $haslo=  filter_input(INPUT_POST, 'haslo',FILTER_SANITIZE_STRING);
        
        $hasloold=  filter_input(INPUT_POST, 'hasloold',FILTER_SANITIZE_STRING);
       
        
       //session_start();
     if($stmt = $mysqli->prepare("select count(*) as cnt from uzytkownik where id_uzytkownika=? and haslo=?;"))
         {
         $stmt->bind_param('is',$_SESSION['id_u'],$hasloold);
         $stmt->execute();
         $q=$stmt->get_result();
         $q=$q->fetch_array();
         
        if($q['cnt'])
        {
           $stmt =$mysqli->prepare("UPDATE uzytkownik
           SET haslo=?
           WHERE id_uzytkownika=?;");
            $stmt->bind_param('si',$haslo,$_SESSION['id_u']);
            $stmt->execute();
            echo '<div class="col-md-6 col-md-offset-3 alert alert-success" style="display: block">Hasło zmienione!
</div>';
        }else{
            ?>
            
            <div class="col-md-6 col-md-offset-3  well-lg  " >
    <form method=post class="form-signin" id="rejestracja" onsubmit="return validate(this)" action="zmiana_hasla.php">
    <label for="inputPassword" class="sr-only" >stare hasło</label>
        
        <input type="password"  name=hasloold class="form-control"  placeholder="Stare hasło" required>
<label for="inputPassword" class="sr-only" >hasło</label>
       <div class="alert alert-warning" style="display: block">złe hasło!
</div>
        <br>
        <input type="password" onblur="validatepass(this.value);" name=haslo class="form-control"  placeholder="hasło" required>
        <div class="alert alert-danger">haslo
</div>
        <label for="inputPassword" class="sr-only">Powtórz hasło</label>
        <input type="password" onblur="validate2pass(this.value);" name=haslo2 class="form-control" placeholder="hasło" required>
        <div class="alert alert-danger">Hasła nie są zgodne!
</div>
<br><button class="btn btn-lg btn-primary btn-block" type="submit">Zatwierdź</button>

</form> 
           <?php 
            
            
            
        }
            
            
     }
        
        
        
        
   
   
   }else{
    ?>
    <div class="col-md-6 col-md-offset-3  well-lg  " >
    <form method=post class="form-signin" id="rejestracja" onsubmit="return validate(this)" action="zmiana_hasla.php">
    <label for="inputPassword" class="sr-only" >stare hasło</label>
        
        <input type="password"  name=hasloold class="form-control"  placeholder="Stare hasło" required>
<label for="inputPassword" class="sr-only" >hasło</label>
        <br>
        <input type="password" onblur="validatepass(this.value);" name=haslo class="form-control"  placeholder="hasło" required>
        <div class="alert alert-danger">haslo
</div>
        <label for="inputPassword" class="sr-only">Powtórz hasło</label>
        <input type="password" onblur="validate2pass(this.value);" name=haslo2 class="form-control" placeholder="hasło" required>
        <div class="alert alert-danger">Hasła nie są zgodne!
</div>
<br><button class="btn btn-lg btn-primary btn-block" type="submit">Zatwierdź</button>

</form>
    
    
    </div>
    
    
    




<?php
    }
    include_once "stopka.php";
    ?>
    
</body>