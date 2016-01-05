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
<link rel="stylesheet" href="jasny-bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.css">


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="js/jasny-bootstrap.js"></script>
   
<script src="js/bootstrap-datepicker.js"></script>
</head>



<body>
 <script> 
     $(document).ready(function(){
        var licznikg=2;
        var licznika=2;
        $("#dodaj_gatunek").on("click",function(e){
            e.preventDefault();
            $(this).prev().after('<input type="text" name=gatunek'+licznikg+' class="form-control" required autofocus>');
            licznikg++;
            });
         
         $("#usun_gatunek").on("click",function(e){
             if(licznikg>2)
                 { $(this).prev().prev().remove();
                 licznikg--;
                 }
                
            });
         
        $("#dodaj_autora").on("click",function(e){
            e.preventDefault();
            $(".autor").last().after('<div class="row autor" ><div class="col-md-4" >  <br>Imie:<input type="text" name=autorimie'+licznika+' class="form-control" required autofocus></div><div class="col-md-4" >  <br>Nazwisko:<input type="text" name=autornazwisko'+licznika+' class="form-control" required autofocus></div><div class="col-md-4" > <br>Rok urodzenia:<div class=input-group date><input type="text" name=autorrok'+licznika+' class=" form-control date data"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div></div></div>');
            $('.data').datepicker({
    format: "yyyy",
    startView: 2,
    minViewMode: 2,
    language: "pl"
});
            licznika++;
            });
           $("#usun_autora").on("click",function(e){
             if(licznika>2)
                 { $(".autor").last().remove();
                 licznika--;
                 }
           
     });
         
       /* $('#rok').datepicker({startView : 'decade', format : 'yyyy', enableYearToMonth : false, enableMonthToDay :             false,});*/
  $('.data').datepicker({
    format: "yyyy",
    startView: 2,
    minViewMode: 2,
    language: "pl"
});
            });
    </script>
<?php 
    include_once "baza.php";
    include_once "nawigacja.php";

         if(isset($_POST['tytul'],$_POST['rok'],$_POST['id_egz'],
                  $_POST['l_stron'],$_POST['jezyk'],$_POST['wydawnictwo'],
                  $_POST['wydawnictwokraj'],$_POST['gatunek1'],
                  $_POST['autorimie1'],$_POST['autornazwisko1'],
                  $_POST['autorrok1'])
           )
 {               
            //sprawdzanie czy książka istnieje
   try{
        $mysqli->autocommit(false);  
        $mysqli->query("SET TRANSACTION ISOLATION LEVEL READ COMMITTED");
        $stmt = $mysqli->prepare("select egzemplarz_id from ksiazka where egzemplarz_id=?;");
               if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }else
                    {
                     $stmt->bind_param('i',$_POST['id_egz']);
                     $stmt->execute();
                     $stmt=$stmt->get_result();
                        $res=$stmt->fetch_array();
                        $stmt->close();
                    //zachowywanie id
                   if(isset($res[0]))
                   {
                        throw new RuntimeException('Książka o podanym numerze: '.$res[0].' istnieje');               
                   }
                    }
       
       
       
       
       
        //sprawdzanie poprawnosci pliku
       $ext=null;
       if (!isset($_FILES['okladka']['error']) ||is_array($_FILES['okladka']['error']))
      
   //sprawdzanie poprawnosci dodawanej okładki
       {    
           {
                    throw new RuntimeException('Błąd formularza.');
                }
                switch ($_FILES['okladka']['error']) 
                {
                    case UPLOAD_ERR_OK: break;
                    case UPLOAD_ERR_NO_FILE:  throw new RuntimeException('brak pliku.');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE: throw new RuntimeException('Przekroczony rozmiar pliku.');
                    default: throw new RuntimeException('Nieznany błąd.');
                }

                if ($_FILES['okladka']['size'] > 500000) 
                {
                    throw new RuntimeException('Przekroczony rozmiar pliku.');
                }

                $finfo = new finfo(FILEINFO_MIME_TYPE);
                if (false === $ext = array_search($finfo->file($_FILES['okladka']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                    true
                )) 
                {
                    throw new RuntimeException('Niewłaściwy format pliku.');
                }  

        } 

       
//dodawanie unikalnych gatunków
         $licznik=1;
       $gat_id=array();  //tabela z id gatunków
        while(isset($_POST['gatunek'.$licznik]))
           {
            //sprawdzanie istnienia gatunku   
             $stmt = $mysqli->prepare("select * from gatunek where nazwa=?;");
               if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }else
                    {
                     $stmt->bind_param('s',$_POST['gatunek'.$licznik]);
                     $stmt->execute();
                     $stmt=$stmt->get_result();
                        $res=$stmt->fetch_array();
                        $stmt->close();
                    //zachowywanie id
                   if(isset($res[0]))
                   {
                    array_push($gat_id, $res[0]); 
                   }
                   //dodawanie gatunku nieistniejącego
                   else
                   {
                     $stmt = $mysqli->prepare("insert into gatunek(nazwa) values(?);");
               if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }else
                    {
                     $stmt->bind_param('s',$_POST['gatunek'.$licznik]);
                     $stmt->execute();
                     $res=mysqli_stmt_insert_id($stmt);
                     $stmt->close();   
                     array_push($gat_id, $res); 
                     
                   }
                   }
               }
            
               /*
               $stmt = $mysqli->prepare("insert into 
                gatunek(nazwa) SELECT ? from gatunek where
                not exists (select * from gatunek where nazwa=?) limit 1;");
                    if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }
               else
                    {
                     $stmt->bind_param('ss',$_POST['gatunek'.$licznik],$_POST['gatunek'.$licznik]);
                     $stmt->execute();
                     
                      $result = $stmt->fetch(); 
                 
                   echo $mysqli->insert_id;
                     $stmt->close();
                    }
              
               */
                $licznik++;
           }
           /*
           foreach($gat_id as $key=>$val)
               {
                   echo $key." ".$val.'<br>';
               }
               */
           
           //dodawanie unikalnych autorów

           $licznik=1;
        $aut_id=array();   //tabela z id autorów
           while(isset($_POST['autorimie'.$licznik],
                       $_POST['autornazwisko'.$licznik],$_POST['autorrok'.$licznik]))
           {
               $stmt = $mysqli->prepare("select autor_id from autor where imie=? and nazwisko=? and `rok urodzenia`=?;");
               if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }else
                    {
                     if(!$stmt->bind_param('ssi',$_POST['autorimie'.$licznik],
                            $_POST['autornazwisko'.$licznik],$_POST['autorrok'.$licznik]))
                        throw new RuntimeException( "blad przypisania");
                     if(!$stmt->execute())
                          throw new RuntimeException("blad wykonania");
                     $stmt=$stmt->get_result();
                        $res=$stmt->fetch_array();
                        $stmt->close();
                    //zachowywanie id
                   if(isset($res[0]))
                   {
                    array_push($aut_id, $res[0]); 
                   }
                   //dodawanie autora nieistniejącego
                   else
                   {
                     $stmt = $mysqli->prepare("insert into autor(imie,nazwisko,`rok urodzenia`) values(?,?,?);");
               if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }else
                    {
                     $stmt->bind_param('ssi',$_POST['autorimie'.$licznik],
                            $_POST['autornazwisko'.$licznik],$_POST['autorrok'.$licznik]);
                     $stmt->execute();
                     $res=mysqli_stmt_insert_id($stmt);
                     $stmt->close();   
                     array_push($aut_id, $res); 
                   }
                   }
               }
               
               
               
               /*
                $stmt = $mysqli->prepare("insert into 
                autor(imie,nazwisko,`rok urodzenia`) SELECT ?,?,? from autor where
                not exists (select * from autor where imie=? and nazwisko=? and `rok urodzenia`=?)                      limit 1;");
                    if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }
               else
                    {
                     $stmt->bind_param('ssissi',
                    $_POST['autorimie'.$licznik],$_POST['autornazwisko'.$licznik],
                    $_POST['autorrok'.$licznik],$_POST['autorimie'.$licznik],
                    $_POST['autornazwisko'.$licznik],$_POST['autorrok'.$licznik]);
                     $stmt->execute();
                     $stmt->close();
                    }*/
               $licznik++;
           }
       

       //dodawanie unikalnych wydawnictw
        $wyd_id=null;
       {
       $stmt = $mysqli->prepare("select * from wydawnictwo where nazwa=?;");
               if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }else
                    {
                     $stmt->bind_param('s',$_POST['wydawnictwo']);
                     $stmt->execute();
                     $stmt=$stmt->get_result();
                        $res=$stmt->fetch_array();
                        $stmt->close();
                    //zachowywanie id
                   if(isset($res[0]))
                   {
                    $wyd_id=$res[0];
                   }
                   //dodawanie gatunku nieistniejącego
                   else
                   {
                     $stmt = $mysqli->prepare("insert into wydawnictwo(nazwa) values(?);");
               if ( !$stmt ) 
                    {   
                        throw new RuntimeException($mysqli->errno." ".$mysqli->error);
                    }else
                    {
                     $stmt->bind_param('s',$_POST['wydawnictwo']);
                     $stmt->execute();
                     $res=mysqli_stmt_insert_id($stmt);
                     $stmt->close();   
                     $wyd_id=$res;
                     
                   }
                   }
               }}
       /*
               foreach($aut_id as $key=>$val)
               {
                   echo $key." ".$val.'<br>';
               }
             */

       //dodawanie książki
       
        $id_ks=null;
       {
        $stmt = $mysqli->prepare("insert into ksiazka(tytul,r_wydania,egzemplarz_id,l_stron,jezyk_id,wydawnictwo_id,dostepnosc)
        values(?,?,?,?,?,?,?);");
        if ( !$stmt ) 
        {
            throw new RuntimeException($mysqli->errno." ".$mysqli->error);
            die;
        } else
        {
            $dost=1;
        $stmt->bind_param('siiiiii',$_POST['tytul'],$_POST['rok'],$_POST['id_egz'],
                          $_POST['l_stron'],$_POST['jezyk'],$wyd_id,$dost);
        if($stmt->execute())
        {
            $id_ks=mysqli_stmt_insert_id($stmt);
        }
        else
        {
             throw new RuntimeException('Błąd Zapytania.');
        }       
        }          
     
       }       //dodawanie gatunków do książki
    foreach($gat_id as $key=>$gatunek)  
       {
        $stmt = $mysqli->prepare("insert into gatunki(gatunek_id,ksiazka_id)
        values(?,?);");
        if ( !$stmt ) 
        {
            throw new RuntimeException($mysqli->errno." ".$mysqli->error);
        } else
        {
        $stmt->bind_param('ii',$gatunek,$id_ks);
        if(!$stmt->execute())
       
        {
             throw new RuntimeException('Błąd dodawania gatunków do książki.');
        }       
        }          
     
       }
          //dodawanie autorów do książki
    foreach($aut_id as $key=>$autor)  
       {

        $stmt = $mysqli->prepare("insert into autorzy(autor_id,ksiazka_id)
        values(?,?);");
        if ( !$stmt ) 
        {
            throw new RuntimeException($mysqli->errno." ".$mysqli->error);
        } else
        {
        $stmt->bind_param('ii',$autor,$id_ks);
        if(!$stmt->execute())
        {
             throw new RuntimeException('Błąd dodawania autorów do książki.');
        }       
        }          
     
       }
      
       
       //upload plików
       {
            
            $target_dir = "okladki/";
            $target_file = $target_dir .$id_ks.".".$ext;

            if (!move_uploaded_file($_FILES['okladka']['tmp_name'],$target_file)) 
            {
                throw new RuntimeException('Błąd przenoszenia pliku.');
            }
            $mysqli->commit();
           echo '<div class="col-md-6 col-md-offset-3 alert alert-success" style="display: block">Dodano książkę!
    </div>';
       }
      }
       catch (RuntimeException $e) 
        {
           $mysqli->rollBack();

           echo '<div class="col-md-6 col-md-offset-3 alert alert-danger" style="display: block">'.
                $e->getMessage()
                .'</div>';
        }
 
}
  ?>  
    
    
    
    

 <div class="col-md-6 col-md-offset-3  well-lg  " >
    <form enctype="multipart/form-data" method=post class="form-signin" id="rejestracja" action="dodaj_ksiazke.php">
<h4>Dane książki:</h4>
    Tytuł:
    <input type="text" name=tytul class="form-control" required autofocus>
    <br>Rok wydania:
    <div class="input-group date">
  <input type="text" name=rok class=" form-control date data"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> 
</div>
    <br>ISBN :
    <input type="number" name=id_egz class="form-control" maxlength="12" placeholder="999-99-999-9999-9" required autofocus>
    <br>liczba stron:
    <input type="number" name=l_stron class="form-control" min="0" max="10000" required autofocus>
    <br>Język:
    <div class="form-group">
              <select class="form-control" name=jezyk>
                <option value=1>Polski</option>
                <option value=2>Angielski</option>
                <option value=3>Niemiecki</option>
                <option value=4>Rosyjski</option>
                <option value=5>Hiszpański</option>
                <option value=6>Francuski</option>
                <option value=7>Łaciński</option>
              </select>
    </div>
    <br>Nazwa wydawnictwa:
    <input type="text" name=wydawnictwo class="form-control" required autofocus>
    <br>Kraj wydawnictwa:
    <div class="form-group">
              <select class="form-control" name=wydawnictwokraj>
                <option value=1>Polska</option>
                <option value=2>Anglia</option>
                <option value=3>Niemcy</option>
                <option value=4>Rosja</option>
                <option value=5>Hiszpania</option>
                <option value=6>Francja</option>
                <option value=7>Inny</option>
              </select>
    </div>    <br><h4>Gatunki:</h4>
    <input type="text" name=gatunek1 class="form-control" required autofocus>
      <button id="dodaj_gatunek" type="button" class="btn btn-info btn-small">dodaj gatunek</button>
      <button id="usun_gatunek" type="button" class="btn btn-info btn-small">Usuń gatunek</button>

      
   
    <br><h4>Autorzy:</h4>
    
       <div class="row autor">
        <div class="col-md-4" >  
        <br>Imie:
          <input type="text" name=autorimie1 class="form-control" required autofocus></div>
         <div class="col-md-4" >  <br>Nazwisko:
             <input type="text" name=autornazwisko1 class="form-control" required autofocus></div>
        <div class="col-md-4 " > <br>Rok urodzenia:
<div class=input-group date>
  <input type="text" name=autorrok1 class=" form-control date data">
    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div></div></div>        <br> <br>
      
      <button id="dodaj_autora" type="button" class="btn btn-info btn-small">dodaj autora</button>
      <button id="usun_autora" type="button" class="btn btn-info btn-small">usuń autora</button>  
    <br>
     <br>
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" 
             style="max-width: 200px; max-height: 150px;"></div>
        <div>
            <span class="btn btn-default btn-file">
        <span class="fileinput-new">Wybierz okładkę</span>
            <span class="fileinput-exists">Zmień</span>
            <input type="file" name="okladka" id="okladka">
            </span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Usuń</a>
        </div>
    </div>
    <br>
    <br>
    <button class="btn btn-primary btn-lg" type="submit">Dodaj</button>
</form>
    
    
</div>

<?php
    include_once "stopka.php";
    ?>
</body>
</html>