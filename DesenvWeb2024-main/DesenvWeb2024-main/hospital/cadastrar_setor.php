<?php
include 'db_connection.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_setor'])) {
    // Obtém os dados do formulário
    $nome_setor = $_POST['nome_setor'];

    // Verifica se o nome do setor não está vazio
    if (!empty($nome_setor)) {
        // Insere o novo setor no banco de dados
        $query = "INSERT INTO SETOR (NOME) VALUES (:nome)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome_setor);

        if ($stmt->execute()) {
            echo "<script>alert('Setor cadastrado com sucesso!');</script>";
        } else {
            echo "<p>Erro ao cadastrar o setor. Tente novamente.</p>";
        }
    } else {
        echo "<p>Por favor, preencha o nome do setor.</p>";
    }
}

// Consulta para obter os setores já cadastrados
$query = "SELECT ID, NOME FROM SETOR";
$stmt = $conn->prepare($query);
$stmt->execute();
$setores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Setor</title>
    <link rel="stylesheet" href="css/cadastrar_setor.css">
    <script src="js/cadastrar_setor.js"></script>
</head>
<body>
    <button class="voltar-button" onclick="location.href='admin_dashboard.html'">
        <i class="arrow-left">&#8592;</i>
    </button>
    <div class="container">
        <h1>Cadastrar Novo Setor</h1>
        <form action="cadastrar_setor.php" method="POST">
            <label for="nome_setor">Nome do Setor:</label>
            <input type="text" id="nome_setor" name="nome_setor" required>
            <br><br>
            <button type="submit" class="botao-cadastrar">Cadastrar Setor</button>
        </form>
        
        <h2>Setores Já Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($setores as $setor): ?>
                    <tr>
                        <td><?= htmlspecialchars($setor['id']) ?></td>
                        <td><?= htmlspecialchars($setor['nome']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
