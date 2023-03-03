<?php

include 'connection.php';

if(isset($_GET['id']) && isset($_POST['heroname']) && isset($_POST['realname']) && isset($_POST['gender']) && isset($_POST['race'])) {
    
    $id=$_GET['id'];
    $heroname=$_POST['heroname'];
    $realname=$_POST['realname'];
    $gender=$_POST['gender'];
    $race=$_POST['race'];
    
    $sql = "update heroes set heroname=:heroname, realname=:realname,gender=:gender,race=:race where id=:id";
    
    
    $ordre = $bd->prepare($sql);
    $ordre->bindValue(':heroname',$heroname);  // En la sentència preparada substitueix :gender per el valor de la variable $genere
    $ordre->bindValue(':realname',$realname);
    $ordre->bindValue(':gender',$gender);
    $ordre->bindValue(':race',$race);
    $ordre->bindValue(':id',$id);
    $ordre->execute(); 
    
    
   header("Location: list.php");
    exit;
}

?>
