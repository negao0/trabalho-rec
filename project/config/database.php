<?php
class Database {
    private $db;

    public function __construct() {
        try {
            $this->db = new SQLite3('database/donations.db');
            $this->createTables();
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    private function createTables() {
        // Categories Table
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS categories (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                description TEXT,
                observation TEXT
            )
        ');

        // Donors Table
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS donors (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL,
                cpf TEXT NOT NULL UNIQUE
            )
        ');

        // Employees Table
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS employees (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                phone TEXT NOT NULL
            )
        ');

        // Products Table
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS products (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                category_id INTEGER,
                name TEXT NOT NULL,
                description TEXT,
                FOREIGN KEY (category_id) REFERENCES categories(id)
            )
        ');

        // Donations Table
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS donations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                donor_id INTEGER,
                product_id INTEGER,
                employee_id INTEGER,
                quantity INTEGER NOT NULL,
                donation_date DATE NOT NULL,
                FOREIGN KEY (donor_id) REFERENCES donors(id),
                FOREIGN KEY (product_id) REFERENCES products(id),
                FOREIGN KEY (employee_id) REFERENCES employees(id)
            )
        ');
    }

    public function getConnection() {
        return $this->db;
    }
}
?>