<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'toko_onlines';
    protected $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("<p class='text-black font-bold text-lg'>Connection failed: " . $this->connection->connect_error."</p>");
        } else {
            echo "Database connected successfully ";
        }
    }
}
?>
