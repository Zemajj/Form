<?php
require 'Database.php';
require 'UserRegistration.php';
require 'Authorization.php';

// Подключение к базе данных
$database = new Database();
$db = $database->connect();

// Проверка валидации и формы на заполняемость
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ? $_POST['login'] : 0;
    $pass = $_POST['password'] ? $_POST['password'] : 0;
    $repeatPass = $_POST['repeatPass'] ? $_POST['repeatPass'] : 0;
    $email = $_POST['email'] ? $_POST['email'] : 0;


    // Проверка на пустые поля
    if (empty($login) || empty($pass) || empty($repeatPass) || empty($email))
    {
        echo "Все поля должны быть заполнены!";
        exit; // Завершаем выполнение скрипта
    }

    // Проверка на совпадение паролей
    if ($pass !== $repeatPass)
    {
        echo "Пароли не совпадают!";
        exit; // Завершаем выполнение скрипта
    }

    // Выполняем регистрацию
    $registration = new UserRegistration($db);
    $registration->registerUser($login, $pass, $email);
} else {
    // Пока форма не отправлена
    echo "Форма не была отправлена!";
}


?>
<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Registration and authorization</title>
</head>
<body bgcolor="#E6E6FA">

<form  method="post">
    <input type="text" placeholder="login" name="login" required>
    <input type="password" placeholder="password" name="password" required>
    <input type="password" placeholder="repeat password" name="repeatPass" required>
    <input type="text" placeholder="email" name="email" required>
    <button type="submit">Register</button>
</form>

<form  method="post">
    <input type="text" placeholder="login" name="login" required>
    <input type="password" placeholder="password" name="pass" required>
    <button type="submit">Authorization</button>
</form>
</body>
</html>
