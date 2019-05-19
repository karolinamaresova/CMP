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
$sql = $mysqli->prepare("SELECT id_author, firstname, surname  FROM `authors`");
$sql->execute();
$result = $sql->get_result();
while ($author = $result->fetch_assoc()) { ?> 
    <a href="authordetail.php?idAuthor=<?php echo $author['id_author'];?>">
    <?php echo $author['firstname'] . ' ' .  $author['surname']; 
    echo "<br>";
    ?> </a> <?php
}



?>


</body>

</html>