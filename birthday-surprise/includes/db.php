<?php
require_once 'config.php';

class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getActiveQuestions() {
        $stmt = $this->conn->prepare("SELECT * FROM questions WHERE is_active = TRUE LIMIT 3");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function saveMessage($name, $message) {
        $stmt = $this->conn->prepare("INSERT INTO messages (sender_name, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $message);
        return $stmt->execute();
    }

    public function getMessages() {
        $result = $this->conn->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 10");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>