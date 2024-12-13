<?php
require_once '../config/database.php';
require_once '../models/Product.php';
require_once '../models/Category.php';

$product = new Product();
$category = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $product->create($category_id, $name, $description);
}

$products = $product->getAll();
$categories = $category->getAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Cadastrar Novo Produto</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

        <h2 class="mt-4">Produtos Cadastrados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $prod): ?>
                <tr>
                    <td><?= $prod['id'] ?></td>
                    <td><?= htmlspecialchars($prod['category_name']) ?></td>
                    <td><?= htmlspecialchars($prod['name']) ?></td>
                    <td><?= htmlspecialchars($prod['description']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>