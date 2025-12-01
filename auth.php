<?php
session_start();
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?status=invalid');
    exit;
}

$email = filter_var(trim($_POST['student_email'] ?? ''), FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$fullName = trim($_POST['full_name'] ?? '');

if (!$email || !$password) {
    header('Location: index.php?status=missing');
    exit;
}

$stmt = $pdo->prepare('SELECT id, password_hash, full_name FROM users WHERE student_email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    if (!password_verify($password, $user['password_hash'])) {
        header('Location: index.php?status=invalid');
        exit;
    }
    $_SESSION['user_id'] = (int)$user['id'];
    $_SESSION['user_name'] = $user['full_name'];
    header('Location: index.php?status=welcome');
    exit;
}

if (empty($fullName)) {
    header('Location: index.php?status=needname');
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$insert = $pdo->prepare('INSERT INTO users (student_email, password_hash, full_name) VALUES (?, ?, ?)');
$insert->execute([$email, $hash, $fullName]);

$_SESSION['user_id'] = (int)$pdo->lastInsertId();
$_SESSION['user_name'] = $fullName;
header('Location: index.php?status=registered');
exit;

