<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// Obter todas as categorias para o usuário logado
$stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
$stmt->execute([$user['id']]);
$categories = $stmt->fetchAll();

// Adicionar nova categoria
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_name'])) {
    $category_name = $_POST['category_name'];

    $stmt = $pdo->prepare("INSERT INTO categories (user_id, name) VALUES (?, ?)");
    $stmt->execute([$user['id'], $category_name]);

    header("Location: categories.php");
    exit;
}

// Excluir categoria
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ? AND user_id = ?");
    $stmt->execute([$category_id, $user['id']]);

    header("Location: categories.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias - FinFlow</title>
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

    <!-- Gerenciar Categorias -->
    <div class="container mx-auto py-10 px-6">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Gerenciar Categorias</h1>

            <!-- Formulário para adicionar nova categoria -->
            <form action="categories.php" method="POST" class="mb-6">
                <div class="flex items-center space-x-4">
                    <input type="text" name="category_name" placeholder="Nome da Categoria" class="w-full p-2 border border-gray-300 rounded-md" required>
                    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Adicionar Categoria</button>
                </div>
            </form>

            <!-- Tabela de Categorias -->
            <table class="w-full table-auto text-left">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-gray-700">Categoria</th>
                        <th class="px-4 py-2 text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= htmlspecialchars($category['name']) ?></td>
                            <td class="px-4 py-2">
                                <a href="edit_category.php?id=<?= $category['id'] ?>" class="text-blue-500 hover:underline">Editar</a> |
                                <a href="categories.php?delete=<?= $category['id'] ?>" class="text-red-500 hover:underline">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Botão para voltar ao Dashboard -->
            <div class="mt-6 text-center">
                <a href="dashboard.php" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Voltar ao Dashboard</a>
            </div>

        </div>
    </div>

</body>
</html>
