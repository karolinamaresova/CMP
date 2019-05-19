<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "database.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
   
</head>

<body>

<?php
$sql = $mysqli->prepare("SELECT id_book, name, ISBN FROM `books`");
$sql->execute();
$result = $sql->get_result();
while ($book = $result->fetch_assoc()) { ?> 
    <a href="bookdetail.php?idBook=<?php echo $book['id_book'];?>">
    <?php echo $book['name']; 
    echo "<br>";
    ?> </a> <?php
}



?>


</body>

</html>