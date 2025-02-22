<!-- Crie um programa que calcule a área de um quadrado. Você deve configurar uma
variável que representa o comprimento dos lados de um quadrado em metros. Após o
cálculo escrever uma frase com o resultado da operação, exemplo: “A área do
quadrado de lado 3 metros é 9 metros quadrados” -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 3</title>
</head>
<body>
    <form action="atividade3.php" method='POST'>
        <div>
            <label for="lado">Lado do quadrado</label>
            <input type="number" step = "any" name="lado" id="lado">
            <br>
            <input type="submit">     
        </div>
    </form>

    <?php
         
         function calcular($lado) {
            $m2 = $lado*$lado;
            return $m2;
         }
         if (isset($_POST['lado'])){
            
            $lado = $_POST['lado'] ?: 0;         
            
            echo ("A área do quadrado de lado $lado  metros é " .calcular($lado)." metros quadrados");
        }
    ?>
    
</body>
</html>