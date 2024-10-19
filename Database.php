<?php
class Database {


    public function __construct(
        private string $host = 'MySQL-8.2',
        private string $username = 'root',
        private string $db_name = 'registerUser',
        private int|string $password = ''

    ) {}


    // Метод для подключения к БД
    public function connect() {
            $conn = null;

        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $conn;
    }
}
