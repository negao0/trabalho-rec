<?php
require_once __DIR__ . '/../config/database.php';

class Donation {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($donor_id, $product_id, $employee_id, $quantity) {
        $stmt = $this->db->prepare('
            INSERT INTO donations (donor_id, product_id, employee_id, quantity, donation_date) 
            VALUES (:donor_id, :product_id, :employee_id, :quantity, date("now"))
        ');
        $stmt->bindValue(':donor_id', $donor_id, SQLITE3_INTEGER);
        $stmt->bindValue(':product_id', $product_id, SQLITE3_INTEGER);
        $stmt->bindValue(':employee_id', $employee_id, SQLITE3_INTEGER);
        $stmt->bindValue(':quantity', $quantity, SQLITE3_INTEGER);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query('
            SELECT 
                d.id,
                dn.name as donor_name,
                p.name as product_name,
                e.name as employee_name,
                d.quantity,
                d.donation_date
            FROM donations d
            JOIN donors dn ON d.donor_id = dn.id
            JOIN products p ON d.product_id = p.id
            JOIN employees e ON d.employee_id = e.id
        ');
        
        $donations = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $donations[] = $row;
        }
        return $donations;
    }
}
?>