<!-- Juquinha seguindo o mesmo caminho que Paulinho foi comprar uma moto nova, mas
pena que ele não sabia da mesma chance que Paulinho.
A empresa que Juquinha foi comprar a moto utiliza juros compostos para calcular o
valor das parcelas. As opções de compras estudadas por ele são as mesmas de Paulinho, ou seja 24, 36,
48 e 60 vezes o juro nesta empresa inicia em 2% para 24 vezes e aumenta 0,3% para
as opções de parcelamento seguintes.
Utilizando então a fórmula de juros composto que segue abaixo, calcule o valor da
parcela para cada uma das opções a ser estudada por Juquinha.
M = C * (1 + i)t , onde:
M = Montante
C = Capital Inicial
i = Taxa de juros
t = Tempo -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 9</title>
</head>
<body>
<form action="atividade9.php" method='POST'>
    <div>
        <label for="valor">Valor sem juros</label>
        <input type="number" step = "any" name="valor" id="valor">
        <br>
        <label for="parcela">Parcelas</label>
        <select name="parcela" id="parcela">
            <option value="24" id="24">24 Vezes</option>
            <option value="36" id="36">36 Vezes</option>
            <option value="48" id="48">48 Vezes</option>
            <option value="60" id="60">60 Vezes</option>
        </select>
        <br> 
        <input type="submit" value="Calcular" id="submit">
    </div>
</form>
<?php
        function msg ($msg) {
             echo $msg;
         }
 
         function calcula($parcela,$valor){
            if ($parcela == 24) {
                $juros=pow((1 + 0.02),$parcela);
            }
            elseif ($parcela == 36) {
                $juros=pow((1 + 0.023),$parcela);
            }
            elseif ($parcela == 48) {
                $juros=pow((1 + 0.026),$parcela);
            }
            elseif ($parcela == 60) {
                $juros=pow((1 + 0.029),$parcela);
            }
            $valor_juros=$valor*$juros;
            $valor_parcela=$valor_juros/$parcela;
            return round($valor_parcela,2);
        }
         
        if (isset($_POST['valor'])){  
             $valor = $_POST['valor'] ?: 0;
             $parcela = $_POST['parcela'] ?: 0;
             msg("Valor das parcelas com juros = " .calcula($parcela,$valor));
         }
     ?>
</body>
</html>