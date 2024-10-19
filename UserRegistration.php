<?php

require 'Database.php';
class UserRegistration
{
    public function __construct
    (
        private $conn,
        private string $login,
        private int|string $pass,
        private string $email,
        private int|string $repeatPass
    )
    {}

    // Метод валидации данных
    public function validate()
    {
        if(empty($this->login) || empty($this->pass) || empty($this->email) || empty($this->repeatPass))
        {
            throw new Exception("Заполните все поля");
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            throw new Exception("Неверный формат email");

        }
        if($this->pass !== $this->repeatPass)
        {
            throw new Exception("Пароли не совпадают");
        }
    }

    //Метод хэширование пароля
    public function hashPass() : string
    {
        return password_hash($this->pass,PASSWORD_DEFAULT);
    }

    //Метод для регистрации пользователя
    public function registerUser($login, $pass, $email)
    {
        try {
            $this->validate();
            $hashPass = $this->hashPass();

            $query = ("INSERT INTO `users` (login, pass, email) VALUES (:login, :pass, :email");
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute())
            {
                echo "Регистрация прошла успешно";
            } else
            {
                throw new Exception("Ошибка");
            }

            $stmt->close();
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }

    }
}