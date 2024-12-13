<?php
require_once __DIR__ . '/../config/database.php';

class Employee {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($name, $phone) {
        $stmt = $this->db->prepare('INSERT INTO employees (name, phone) VALUES (:name, :phone)');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query('SELECT * FROM employees');
        $employees = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $employees[] = $row;
        }
        return $employees;
    }

    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM employees WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }
}
?>