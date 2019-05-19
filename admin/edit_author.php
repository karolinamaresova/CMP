<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "header.php";
?>
<br/>
<br/>
<br/>
<?php
$idAuthor = filter_input(INPUT_GET, "idAuthor");

$submit = filter_input(INPUT_POST, "submit");


    $sql = $mysqli->prepare("SELECT * FROM authors WHERE id_author = ?");
    $sql->bind_param("s", $idAuthor);
    $sql->execute();
    $author = $sql->get_result()->fetch_assoc();
    


    var_dump($submit);
    if ($submit == 'odeslat') {
        echo "formulář byl odeslán";
        $firstname = filter_input(INPUT_POST, "firstname");
        $surname = filter_input(INPUT_POST, "surname");
        
     var_dump($firstname, $surname, $idAuthor);   
    
    $sql1 = $mysqli->prepare("UPDATE authors SET firstname = ?, surname = ?d WHERE id_author = ?");
    
    $sql1->bind_param('sss', $firstname, $surname, $idAuthor) ;
    $sql1->execute();
        echo "provedeno";

    }

   
?>


<form action="edit_author.php?idAuthor=<?php echo $author['id_author']; ?>" method="post">

  <div class="form-group">
    <label for="firstname">Jméno</label>
    <input type="text" name="firstname" class="form-control" id="jmeno" aria-describedby="author-name" placeholder="Jméno" value="<?php echo $author['firstname'] ?>">
    <label for="surname">Přijmení</label>
    <input type="text" name="surname" class="form-control" id="prijmeni" aria-describedby="author-surname" placeholder="Přijmení" value="<?php echo $author['surname'] ?>">

  </div>




  


  <button type="submit" class="btn btn-primary" name="submit" value="odeslat">Potvrdit</button>
</form>

<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "footer.php";
?>