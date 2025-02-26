<?php
    echo '<h1>Dados Recebidos</h1>';
    echo 'Nome: ' . htmlspecialchars($_REQUEST['nome']) . ' <br>';
    echo 'Telefone: ' . htmlspecialchars($_REQUEST['telefone']) . '<br>';
    echo 'E-mail: ' . htmlspecialchars($_REQUEST['email']) . '<br>';
    echo 'Mensagem: ' . nl2br(htmlspecialchars($_REQUEST['mensagem'])) . '<br><br>';

    echo '<h2>Método HTTP utilizado:</h2>';
    echo $_SERVER['REQUEST_METHOD'] . '<br><br>';

    echo '<h2>Cabeçalhos da Requisição:</h2>';
    $headers = apache_request_headers();
    foreach ($headers as $header => $value) 
        echo htmlspecialchars($header) . ': ' . htmlspecialchars($value) . '<br>';
?>