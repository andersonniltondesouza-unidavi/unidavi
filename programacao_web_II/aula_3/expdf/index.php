<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML('<p>This is a test</p>');
$mpdf->WriteHTML('<img src="https://i0.wp.com/blog.bioparquedorio.com.br/wp-content/uploads/2024/03/Abu_filhote_macaco-prego-do-peito-amarelo-BioParquedoRio2.png?resize=1024%2C710&ssl=1">');
$mpdf->Output();

?>