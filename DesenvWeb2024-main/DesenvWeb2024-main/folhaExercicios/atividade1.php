<!-- Criar um programa que execute a soma de três valores.
Se a primeira variável for maior que 10, escrever o resultado da operação em azul
Se a segunda variável for menor que a terceira, escrever o resultado em verde
Se a terceira variável for menor que a primeira e a segunda variável escrever o
resultado em vermelho -->
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 1</title>
</head>
<body>
    
    <form action="atividade1.php" method='POST'>
        <div>
            <label for="n1">Número 1</label>
            <input type="number" step = "any" name="n1" id="n1">
            <br>
            <label for="n2">Número 2</label>
            <input type="number" step = "any" name="n2" id="n2">
            <br>
            <label for="n3">Número 3</label>
            <input type="number" step = "any" name="n3" id="n3">
            <br>
            <input type="submit">   
        </div>
    </form>

<?php
    
    if (isset($_POST['n1'])){
    
        $n1 = $_POST['n1'] ?: 0;
        $n2 = $_POST['n2'] ?: 0;
        $n3 = $_POST['n3'] ?: 0;

        $resultado=$n1+$n2+$n3;

        if ($n1 > 10) { 
            echo ('<font color="blue">'.$resultado);
        }
        else if ($n2 < $n3) {
            echo ('<font color="green">'.$resultado);
        }
        else if ($n3 < $n1 and $n3 < $n2) {
            echo ('<font color="red">'.$resultado);
        }
    }
?>
</body>
</html>



