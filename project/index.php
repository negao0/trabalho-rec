<?php
require_once 'config/database.php';
require_once 'models/Category.php';
require_once 'models/Donor.php';
require_once 'models/Employee.php';
require_once 'models/Product.php';
require_once 'models/Donation.php';

$category = new Category();
$donor = new Donor();
$employee = new Employee();
$product = new Product();
$donation = new Donation();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Doações</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="views/categories.php">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/donors.php">Doadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/employees.php">Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/products.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/donations.php">Doações</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h1>Bem-vindo ao Sistema de Doações</h1>
                <p>Selecione uma opção no menu acima para começar.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>