<!-- Crie um programa que calcule a área de um retângulo. Você deve configurar duas
variáveis que representam os lados a e b desse quadrado em metros. Após o cálculo
escrever uma frase com o resultado da operação, exemplo: “A área do retângulo de
lados 3 e 2 metros é 6 metros quadrados.” Caso a área for maior que 10 escreva a frase
usando a tag h1, se não, escrever com h3. -->
<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 4</title>
</head>
<body>
    <form action="atividade4.php" method='POST'>
        <div>
            <label for="lado">Lado</label>
            <input type="number" step = "any" name="lado" id="lado"> 
            <label for="comprimento">Comprimento</label>
            <input type="number" step = "any" name="comprimento" id="comprimento">
            <br>
            <input type="submit">     
        </div>
    </form> 
    <?php
         function calcular($lado,$comprimento) {
            $m2 = $lado*$comprimento;
            return $m2;
         }
        
         function msg ($msg) {
            echo $msg;
         }
          
         if (isset($_POST['lado'])){
            $lado = $_POST['lado'] ?: 0;
            $comprimento = $_POST['comprimento'] ?: 0;    
            
            if (calcular($lado,$comprimento) > 10) {
                echo ("<h1> A área do quadrado de lado $lado metros e de $comprimento metros é " .calcular($lado,$comprimento)." metros quadrados </h1>");
            }
        else {
                echo ("<h3> A área do quadrado de lado $lado metros e de $comprimento metros é " .calcular($lado,$comprimento). " metros quadrados </h3>");
            }
        }

        
    ?>
</body>
</html>