<?php
session_start();
include 'db_connection.php';

// Consulta para obter os dispositivos
$query_dispositivos = "SELECT ID, NOME FROM DISPOSITIVOS";
$stmt_dispositivos = $conn->prepare($query_dispositivos);
$stmt_dispositivos->execute();
$dispositivos = $stmt_dispositivos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obter as perguntas
$query_perguntas = "SELECT ID, PERGUNTA FROM PERGUNTAS";
$stmt_perguntas = $conn->prepare($query_perguntas);
$stmt_perguntas->execute();
$perguntas = $stmt_perguntas->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obter as respostas e os dados relacionados
$query = "
    SELECT r.data_hora, r.id_pergunta, p.pergunta AS descricao_pergunta, r.nota, r.observacoes, d.nome AS dispositivo_nome, s.nome AS setor_nome
    FROM respostas r
    JOIN perguntas p ON r.id_pergunta = p.id
    JOIN dispositivos d ON r.id_dispositivo = d.id
    JOIN setor s ON d.id_setor = s.id
    WHERE 1=1
";

if (isset($_GET['filtro_dispositivo']) && !empty($_GET['filtro_dispositivo'])) {
    $query .= " AND r.id_dispositivo = :filtro_dispositivo";
}
if (isset($_GET['filtro_pergunta']) && !empty($_GET['filtro_pergunta'])) {
    $query .= " AND r.id_pergunta = :filtro_pergunta";
}

$stmt = $conn->prepare($query);

if (isset($_GET['filtro_dispositivo']) && !empty($_GET['filtro_dispositivo'])) {
    $stmt->bindParam(':filtro_dispositivo', $_GET['filtro_dispositivo']);
}
if (isset($_GET['filtro_pergunta']) && !empty($_GET['filtro_pergunta'])) {
    $stmt->bindParam(':filtro_pergunta', $_GET['filtro_pergunta']);
}

$stmt->execute();
$respostas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitorar Sistema</title>
    <link rel="stylesheet" href="css/monitorar_sistema.css">
</head>
<body>
    <button class="voltar-button" onclick="location.href='admin_dashboard.html'">
        <i class="arrow-left">&#8592;</i>
    </button>
    <div class="container">
        <h1>Monitorar Sistema</h1>

        <div class="filtro-container">
            <form id="filtro-form" action="monitorar_sistema.php" method="GET">
                <label for="filtro_dispositivo">Filtrar por Dispositivo:</label>
                <select id="filtro_dispositivo" name="filtro_dispositivo">
                    <option value="">Todos os Dispositivos</option>
                    <?php foreach ($dispositivos as $dispositivo): ?>
                        <option value="<?= htmlspecialchars($dispositivo['id']) ?>" <?= isset($_GET['filtro_dispositivo']) && $_GET['filtro_dispositivo'] == $dispositivo['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dispositivo['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="filtro_pergunta">Filtrar por Pergunta:</label>
                <select id="filtro_pergunta" name="filtro_pergunta">
                    <option value="">Todas as Perguntas</option>
                    <?php foreach ($perguntas as $pergunta): ?>
                        <option value="<?= htmlspecialchars($pergunta['id']) ?>" <?= isset($_GET['filtro_pergunta']) && $_GET['filtro_pergunta'] == $pergunta['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($pergunta['pergunta']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="botao-filtrar">Filtrar</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>ID Pergunta</th>
                    <th>Descrição da Pergunta</th>
                    <th>Nota</th>
                    <th>Observações</th>
                    <th>Dispositivo</th>
                    <th>Setor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($respostas as $resposta): ?>
                    <tr>
                        <td><?= htmlspecialchars($resposta['data_hora']) ?></td>
                        <td><?= htmlspecialchars($resposta['id_pergunta']) ?></td>
                        <td><?= htmlspecialchars($resposta['descricao_pergunta']) ?></td>
                        <td><?= htmlspecialchars($resposta['nota']) ?></td>
                        <td><?= htmlspecialchars($resposta['observacoes']) ?></td>
                        <td><?= htmlspecialchars($resposta['dispositivo_nome']) ?></td>
                        <td><?= htmlspecialchars($resposta['setor_nome']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
