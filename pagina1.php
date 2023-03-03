<?php

include 'auth/seguretat.php';
include 'layouts/header.php';
include 'layouts/menu.php';

echo "Pagina1<br>";
echo "hola".$_SESSION['username'];

////////////////////////CLASSES EN PHP

class Vehicle {
    public $marca;
    public $model;

}

$v = new Vehicle();
$v->marca = "Peugot";
echo $v->marca;

//////////////////////////////////////  

include 'layouts/footer.php';

?>
