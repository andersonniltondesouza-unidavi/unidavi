<?php
    echo '<h1>Dados</h1>';
    echo 'Nome: ' . ($_REQUEST['nome']) . ' <br>';
    echo 'Telefone: ' . ($_REQUEST['telefone']) . '<br>';
    echo 'E-mail: ' . ($_REQUEST['email']) . '<br>';
    echo 'Mensagem: ' . nl2br(($_REQUEST['mensagem'])) . '<br><br>';

    echo '<h2>Método utilizado:</h2>';
    echo $_SERVER['REQUEST_METHOD'] . '<br>';
    echo '<h2>Cabeçalhos da Requisição:</h2>';
    $headers = apache_request_headers();
    foreach ($headers as $header => $value) 
        echo ($header) . ': ' . ($value) . '<br>';
?>