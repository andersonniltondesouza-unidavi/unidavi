<!-- 5. Crie um programa que calcule a área de um triângulo retângulo, cuja fórmula segue
abaixo. Crie as variáveis apropriadas para o cálculo em PHP e por fim exiba uma frase
com o valor da operação.  Fórmula -> Resultado = (Base * Altura) / 2-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 5</title>
</head>
<body>
    <form action="atividade5.php" method='POST'>
        <div>
            <label for="base">Base</label>
            <input type="number" step = "any" name="base" id="base"> 
            <label for="altura">Altura</label>
            <input type="number" step = "any" name="altura" id="altura">
            <br>
            <input type="submit">     
        </div>
    </form> 
    <?php

        function calcula($base,$altura) {
            $m2 = (($base*$altura) / 2);
            return $m2;
        }
         if (isset($_POST['base'])){
            $base = $_POST['base'] ?: 0;
            $altura = $_POST['altura'] ?: 0;
            
            echo ("A área do triângulo retângulo de base $base metros e de altura $altura metros = " .calcula($base,$altura))   ;
            }
    ?>
</body>
</html>