<?php

class UserRegistration
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Метод хэширования пароля
    private function hashPassword(string $pass): string
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    // Метод для регистрации пользователя
    public function registerUser(string $login, string $pass, string $email)
    {
        $hashedPassword = $this->hashPassword($pass);

        // Исправленный SQL-запрос с закрывающей скобкой
        $query = "INSERT INTO  `test` (login, pass, email) VALUES (:login, :pass, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':pass', $hashedPassword);
        $stmt->bindParam(':email', $email);

        // Выполнение запроса и проверка

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }


    }
}
