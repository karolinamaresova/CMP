<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "header.php";

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .   "inc"  . DIRECTORY_SEPARATOR . "database.php";


session_start();


$sqlUser = $mysqli->prepare(
    "SELECT * 
     FROM users u 
     JOIN users_roles ur ON u.id_user = ur.id_user   
     JOIN roles r ON ur.id_role = r.id_role
     WHERE email LIKE ? 
     "
);
    
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
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>role</th>
                    <th>jméno</th>
                    <th>email</th>
                    <th>datum narození</th>
                    <th>poslední přihlášení</th>
                    <th>id role</th>


                </tr>
            </thead>
            <tbody>

                <?php
if ($user['id_role'] == 1) {
    $sqlAllUsers = $mysqli->prepare('SELECT * 
    FROM users u 
    JOIN users_roles ur ON u.id_user = ur.id_user   
    JOIN roles r ON ur.id_role = r.id_role
     ;');
    $sqlAllUsers->execute();
    $resultAllUsers = $sqlAllUsers->get_result();
    
    while ($listUser = $resultAllUsers->fetch_assoc()) {
        ?>


                <?php
    // echo $listUser['email'];
    ?>
                <tr>
                    <td>
                        <?php
             echo $listUser['role_name']; ?>
                    </td>
                    <td>
                        <?php
             echo $listUser['name'] ; ?>
                    </td>
                    <td>
                        <?php
             echo $listUser['email'] ; ?>
                    </td>
                    <td>
                        <?php
             echo $listUser['birthdate'] ; ?>
                    </td>
                    <td>
                        <?php
             echo $listUser['last_login'] ; ?>
                    </td>
                    <td>
                        <?php
             echo $listUser['id_role'] ; ?>
                    </td>


                    <td>
                        <a href="edit_user.php?idUser=<?php echo $listUser['id_user']; ?>"
                            class="btn btn-primary">Upravit uživatele</a>
                    </td>






                </tr>



                <?php
    }
    var_dump($listUser);
} else {
    ?>
                Nedostatečná práva k zobrazení seznamu uživatelů. <?php
}

?>




</body>

</html>