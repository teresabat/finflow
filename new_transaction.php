<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// Obter categorias para o formulário
$stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
$stmt->execute([$user['id']]);
$categories = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, category_id, amount, description, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$user['id'], $category_id, $amount, $description]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Transação - FinFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Barra de navegação -->
    <nav class="bg-indigo-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-white text-lg font-bold">FinFlow</a>
            <div class="flex items-center space-x-4">
                <span class="text-white"><?= htmlspecialchars($user['name']) ?></span>
                <a href="logout.php" class="text-white hover:underline">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Formulário de Nova Transação -->
    <div class="container mx-auto py-10 px-6">
        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Adicionar Nova Transação</h1>

            <form action="new_transaction.php" method="POST">
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-medium">Categoria</label>
                    <select name="category_id" id="category_id" class="w-full mt-2 p-2 border border-gray-300 rounded-md">
                        <option value="">Selecione uma categoria</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 font-medium">Valor</label>
                    <input type="number" name="amount" id="amount" class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium">Descrição</label>
                    <textarea name="description" id="description" rows="4" class="w-full mt-2 p-2 border border-gray-300 rounded-md"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Adicionar Transação</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
