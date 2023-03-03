<?php
include 'connection.php';

if(isset($_GET['id'])) {
    
    $id =$_GET['id']; 
    $sql = "delete from heroes where id=:id";
    $ordre = $bd->prepare($sql);
    $ordre->bindValue(':id',$id);
    
    $ordre->execute(); 
}

header("Location: list.php");


?>