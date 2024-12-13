<?php
require_once __DIR__ . '/../config/database.php';

class Product {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($category_id, $name, $description) {
        $stmt = $this->db->prepare('INSERT INTO products (category_id, name, description) VALUES (:category_id, :name, :description)');
        $stmt->bindValue(':category_id', $category_id, SQLITE3_INTEGER);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':description', $description, SQLITE3_TEXT);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query('
            SELECT p.*, c.name as category_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id
        ');
        $products = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $products[] = $row;
        }
        return $products;
    }

    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }
}
?>