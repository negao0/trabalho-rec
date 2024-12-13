<?php
require_once '../config/database.php';
require_once '../models/Donor.php';

$donor = new Donor();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $donor->create($name, $email, $cpf);
}

$donors = $donor->getAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Doadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Cadastrar Novo Doador</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

        <h2 class="mt-4">Doadores Cadastrados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donors as $d): ?>
                <tr>
                    <td><?= $d['id'] ?></td>
                    <td><?= htmlspecialchars($d['name']) ?></td>
                    <td><?= htmlspecialchars($d['email']) ?></td>
                    <td><?= htmlspecialchars($d['cpf']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>