<?php

session_start();
$usuaris=["prova"=>"prova", 
          "mponts" =>"656747474",
          "nsanchez" =>"784378h834t" 
    ];

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    $missatge= "Variables formularis no existeix";
    $_SESSION['missatge']=$missatge;
    header("Location: login.php");
}
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    if(!isset($usuaris[$username])) {
     $missatge= "L'usuari no existeix";
     $_SESSION['missatge']=$missatge;
     header("Location: login.php");
     exit;
    }
    
    if($usuaris[$username]!=$password) {
            $missatge= "El password es incorrecte";
            $_SESSION['missatge']=$missatge;
            header("Location: login.php");
            exit;
    }
    
    //echo "Usuari validat correctament";
    $_SESSION['username'] = $username;
    
    header("Location: ../index.php");
    

?>
