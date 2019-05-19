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
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <script src="main.js"></script>
</head>

<body>
    <?php


$idBook = filter_input(INPUT_GET, "idBook");

$sql = $mysqli->prepare("SELECT id_book, name, ISBN, pages FROM `books` WHERE id_book = ?");
$sql->bind_param("s", $idBook);
$sql->execute();
$book = $sql->get_result()->fetch_assoc();



?>
    <table class="book-info">

        <thead>
            <th>Id knihy </th>
            <th>Název knihy </th>
            <th>ISBN</th>
            <th>Počet stran</th>
        </thead>
        <tbody>
            <td><?= $book["id_book"]?></td>
            <td><?= $book["name"]?></td>            
            <td><?= $book["ISBN"] ?></td>
            <td><?= $book["pages"] ?></td>

        </tbody>
    </table>



    
    
    
    
</body>

</html>