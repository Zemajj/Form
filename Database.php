<?php
class Database {


    public function __construct
    (
        private string $host = '',
        private string $username = '',
        private string $db_name = '',
        private string $password = '',
    ) {}


    // Метод для подключения к БД
    public function connect()
    {
        try
        {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception)
        {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $conn;
    }
}
