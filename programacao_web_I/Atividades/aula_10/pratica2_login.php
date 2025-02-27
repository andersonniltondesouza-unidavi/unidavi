<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    $_SESSION['inicio_sessao'] = date('Y-m-d H:i:s');
    $_SESSION['ultima_requisicao'] = $_SESSION['inicio_sessao'];
    
    header("Location: pratica2_session.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="pratica2_login.php">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>