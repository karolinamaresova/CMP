<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "header.php";

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

session_start();

$submit = filter_input(INPUT_POST, 'registrationSubmit');

  

if (!empty($submit)) {
    echo "Formulář byl odeslán";
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST, 'password');
    $role = filter_input(INPUT_POST,'role');
    



    define ('SALT', 'jbakbdaisbdoisaiabdsě+abo!');
    $hashedPassword = md5($password . SALT);


    $sqlI = $mysqli->prepare("
    INSERT INTO users (name, email, password)
    VALUES (?,?,?);
    ");

    $sqlI->bind_param('sss', $name, $email, $hashedPassword);
    $sqlI->execute();
}
?>

<form method="post" action="registration.php">
      <input type="text" id="email" class="fadeIn second " name="email" placeholder="email">
      <input type="text" id="name" class="fadeIn third" name="name" placeholder="name">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      
      <input type="submit" class="fadeIn fourth" name="registrationSubmit" value="Reg">
    </form>





</body>
</html>

