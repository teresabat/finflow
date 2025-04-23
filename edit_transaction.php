<?php
include_once 'includes/db.php'; // Incluir o arquivo de configuração do banco de dados

// Verificar se o ID da transação foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar os dados da transação com o ID fornecido
    $sql = "SELECT * FROM transactions WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $transaction = $stmt->fetch();

    // Verificar se a transação foi encontrada
    if (!$transaction) {
        echo "Transação não encontrada.";
        exit;
    }
}

// Atualizar a transação no banco de dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $date = $_POST['date'];

    // Atualizar a transação no banco de dados
    $update_sql = "UPDATE transactions SET amount = ?, description = ?, category_id = ?, date = ? WHERE id = ?";
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->execute([$amount, $description, $category_id, $date, $id]);

    // Redirecionar para a página principal ou dashboard após a atualização
    header('Location: dashboard.php');
    exit;
}

// Obter todas as categorias para o select
$categories_sql = "SELECT * FROM categories WHERE user_id = 1";
$categories_stmt = $pdo->prepare($categories_sql);
$categories_stmt->execute();
$categories = $categories_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Transação</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-xl font-semibold">FinFlow</a>
            <div>
                <a href="dashboard.php" class="mr-4">Dashboard</a>
                <a href="new_transaction.php" class="mr-4">Adicionar Transação</a>
                <a href="categories.php" class="mr-4">Gerenciar Categorias</a>
                <a href="logout.php" class="bg-red-600 py-2 px-4 rounded">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Formulário de edição de transação -->
    <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold mb-6 text-center">Editar Transação</h1>

        <form action="edit_transaction.php?id=<?= $transaction['id'] ?>" method="POST">
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                <input type="number" name="amount" id="amount" value="<?= $transaction['amount'] ?>" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <input type="text" name="description" id="description" value="<?= $transaction['description'] ?>" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                <select name="category_id" id="category_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $transaction['category_id'] == $category['id'] ? 'selected' : '' ?>>
                            <?= $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date" name="date" id="date" value="<?= $transaction['date'] ?>" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Salvar Alterações</button>
            </div>
        </form>
    </div>

</body>
</html>
