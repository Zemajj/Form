<?php
global $conn;
require('db.php');


$login = $_POST['login'] ?? ''; // Оператор (нулевое слияние)
$pass = $_POST['pass'] ?? ''; // Если какая-то строка не заполнена, то она получит
$repeatpass = $_POST['repeatpass'] ?? ''; // пустую строку
$email = $_POST['email'] ?? '';

// Валидация данных
if (empty($login) || empty($pass) || empty($repeatpass) || empty($email)) {
    echo "Заполните все поля";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Проверка корректности ввода почты
    echo "Неверный формат email";
    exit;
}

if ($pass !== $repeatpass) {
    echo "Пароли не подходят";
    exit;
}

// Хеширование пароля
$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

// Подготовленный запрос
$stmt = $conn->prepare("INSERT INTO `users` (login, pass, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $login, $hashedPass, $email);
// Все три значения строки. Подготовленный запрос


// Выполнение запроса
if ($stmt->execute()) {
    echo "Успешная регистрация";
} else {
    echo "Ошибка: " . htmlspecialchars($stmt->error);
}

$stmt->close(); // Закрываем запрос
$conn->close(); // и соединение








