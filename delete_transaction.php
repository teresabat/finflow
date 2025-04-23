<?php
require 'includes/auth.php';
require 'includes/db.php';

$id = intval($_GET['id'] ?? 0);

// Verifica se a transação pertence ao usuário
$stmt = $pdo->prepare("DELETE FROM transactions WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user']['id']]);

header("Location: dashboard.php");
exit;
