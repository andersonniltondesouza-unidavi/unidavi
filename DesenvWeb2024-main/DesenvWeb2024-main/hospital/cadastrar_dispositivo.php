<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_dispositivo'], $_POST['id_setor'])) {
    $nome_dispositivo = $_POST['nome_dispositivo'];
    $id_setor = $_POST['id_setor'];

    if (!empty($nome_dispositivo) && !empty($id_setor)) {
        // Insere o novo dispositivo no banco de dados
        $query = "INSERT INTO DISPOSITIVOS (NOME, id_setor, STATUS) VALUES (:nome, :id_setor, 'ATIVO')";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome_dispositivo);
        $stmt->bindParam(':id_setor', $id_setor);

        if ($stmt->execute()) {
            echo "<script>alert('Dispositivo cadastrado com sucesso!');</script>";
        } else {
            echo "<p>Erro ao cadastrar o dispositivo. Tente novamente.</p>";
        }
    } else {
        echo "<p>Por favor, preencha todos os campos, incluindo o setor.</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['desativar_id']) || isset($_POST['ativar_id'])) {
        // Obtém o ID do dispositivo e o novo status
        $id = isset($_POST['desativar_id']) ? $_POST['desativar_id'] : $_POST['ativar_id'];
        $novo_status = isset($_POST['desativar_id']) ? 'INATIVO' : 'ATIVO';

        // Atualiza o status do dispositivo no banco de dados
        $query = "UPDATE DISPOSITIVOS SET STATUS = :novo_status WHERE ID = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':novo_status', $novo_status);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
        exit;
    }
}

// Consulta para obter os dispositivos já cadastrados
$query = "SELECT ID, NOME, ID_SETOR, STATUS FROM DISPOSITIVOS";
$stmt = $conn->prepare($query);
$stmt->execute();
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obter os setores disponíveis
$query_setores = "SELECT ID, NOME FROM SETOR";
$stmt_setores = $conn->prepare($query_setores);
$stmt_setores->execute();
$setores = $stmt_setores->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Dispositivo</title>
    <link rel="stylesheet" href="css/cadastrar_dispositivo.css">
    <script src="js/cadastrar_dispositivo.js"></script>
</head>
<body>
    <button class="voltar-button" onclick="location.href='admin_dashboard.html'">
        <i class="arrow-left">&#8592;</i>
    </button>
    <div class="container">
        <h1>Cadastrar Novo Dispositivo</h1>
        <form action="cadastrar_dispositivo.php" method="POST">
            <label for="nome_dispositivo">Nome do Dispositivo:</label>
            <input type="text" id="nome_dispositivo" name="nome_dispositivo" required>
            <br><br>
            <label for="id_setor">Setor:</label>
            <select id="id_setor" name="id_setor" required>
                <option value="">Selecione um setor</option>
                <?php foreach ($setores as $setor): ?>
                    <option value="<?= htmlspecialchars($setor['id']) ?>">
                        <?= htmlspecialchars($setor['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <button type="submit" class="botao-cadastrar">Cadastrar Dispositivo</button>
        </form>
        
        <h2>Dispositivos Já Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>ID do Setor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dispositivos as $dispositivo): ?>
                    <tr>
                        <td><?= htmlspecialchars($dispositivo['id']) ?></td>
                        <td><?= htmlspecialchars($dispositivo['nome']) ?></td>
                        <td><?= htmlspecialchars($dispositivo['id_setor']) ?></td>
                        <td><?= htmlspecialchars($dispositivo['status']) ?></td>
                        <td>
                            <?php if ($dispositivo['status'] === 'ATIVO'): ?>
                                <button class="botao-desativar" onclick="desativarDispositivo(<?= $dispositivo['id'] ?>)">Desativar</button>
                            <?php else: ?>
                                <button class="botao-ativar" onclick="ativarDispositivo(<?= $dispositivo['id'] ?>)">Ativar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
