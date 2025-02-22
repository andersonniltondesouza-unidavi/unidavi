<!-- Crie um programa para testar se um número é divisível por 2.
Caso for verdade escrever a frase “Valor divisível por 2”
Caso for falso escrever a frase “O valor não é divisível por 2” -->
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 2</title>
</head>
<body>
    <form action="atividade2.php" method='POST'>
        <div>
            <label for="valor">Número</label>
            <input type="number" step = "any" name="valor" id="valor">
            <br>
            <input type="submit">     
        </div>
    </form>

<?php 
    function verifica($valor) {
        if ($valor % 2 ==0) {
            echo("Valor é divisível por 2"); 
        }
        else {
            echo("Valor não é divisível por 2");
        }
    }
    if (isset($_POST['valor'])){

        $valor = $_POST['valor'] ?: 0;

        verifica($valor);
    }
?>
</body>
</html>