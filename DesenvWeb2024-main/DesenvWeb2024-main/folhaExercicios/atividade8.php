<!-- Paulinho foi comprar uma moto nova. A empresa vende motos muito baratas pois
utiliza Juros Simples para o cálculo das parcelas.
Sabendo então que o valor a vista do moto é R$ 8.654,00.
Crie um programa que calcule o valor das parcelas para as opções abaixo, sabendo que
a taxa de juros aumenta 0,5% em cada nível e inicia em 1,5% para 24 vezes:
24 vezes,36 vezes,48 vezes,60 vezes -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 8</title>
</head>
<body>
<form action="atividade8.php" method='POST'>
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
                $juros=$valor*0.015*$parcela;
            }
            elseif ($parcela == 36) {
                $juros=$valor*0.02*$parcela;
            }
            elseif ($parcela == 48) {
                $juros=$valor*0.025*$parcela;
            }
            elseif ($parcela == 60) {
                $juros=$valor*0.03*$parcela;
            }
            $valor_juros=$valor+$juros;
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