<?php

session_start();
include 'db_connection.php';

// Verifica se o dispositivo foi selecionado
if (!isset($_SESSION['dispositivo_id'])) {
    header('Location: selecionar_dispositivo.php');
    exit;
}

$dispositivo_id = $_SESSION['dispositivo_id'];

// Consulta para obter informações do dispositivo e setor ao qual pertence
$query = "SELECT D.ID AS dispositivo_id, D.NOME AS dispositivo_nome, S.ID AS setor_id, S.NOME AS setor_nome 
          FROM DISPOSITIVOS D
          JOIN SETOR S ON D.ID_SETOR = S.ID
          WHERE D.ID = :dispositivo_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':dispositivo_id', $dispositivo_id);
$stmt->execute();
$dispositivo_info = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dispositivo_info) {
    echo "Erro: Dispositivo não encontrado.";
    exit;
}

// Consulta para obter as perguntas
$query = "SELECT id, pergunta, status FROM perguntas WHERE STATUS = 'ATIVA' ";
$stmt = $conn->prepare($query);
$stmt->execute();
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Avaliação</title>
    <link rel="stylesheet" href="css/estilo.css">
    <script src="js/script.js"></script>
</head>
<body>
<button class="voltar-button unique-class" onclick="location.href='login_page.php'"><i class="arrow-left">&#8592;</i></button>
    <div class="container">
        <h1>Sistema de Avaliação</h1>
        <form action="processar_avaliacao.php" method="POST" onsubmit="return validarFormulario()">
            <?php foreach ($perguntas as $index => $pergunta): ?>
                <div class="pergunta" id="pergunta-<?= $index ?>" style="display: <?= $index === 0 ? 'block' : 'none' ?>;">
                    <p><strong><?= htmlspecialchars($pergunta['pergunta']) ?></strong></p>
                    <div class="notas-container" data-pergunta-id="<?= $pergunta['id'] ?>">
                        <?php for ($nota = 0; $nota <= 10; $nota++): ?>
                            <button type="button" class="botao-nota" data-pergunta-id="<?= $pergunta['id'] ?>" data-nota="<?= $nota ?>" onclick="selecionarNota(<?= $pergunta['id'] ?>, <?= $nota ?>)">
                                <?= $nota ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="notas[<?= $pergunta['id'] ?>]" id="nota-<?= $pergunta['id'] ?>" value="">
                    <textarea name="observacoes[<?= $pergunta['id'] ?>]" class="observacoes" placeholder="Observações opcionais"></textarea>
                </div>
            <?php endforeach; ?>
            <button type="button" class="anterior-pergunta" onclick="mostrarPerguntaAnterior()" style="display: none;">Pergunta Anterior</button>
            <button type="button" class="proxima-pergunta" onclick="mostrarProximaPergunta()">Próxima Pergunta</button>
            <button type="submit" class="enviar" style="display: none;">Enviar Avaliação</button>
        </form>
    </div>
    <footer class="footer-aviso">
        <p>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
    </footer>
</body>
</html>
