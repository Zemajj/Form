<?php
class UserRegistration
{
    public function __construct(
        private $db,
        private $conn
    ) {$this->conn= $db;}

    // Метод валидации данных
    public function validate($login, $pass, $email, $repeatPass)
    {
        if (empty($login) || empty($pass) || empty($email) || empty($repeatPass)) {
            throw new Exception("Заполните все поля");
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Неверный формат email");
        }
        if ($this->pass !== $this->repeatPass) {
            throw new Exception("Пароли не совпадают");
        }
    }

    // Метод хэширования пароля
    public function hashPassword()
    {
        return password_hash($this->pass, PASSWORD_DEFAULT);
    }

    // Метод для регистрации пользователя
    public function registerUser()
    {
        try {
            $this->validate();
            $hashPass = $this->hashPassword();

            $query = ("INSERT INTO `users` (login, pass, email) VALUES (:login, :pass, :email");
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':pass', $hashPass);
            $stmt->bindParam(':email', $this->email);

            if ($stmt->execute()) {
                echo "Регистрация прошла успешно";
            } else {
                throw new Exception("Ошибка регистрации");
            }

            $stmt = null; // Освобождаем память
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
