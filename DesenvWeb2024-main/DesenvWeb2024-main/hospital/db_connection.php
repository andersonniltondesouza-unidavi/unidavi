<?php
$host = 'localhost';
$dbname = 'hospital';
$user = 'postgres';
$password = '1234';

try {
    // Conexão com o banco de dados
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
