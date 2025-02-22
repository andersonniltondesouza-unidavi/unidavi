<?php
include 'db_connection.php';

// Verifica se o ID da pergunta foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obter a pergunta
    $query = "SELECT ID, PERGUNTA FROM PERGUNTAS WHERE ID = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pergunta) {
        echo "<script>alert('Pergunta não encontrada.'); window.location.href='cadastrar_pergunta.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID da pergunta não fornecido.'); window.location.href='cadastrar_pergunta.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descricao_pergunta'])) {
    $descricao = $_POST['descricao_pergunta'];

    if (!empty($descricao)) {
        // Atualiza a pergunta no banco de dados
        $query = "UPDATE PERGUNTAS SET PERGUNTA = :pergunta WHERE ID = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pergunta', $descricao);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "<script>alert('Pergunta alterada com sucesso!'); window.location.href='cadastrar_pergunta.php';</script>";
            exit;
        } else {
            echo "<p>Erro ao atualizar a pergunta. Tente novamente.</p>";
        }
    } else {
        echo "<p>Por favor, preencha a descrição da pergunta.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pergunta</title>
    <link rel="stylesheet" href="css/editar_pergunta.css">
    <script src="js/editar_pergunta.js"></script>
</head>
<body>
    <button class="voltar-button" onclick="location.href='cadastrar_pergunta.php'">
        <i class="arrow-left">&#8592;</i>
    </button>
    <div class="container">
        <h1>Editar Pergunta</h1>
        <form action="editar_pergunta.php?id=<?= htmlspecialchars($id) ?>" method="POST">
            <label for="descricao_pergunta">Descrição da Pergunta:</label>
            <textarea id="descricao_pergunta" name="descricao_pergunta" rows="4" required><?= htmlspecialchars($pergunta['pergunta']) ?></textarea>
            <br><br>
            <button type="submit" class="botao-salvar">Salvar Alteração</button>
        </form>
    </div>
</body>
</html>
