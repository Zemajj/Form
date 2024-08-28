<?php
require_once('db.php');
global $conn;

$login = $_POST['login'] ?? ''; // получение данных
$pass = $_POST['pass'] ?? '';  // получение данных

if (empty($login) || empty($pass)) {
    echo "Заполните поля";   // проверка на заполненость полей
    exit;
}

// Подготовленный запрос
$stmt = $conn->prepare("SELECT * FROM `users` WHERE login = ?"); // Подготовленный запрос к базе данных
$stmt->bind_param("s", $login);  // Метод  bind_param  связывает переменную  $login  с плейсхолдером.
//  "s"  указывает, что это строка.
// Знак вопроса ( ? ) служит плейсхолдером для значения, которое мы передаем позже.
$stmt->execute();
$result = $stmt->get_result(); // Выполнение запроса

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Проверяем кол-во строк, если > 0, значит пользователь найден
    // Тогда получаем данные в виде ассоциативного массива с помощью fetch_assoc() .

    // Проверка пароля
    if (password_verify($pass, $row['pass'])) { // проверка пароля на совпадение с хэшированным
        echo "Добро пожаловать! " . htmlspecialchars($row['login']); // Ипользую htmlspecialchars, чтобы избежать XSS атаку
    } else {
        echo "Неверный пароль";
    }
} else {
    echo "Такого пользователя нет";
}

$stmt->close(); // Закрываем запрос и соединение
$conn->close();

