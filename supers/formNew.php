<?php
include 'connection.php';
include '../layouts/header.php';
include '../layouts/menu.php';
?>

<?php
if(isset($_POST['heroname']) && isset($_POST['realname']) && isset($_POST['gender']) && isset($_POST['race'])) {
    
    $heroname=$_POST['heroname'];
    $realname=$_POST['realname'];
    $gender=$_POST['gender'];
    $race=$_POST['race'];
    
    $sql = "insert into heroes(heroname, realname, gender, race)". "values (:heroname,:realname,:gender,:race)";
    $ordre = $bd->prepare($sql);
    $ordre->bindValue(':heroname',$heroname);  // En la sentència preparada substitueix :gender per el valor de la variable $genere
    $ordre->bindValue(':realname',$realname);
    $ordre->bindValue(':gender',$gender);
    $ordre->bindValue(':race',$race);
    $ordre->execute(); 
    
    
    header("Location: list.php");
    exit;
}

?>
<div class="container">
    <form method="POST" action="formNew.php">
      <div class="mb-3">
        <label for="InputHeroname" class="form-label">Hero name</label>
        <input name="heroname" type="text" class="form-control" id="InputHeroename" >
      </div>

        <div class="mb-3">
        <label for="InputRealname" class="form-label">Real name</label>
        <input name="realname" type="text" class="form-control" id="InputRealename" >
      </div>

        <div class="mb-3">
        <label for="InputGender" class="form-label">Gender</label>
        <input name="gender" type="text" class="form-control" id="InputGender">
      </div>

        <div class="mb-3">
        <label for="InputRace" class="form-label">Race</label>
        <input name="race" type="text" class="form-control" id="InputRace">
      </div> 
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php


?>