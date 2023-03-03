<?php
include 'connection.php';
include '../layouts/header.php';
include '../layouts/menu.php';


//M'he connectat correctament


//$sql = "select id,realname,heroname,gender,race from heroes";
 // $query = $bd->query($sql);
//  while($row = $ordre->fetch(PDO::FETCH_OBJ)) {
//      
//		echo $row->heroname . " - ";
//		echo $row->realname . " - ";
//		echo $row->race . "<br/>";
//  } 
  
?>

<div class="container">
    <a href="formNew.php">Nou</a>
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Real name</th>
        <th scope="col">Hero name</th>
        <th scope="col">Genere</th>
        <th scope="col">Race</th>
        <th scope="col">Operacions</th>
        <th scope="col"></th>
      </tr>
    </thead>
  <tbody>

<?php  

$sql = "select id,realname,heroename,gender,race from heroes";
$query = $bd->query($sql);
// fetchAll sense paràmetre retorna un array amb el conjunt de registres de la BD
// Cada registre serà un array amb indexos numèrics i indexos amb el nom de les columnes
// Retorna els resultats de forma duplicada!
$resultat = $query->fetchAll();
//$resultat = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultat as $super) {
    echo "<tr>";
        echo "<td>".$super['id']."</td>";
        echo "<td>".$super['realname']."</td>"; 
        echo "<td>".$super['heroname']."</td>";
        echo "<td>".$super['gender']."</td>";
        echo "<td>".$super['race']."</td>";
        echo "<td><a href='delete.php?id=".$super['id']."'>Esborrar</a></td>";
        echo "<td><a href='formUpdate.php?id=".$super['id']."'>Actualitzar</a></td>";
    echo"</tr>";
}

?>

</tbody>
</table>
</div>