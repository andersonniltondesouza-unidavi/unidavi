<?php
session_start();
include 'db_connection.php';

// Consulta para obter os dispositivos ativos
$query = "SELECT ID, NOME, ID_SETOR FROM DISPOSITIVOS WHERE STATUS = 'ATIVO'";
$stmt = $conn->prepare($query);
$stmt->execute();
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Dispositivo</title>
    <link rel="stylesheet" href="css/selecionar_dispositivo.css">
    <script src="js/selecionar_dispositivo.js"></script>
</head>
<body>
    <button class="voltar-button" onclick="location.href='login_page.php'">
    <i class="arrow-left">&#8592;</i>
    </button>
    <div class="container">
        <h1>Selecionar Dispositivo</h1>
        <form action="selecionar_dispositivo.php" method="POST">
            <label for="dispositivo">Dispositivo:</label>
            <select id="dispositivo" name="dispositivo" required>
                <option value="">Selecione um dispositivo</option>
                <?php foreach ($dispositivos as $dispositivo): ?>
                    <option value="<?= htmlspecialchars($dispositivo['id']) ?>">
                        <?= htmlspecialchars($dispositivo['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <button type="submit" class="botao-confirmar">Confirmar</button>
        </form>

        <?php
       if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dispositivo'])) {
        $dispositivo_id = $_POST['dispositivo'];
        
        // Consulta para obter o ID do setor ao qual o dispositivo está vinculado
        $query_setor = "SELECT ID_SETOR FROM DISPOSITIVOS WHERE ID = :dispositivo_id";
        $stmt_setor = $conn->prepare($query_setor);
        $stmt_setor->bindParam(':dispositivo_id', $dispositivo_id);
        $stmt_setor->execute();
        $setor_info = $stmt_setor->fetch(PDO::FETCH_ASSOC);
    
        if ($setor_info) {
            // Acessa o valor de ID_SETOR independentemente de como o banco retornou (minúsculas ou maiúsculas)
            $setor_id = $setor_info['ID_SETOR'] ?? $setor_info['id_setor'] ?? null;
    
            if (!empty($setor_id)) {
                $_SESSION['dispositivo_id'] = $dispositivo_id;
                $_SESSION['setor_id'] = $setor_id;
                header('Location: index.php');
                exit;
            } else {
                echo "<p class='erro'>Erro: ID_SETOR está vazio para o dispositivo selecionado. Verifique o cadastro do dispositivo.</p>";
            }
        } else {
            echo "<p class='erro'>Erro: Setor não encontrado para o dispositivo selecionado.</p>";
        }
    }
     ?>
    </div>
</body>
</html>
