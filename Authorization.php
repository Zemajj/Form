<?php

class Authorization
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Метод для авторизации пользователя
    public function login(string $login, string $pass): bool
    {
        // Исправлен SQL-запрос
        $query =  "SELECT pass FROM `test` WHERE login = :login";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        // Получаем результат запроса
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверка на существование пользователя и правильность пароля
        if ($user && password_verify($pass, $user['pass']))
        {
            // Логика успешной авторизации
            echo "Успешная авторизация.";
            return true;
        } else {
            // Логика неуспешной авторизации
            echo "Неверный логин или пароль.";
            return false;
        }
    }
}
