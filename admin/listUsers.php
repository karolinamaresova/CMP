<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .   "inc"  . DIRECTORY_SEPARATOR . "database.php";


session_start();


$sqlUser = $mysqli->prepare(
    "SELECT * 
     FROM users u 
     JOIN users_roles ur ON u.id_user = ur.id_user   
     WHERE email LIKE ? 
     ");
    
$sqlUser->bind_param('s', $_SESSION['login']);
$sqlUser->execute();

$user = $sqlUser->get_result()->fetch_assoc();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 
if($user['id_role'] == 1) {
    $sqlAllUsers = $mysqli->prepare('SELECT * FROM users;');
    $sqlAllUsers->execute();
    $resultAllUsers = $sqlAllUsers->get_result();
    
    while($listUser = $resultAllUsers->fetch_assoc()) {
        ?>

        <p><?php echo $listUser['email']; ?> </p> <?php
    }
    

} 
else {
    ?>
    Nedostatečná práva k zobrazení seznamu uživatelů. <?php
} 

?>




</body>
</html>