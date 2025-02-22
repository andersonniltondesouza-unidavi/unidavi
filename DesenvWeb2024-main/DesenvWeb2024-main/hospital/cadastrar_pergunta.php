<?php
include 'db_connection.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descricao_pergunta'])) {
    // Obtém os dados do formulário
    $pergunta = $_POST['descricao_pergunta'];

    // Verifica se a descrição da pergunta não está vazia
    if (!empty($pergunta)) {
        // Insere a nova pergunta no banco de dados
        $query = "INSERT INTO PERGUNTAS (PERGUNTA, STATUS) VALUES (:pergunta, 'ATIVA')";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pergunta', $pergunta);

        if ($stmt->execute()) {
            echo "<script>alert('Pergunta cadastrada com sucesso!');</script>";
        } else {
            echo "<p>Erro ao cadastrar a pergunta. Tente novamente.</p>";
        }
    } else {
        echo "<p>Por favor, preencha a descrição da pergunta.</p>";
    }
}

// Verifica se o formulário foi enviado para desativação/ativação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['desativar_id']) || isset($_POST['ativar_id']))) {
    // Obtém o ID da pergunta a ser desativada ou ativada
    $id = isset($_POST['desativar_id']) ? $_POST['desativar_id'] : $_POST['ativar_id'];
    $novo_status = isset($_POST['desativar_id']) ? 'INATIVA' : 'ATIVA';

    // Atualiza o status da pergunta para 'INATIVA' ou 'ATIVA'
    $query = "UPDATE PERGUNTAS SET STATUS = :novo_status WHERE ID = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':novo_status', $novo_status);

    if ($stmt->execute()) {
        echo 'success';
        exit;
    } else {
        echo 'error';
        exit;
    }
}

// Consulta para obter as perguntas já cadastradas
$query = "SELECT ID, PERGUNTA, STATUS FROM PERGUNTAS";
$stmt = $conn->prepare($query);
$stmt->execute();
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pergunta</title>
    <link rel="stylesheet" href="css/cadastrar_pergunta.css">
    <script src="js/cadastrar_pergunta.js"></script>
</head>
<body>
    <button class="voltar-button" onclick="location.href='admin_dashboard.html'"><i class="arrow-left">&#8592;</i></button>
    <div class="container">
        <h1>Cadastrar Nova Pergunta</h1>
        <form action="cadastrar_pergunta.php" method="POST">
            <label for="descricao_pergunta">Descrição da Pergunta:</label>
            <textarea id="descricao_pergunta" name="descricao_pergunta" rows="4" required></textarea>
            <br><br>
            <button type="submit" class="botao-verde">Nova Pergunta</button>
        </form>
        
        <h2>Perguntas Já Cadastradas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pergunta</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perguntas as $pergunta): ?>
                    <tr>
                        <td><?= htmlspecialchars($pergunta['id']) ?></td>
                        <td><?= htmlspecialchars($pergunta['pergunta']) ?></td>
                        <td><?= htmlspecialchars($pergunta['status']) ?></td>
                        <td>
                            <button onclick="location.href='editar_pergunta.php?id=<?= $pergunta['id'] ?>'">Editar</button>
                            <?php if ($pergunta['status'] === 'ATIVA'): ?>
                                <button class="botao-desativar" onclick="desativarPergunta(<?= $pergunta['id'] ?>)">Desativar</button>
                            <?php else: ?>
                                <button class="botao-ativar" onclick="ativarPergunta(<?= $pergunta['id'] ?>)">Ativar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
