<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "database.php";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<?php


$idAuthor = filter_input(INPUT_GET, "idAuthor");

$sql = $mysqli->prepare("SELECT id_author, firstname, surname FROM `authors` WHERE id_author = ?");
$sql->bind_param("s", $idAuthor);
$sql->execute();
//$author = $sql->get_result()->fetch_assoc();
$result = $sql->get_result();
$author = $result->fetch_assoc();


?>
<h1>Autor: <?= $author["firstname"] . " " . $author["surname"]; ?> </h1>

<h2>Napsal tyto knihy: </h2>

<?php
$sql2 = $mysqli->prepare("SELECT *
FROM books_authors ba
JOIN books b ON b.id_book = ba.id_book
WHERE ba.id_author = $idAuthor;");
$sql->bind_param("s", $idAuthor);
$sql2->execute();
$result2 = $sql2->get_result();
while ($book = $result2->fetch_assoc()) { ?> 
    <a href="bookdetail.php?idBook=<?php echo $book['id_book'];?>">
    <?php echo $book['name']; ?> 
    <br> </a> <?php
}


?>

</body>
</html>