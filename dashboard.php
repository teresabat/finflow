<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// Obtenção das transações com o nome da categoria
$stmt = $pdo->prepare("
    SELECT transactions.id, transactions.amount, transactions.created_at, categories.name AS category_name
    FROM transactions
    JOIN categories ON transactions.category_id = categories.id
    WHERE transactions.user_id = ?
");
$stmt->execute([$user['id']]);
$transactions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FinFlow</title>
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

    <!-- Conteúdo do Dashboard -->
    <div class="container mx-auto py-10 px-6">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-800">Olá, <?= htmlspecialchars($user['name']) ?>!</h1>
            <div class="flex space-x-4">
                <a href="new_transaction.php" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Nova Transação</a>
                <a href="categories.php" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">Gerenciar Categorias</a>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Transações Recentes</h2>
        
        <?php if (count($transactions) > 0): ?>
            <table class="min-w-full table-auto bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="text-left bg-indigo-100">
                        <th class="py-2 px-4">Categoria</th>
                        <th class="py-2 px-4">Valor</th>
                        <th class="py-2 px-4">Data</th>
                        <th class="py-2 px-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr class="border-t">
                            <!-- Exibindo o nome da categoria -->
                            <td class="py-2 px-4"><?= htmlspecialchars($transaction['category_name']) ?></td>
                            <td class="py-2 px-4"><?= number_format($transaction['amount'], 2, ',', '.') ?></td>
                            <td class="py-2 px-4"><?= date('d/m/Y', strtotime($transaction['created_at'])) ?></td>
                            <td class="py-2 px-4">
                                <a href="edit_transaction.php?id=<?= $transaction['id'] ?>" class="text-blue-600 hover:underline">Editar</a> |
                                <a href="delete_transaction.php?id=<?= $transaction['id'] ?>" class="text-red-600 hover:underline">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-600">Você ainda não tem transações registradas.</p>
        <?php endif; ?>
    </div>

</body>
</html>
