<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "header.php";
?>

<?php
$idBook = filter_input(INPUT_GET, "idBook");
var_dump($idBook);

//zpracování formuláře 

$submit = filter_input(INPUT_POST, "submit");


var_dump($submit);
if($submit == 'odeslat'){
echo "formulář byl odeslán";
 $name = filter_input(INPUT_POST, "name"); 
 $isbn = filter_input(INPUT_POST, "ISBN"); 
 $pages = filter_input(INPUT_POST, "pages"); 
 $year = filter_input(INPUT_POST, "year"); 

$sqlU = $mysqli->prepare("
UPDATE books
SET name = ?,
    ISBN = ?,
    pages = ?,
    year = ?
WHERE id_book = ?;
");

$sqlU->bind_param('ssssd', $name, $isbn, $pages, $year, $idBook);
$sqlU->execute();
echo "provedeno";

 $idAuthor = filter_input(INPUT_POST, 'id_author'); 

}



$sql = $mysqli->prepare("SELECT b.id_book, name, ISBN, pages, year, a.id_author, a.firstname, a.surname
FROM `books` b
JOIN books_authors ba ON b.id_book = ba.id_book
JOIN authors a ON ba.id_author = a.id_author
WHERE b.id_book = ?");
$sql->bind_param("s", $idBook);
$sql->execute();
$book = $sql->get_result()->fetch_assoc();
 


$sql2 = $mysqli->prepare("SELECT * FROM authors;");
$sql2->execute();
$authors = $sql2->get_result();


?>


<form action="edit_book.php?idBook=<?php echo $book['id_book']; ?>" method="post">

  <div class="form-group">
    <label for="name">Název knihy</label>
    <input type="text" name="name" class="form-control" id="name" aria-describedby="book-title" placeholder="Název knihy" value="<?php echo $book['name'] ?>">
    <label for="ISBN">ISBN</label>
    <input type="text" name="ISBN" class="form-control" id="ISBN" aria-describedby="book-ean" placeholder="ISBN" value="<?php echo $book['ISBN'] ?>">
    <label for="pages">Počet stran</label>
    <input type="number" name="pages" class="form-control" id="pages" aria-describedby="book-pages" placeholder="pages" value="<?php echo $book['pages'] ?>">
    <label for="year">Rok vydání</label>
    <input type="number" name="year" class="form-control" id="year" aria-describedby="book-year" placeholder="year" value="<?php echo $book['year'] ?>">
  </div>




  <select name="id_author" class="custom-select">
  <?php
  while ($author = $authors->fetch_assoc()){
    ?>
<option <?php if($book['id_author'] == $author['id_author'] ) { ?>selected<?php }  ?>
value="<?php echo $author['id_author'];?>"><?php echo $author['firstname'] . " " . $author['surname']?></option>
 <?php 
 }?>
  
  </select>


  <button type="submit" class="btn btn-primary" name="submit" value="odeslat">Potvrdit</button>
</form>

<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "footer.php";
?>