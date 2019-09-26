<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "header.php";
?>
<br />
<br />
<br />
<?php
$idUser = filter_input(INPUT_GET, "idUser");

$submit = filter_input(INPUT_POST, "submit");


    $sql = $mysqli->prepare("SELECT * FROM users u
    WHERE id_user LIKE ?");
    $sql->bind_param("s", $idUser);
    $sql->execute();
    $listUser = $sql->get_result()->fetch_assoc();
    


    var_dump($submit);
    if ($submit == 'odeslat') {
        echo "formulář byl odeslán";
        $email = filter_input(INPUT_POST, "email");
        $name = filter_input(INPUT_POST, "name");
        $password = filter_input(INPUT_POST, "password");
        $birthdate = filter_input(INPUT_POST, "birthdate");
        

        var_dump($birthdate);
        define('SALT', 'jbakbdaisbdoisaiabdsě+abo!');
        $hashedPassword = md5($password . SALT);
        
    
    
        $sql1 = $mysqli->prepare("UPDATE users SET email= ?, name= ?, password= ?, birthdate= ?
        WHERE id_user = ?
         ");
    
        $sql1->bind_param('sssss', $email, $name, $hashedPassword, $birthdate, $idUser) ;
        $sql1->execute();
        // echo "provedeno";
    }

  var_dump($listUser); 
?>


<form action="edit_user.php?idUser=<?php echo $listUser['id_user']; ?>" method="post">

  <div class="form-group">
  <!-- <label for="email">role</label>
    <input type="text" name="role" class="form-control" id="role" aria-describedby="role" placeholder="role" -->
      <!-- value="<?php echo $listUser['id_role'] ?>"> -->
    <label for="email">email</label>
    <input type="text" name="email" class="form-control" id="email" aria-describedby="email" placeholder="EMAIL"
      value="<?php echo $listUser['email'] ?>">
      <label for="email">name</label>
    <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="name"
      value="<?php echo $listUser['name'] ?>">
    <label for="password">heslo</label>
    <input type="text" name="password" class="form-control" id="password" aria-describedby="password" placeholder="PASS"
      value="<?php  ?>" <label for="email">birthdate</label>
    <input type="date" name="birthdate" class="form-control" id="birthdate" aria-describedby="birthdate"
      placeholder="birthdate" value="<?php echo $listUser['birthdate'] ?>">
      <label for="birthdate">
    

  </div>
  <button type="submit" class="btn btn-primary" name="submit" value="odeslat">Potvrdit</button>
</form>
 
<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "footer.php";
?>