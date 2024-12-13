<?php
require_once __DIR__ . '/../config/database.php';

class Category {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($name, $description, $observation) {
        $stmt = $this->db->prepare('INSERT INTO categories (name, description, observation) VALUES (:name, :description, :observation)');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':description', $description, SQLITE3_TEXT);
        $stmt->bindValue(':observation', $observation, SQLITE3_TEXT);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query('SELECT * FROM categories');
        $categories = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }
}
?>