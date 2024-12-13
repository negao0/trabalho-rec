<?php
require_once '../config/database.php';
require_once '../models/Category.php';

$category = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $observation = $_POST['observation'];
    $category->create($name, $description, $observation);
}

$categories = $category->getAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Cadastrar Nova Categoria</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="observation" class="form-label">Observação</label>
                <textarea class="form-control" id="observation" name="observation"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

        <h2 class="mt-4">Categorias Cadastradas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= htmlspecialchars($cat['name']) ?></td>
                    <td><?= htmlspecialchars($cat['description']) ?></td>
                    <td><?= htmlspecialchars($cat['observation']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>