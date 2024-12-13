<?php
require_once '../config/database.php';
require_once '../models/Donation.php';
require_once '../models/Donor.php';
require_once '../models/Product.php';
require_once '../models/Employee.php';

$donation = new Donation();
$donor = new Donor();
$product = new Product();
$employee = new Employee();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor_id = $_POST['donor_id'];
    $product_id = $_POST['product_id'];
    $employee_id = $_POST['employee_id'];
    $quantity = $_POST['quantity'];
    $donation->create($donor_id, $product_id, $employee_id, $quantity);
}

$donations = $donation->getAll();
$donors = $donor->getAll();
$products = $product->getAll();
$employees = $employee->getAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Registrar Nova Doação</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="donor_id" class="form-label">Doador</label>
                <select class="form-control" id="donor_id" name="donor_id" required>
                    <?php foreach ($donors as $d): ?>
                        <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label">Produto</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="employee_id" class="form-label">Funcionário</label>
                <select class="form-control" id="employee_id" name="employee_id" required>
                    <?php foreach ($employees as $e): ?>
                        <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
            </div>
            <button type="submit" class="btn btn-primary">Registrar Doação</button>
        </form>

        <h2 class="mt-4">Doações Registradas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Doador</th>
                    <th>Produto</th>
                    <th>Funcionário</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donations as $d): ?>
                <tr>
                    <td><?= $d['id'] ?></td>
                    <td><?= htmlspecialchars($d['donor_name']) ?></td>
                    <td><?= htmlspecialchars($d['product_name']) ?></td>
                    <td><?= htmlspecialchars($d['employee_name']) ?></td>
                    <td><?= $d['quantity'] ?></td>
                    <td><?= $d['donation_date'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>