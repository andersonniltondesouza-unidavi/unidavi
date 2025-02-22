<!-- Mariazinha foi comprar um carro novo esse carro custa R$ 22.500,00 a vista, mas como
ela não tem esse dinheiro para comprar a vista, resolveu fazer um financiamento, que
ficou em 60 parcelas de R$ 489,65.
Escreva um programa que calcule o valor gasto só dos juros que serão pagos por
Mariazinha em comparação ao valor a vista do carro. -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 7</title>
</head>
<body>
<form action="atividade7.php" method='POST'>
    <div>
        <label for="valor">Valor</label>
        <input type="number" step = "any" name="valor" id="valor">
        <br>
        <label for="parcela">Parcelas</label>
        <select name="parcela" id="parcela">
            <option value="60">60 Vezes</option>
        </select>
        <br>
        <label for="valor_parcela">Valor por parcela</label>
        <input type="number" step = "any" name="valor_parcela" id="valor_parcela">
        <br> 
        <input type="submit" value="Calcular" id="submit">
    </div>
</form>

<?php
         
         function msg ($msg) {
             echo $msg;
         }
 
         function calcula($parcela,$valor_parcela){
             $valorcomjuros=$parcela*$valor_parcela;
             return $valorcomjuros;
         }
 
         if (isset($_POST['valor'])){
             
             $valor = $_POST['valor'] ?: 0;
             $parcela = $_POST['parcela'] ?: 0;
             $valor_parcela = $_POST['valor_parcela'] ?: 0;
 
             msg("Valor dos juros = " .calcula($parcela,$valor_parcela) - $valor);
         }
     ?>
</body>
</html>