<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Verifica se o dispositivo e o setor foram selecionados
        if (!isset($_SESSION['dispositivo_id']) || !isset($_SESSION['setor_id'])) {
            echo "Erro: Nenhum dispositivo ou setor selecionado.";
            exit;
        }

        $dispositivo_id = $_SESSION['dispositivo_id'];
        $setor_id = $_SESSION['setor_id'];

        $conn->beginTransaction();

        $query = "INSERT INTO respostas (id_pergunta, nota, observacoes, id_dispositivo, id_setor, data_hora) 
                  VALUES (:id_pergunta, :nota, :observacoes, :id_dispositivo, :id_setor, NOW())";
        $stmt = $conn->prepare($query);

        foreach ($_POST['notas'] as $id_pergunta => $nota) {
            $observacoes = isset($_POST['observacoes'][$id_pergunta]) ? $_POST['observacoes'][$id_pergunta] : null;

            $stmt->execute([
                ':id_pergunta' => $id_pergunta,
                ':nota' => $nota,
                ':observacoes' => $observacoes,
                ':id_dispositivo' => $dispositivo_id,
                ':id_setor' => $setor_id
            ]);
        }

        $conn->commit();

        header('Location: sucesso.html');
        exit;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Erro ao registrar a avaliação: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>
