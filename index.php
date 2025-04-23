<?php
session_start();

// Se o usuário estiver logado, redireciona para o dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>FinFlow - Controle Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-4xl mx-auto text-center py-10">
        <h1 class="text-4xl font-bold text-indigo-600 mb-5">Bem-vindo ao FinFlow!</h1>
        <p class="text-lg text-gray-700 mb-8">O seu sistema de controle financeiro pessoal.</p>

        <div>
            <a href="login.php" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Entrar</a>
            <span class="mx-3 text-gray-500">ou</span>
            <a href="register.php" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">Cadastrar-se</a>
        </div>
    </div>

</body>
</html>
