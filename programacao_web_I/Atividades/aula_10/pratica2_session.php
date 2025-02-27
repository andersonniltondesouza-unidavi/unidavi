<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: pratica2_login.php");
    exit;
}

$data_inicio = new DateTime($_SESSION['inicio_sessao']);
$data_atual = new DateTime();
$intervalo = $data_inicio->diff($data_atual);

$_SESSION['ultima_requisicao'] = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dados da Sessão</title>
</head>
<body>
    <h2>Informações da Sessão</h2>
    <p><strong>Login:</strong> <?php echo $_SESSION['login']; ?></p>
    <p><strong>Senha:</strong> <?php echo $_SESSION['senha']; ?></p>
    <p><strong>Data/Hora Início da Sessão:</strong> <?php echo $_SESSION['inicio_sessao']; ?></p>
    <p><strong>Data/Hora Última Requisição:</strong> <?php echo $_SESSION['ultima_requisicao']; ?></p>
    <p><strong>Tempo de Sessão:</strong> <?php echo $intervalo->format('%H:%I:%S'); ?></p>
    <br>
</body>
</html>