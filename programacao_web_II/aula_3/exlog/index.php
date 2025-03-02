<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
echo 'Criar um canal de log<br>';
$log = new Logger('app');
$log->pushHandler(new StreamHandler('app.log', Level::Warning));

// add records to the log
echo 'Adicionar registros ao log warning<br>';
$log->warning('Alerta');
echo 'Adicionar registros ao log error';
$log->error('Erro');

$loglogin = new Logger('login');
$loglogin->pushHandler(new StreamHandler('login.log', Level::Warning));

$loglogin->warning('Usuario não encontrado');
$loglogin->error('Senha incorreta');

?>
