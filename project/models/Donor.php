<?php
require_once __DIR__ . '/../config/database.php';

class Donor {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($name, $email, $cpf) {
        $stmt = $this->db->prepare('INSERT INTO donors (name, email, cpf) VALUES (:name, :email, :cpf)');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':cpf', $cpf, SQLITE3_TEXT);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query('SELECT * FROM donors');
        $donors = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $donors[] = $row;
        }
        return $donors;
    }

    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM donors WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }
}
?>