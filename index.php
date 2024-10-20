<?php
require_once 'Database.php';
require_once 'Authorization.php';
require_once 'UserRegistration.php';
global $conn;

// Подключение к базе данных
$database = new Database();
$db = $database->connect();

$pass = isset($_POST['login']) ?? $_POST['login'];
$login = isset($_POST['login']) ?? $_POST['login'];
$email = isset($_POST['email']) ?? $_POST['email'];

$userRegistration = new UserRegistration($db,$conn);
$authorization = new Authorization($conn,$db);






?>


<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
</head>
<body bgcolor="#E6E6FA">

<form action="UserRegistration.php" method="post">
    <input type="text" placeholder="login" name="login" required>
    <input type="password" placeholder="password" name="pass" required>
    <input type="password" placeholder="repeat password" name="repeatpass" required>
    <input type="text" placeholder="email" name="email" required>
    <button type="submit">Register</button>
</form>

<form action="Authorization.php" method="post">
    <input type="text" placeholder="login" name="login" required>
    <input type="password" placeholder="password" name="pass" required>
    <button type="submit">Authorization</button>
</form>



</body>
</html>
