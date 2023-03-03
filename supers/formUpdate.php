<?php
include 'connection.php';
include '../layouts/header.php';
include '../layouts/menu.php';

if(isset($_GET['id'])) {
    
    $id =$_GET['id']; 
    $sql = "select * from heroes where id=:id";
    $ordre = $bd->prepare($sql);
    $ordre->bindValue(':id',$id);
    
    $ordre->execute(); 
    
    $res = $ordre->fetch(PDO::FETCH_ASSOC);
    if($res==null) {
        echo "Error: No existeix el super!";
        exit;
    }
    print_r($res);
    
}
/*
 * <?php echo $var;?>
 * <?=$var;?>
*/
?>

<div class="container">
    <form method="POST" action="update.php?id=<?=$res['id'];?>">
        
        <input name="id" type="hidden" value="<?=$res['id'];?>" >
        
      <div class="mb-3">
        <label for="InputHeroname" class="form-label">Hero name</label>
        <input name="heroname" type="text" value="<?=$res['heroname'];?>" class="form-control" id="InputHeroename" >
      </div>

        <div class="mb-3">
        <label for="InputRealname" class="form-label">Real name</label>
        <input name="realname" type="text" value="<?=$res['realname'];?>" class="form-control" id="InputRealename" >
      </div>

        <div class="mb-3">
        <label for="InputGender" class="form-label">Gender</label>
        <input name="gender" type="text" value="<?=$res['gender'];?>" class="form-control" id="InputGender">
      </div>

        <div class="mb-3">
        <label for="InputRace" class="form-label">Race</label>
        <input name="race" type="text" value="<?=$res['race'];?>" class="form-control" id="InputRace">
      </div> 
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
include '../layouts/footer.php';

?>
