<?php
class Authorization {
    public function __construct
    (
        private $conn,
        $db
    )
    {$this->conn = $db;}

    public function Login($login, $pass) {
        if (empty($login) || empty($pass)) {
            return "Заполните поля"; // проверка на заполненность полей
        }

        // Подготовленный запрос
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE login = :login");
        $stmt->bind_param(':login', $login);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Проверка пароля
            if (password_verify($pass, $row['pass'])) {
                return "Добро пожаловать! " . htmlspecialchars($row['login']);
            } else {
                return "Неверный пароль";
            }
        } else {
            return "Такого пользователя нет";
        }
    }
}


