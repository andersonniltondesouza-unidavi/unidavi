<!-- Joãozinho recebeu R$ 50,00 reais de seu pai para ir à feira comprar frutas e verduras.
Ele comprou maçã, melancia, laranja, repolho, cenoura, batatinha.
Crie um programa que calcule o valor gasto com cada produto comprado, sendo o
resultado do valor individual do produto em Kg multiplicado pela quantidade em Kg
comprada por Joãozinho.
Ao final escrever uma frase com o valor da compra, e uma previsão se o dinheiro será
o suficiente para pagar a conta, caso falte dinheiro escrever uma frase em vermelho
com o valor que ficou acima do disponível por Joãozinho, e não, escrever uma fase em
azul e o valor que Joãozinho ainda poderia gastar. -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 6</title>
</head>
<body>
    <form action="atividade6.php" method='POST'>
        <div>
            <p>Joãozinho possui um saldo de 50,00R$! <br> </p>
            <label for="maça_preco">Maçã Preço/KG</label>
            <input type="number" step = "any" name="maça_preco" id="maça_preco">
            <br>
            <label for="maça_qnt">Quantidade</label>
            <input type="number" step = "any" name="maça_qnt" id="maça_qnt">
            <br> <br>     
            <label for="melancia_preco">Melancia Preço/KG</label>
            <input type="number" step = "any" name="melancia_preco" id="melancia_preco">
            <br>
            <label for="melancia_qnt">Quantidade</label>
            <input type="number" step = "any" name="melancia_qnt" id="melancia_qnt">
            <br> <br>
            <label for="laranja_preco">Laranja Preço/KG</label>
            <input type="number" step = "any" name="laranja_preco" id="laranja_preco">
            <br>
            <label for="laranja_qnt">Quantidade</label>
            <input type="number" step = "any" name="laranja_qnt" id="laranja_qnt">
            <br> <br>
            <label for="repolho_preco">Repolho Preço/KG</label>
            <input type="number" step = "any" name="repolho_preco" id="repolho_preco">
            <br>
            <label for="repolho_qnt">Quantidade</label>
            <input type="number" step = "any" name="repolho_qnt" id="repolho_qnt">
            <br> <br>
            <label for="cenoura_preco">Cenoura Preço/KG</label>
            <input type="number" step = "any" name="cenoura_preco" id="cenoura_preco">
            <br>
            <label for="cenoura_qnt">Quantidade</label>
            <input type="number" step = "any" name="cenoura_qnt" id="cenoura_qnt">
            <br> <br>
            <label for="batata_preco">Batata Preço/KG</label>
            <input type="number" step = "any" name="batata_preco" id="batata_preco">
            <br>
            <label for="batata_qnt">Quantidade</label>
            <input type="number" step = "any" name="batata_qnt" id="batata_qnt">
            <br> <br>
            <input type="submit"> <br>   
        </div>
    </form> 

    <?php

        function msg ($msg) {
            echo $msg;
        }
        
        function calcular ($precos,$valor,$qnt) {
            foreach ($precos as $produto => $preco)  {
                $valor += $preco * $qnt[$produto];
            }
            return $valor;
        }
                
        if (isset($_POST['maça_preco'])){
            $Joaozinho = 50.00;
            
        $precos = [
                "maçã" => $_POST['maça_preco']?:0,    
                "melancia" => $_POST['melancia_preco']?:0, 
                "laranja" => $_POST['laranja_preco']?:0,  
                "repolho" => $_POST['repolho_preco']?:0,  
                "cenoura" => $_POST['cenoura_preco']?:0,  
                "batata" => $_POST['batata_preco']?:0  
            ];
    
        $qnt = [
                "maçã" => $_POST['maça_qnt']?:0,    
                "melancia" => $_POST['melancia_qnt']?:0,  
                "laranja" => $_POST['laranja_qnt']?:0, 
                "repolho" => $_POST['repolho_qnt']?:0, 
                "cenoura" => $_POST['cenoura_qnt']?:0,  
                "batata" => $_POST['batata_qnt']?:0  
            ];

            $valor = 0;

            if (calcular($precos,$valor,$qnt) < $Joaozinho) {
                $sobra = $Joaozinho - calcular($precos,$valor,$qnt);
                msg("<span style='color: blue;'>Joãozinho ainda pode gastar R$ $sobra.</span>");
            } else if (calcular($precos,$valor,$qnt) > $Joaozinho) {
                $falta = calcular($precos,$valor,$qnt) - $Joaozinho;
                msg("<span style='color: red;'>Faltam R$ $sobra para pagar a conta.</span>");
            } else {
                msg("<span style='color: green;'>O saldo para compras foi esgotado.</span>");
            }
    
            msg("<br>A compra total foi de R$ ".calcular($precos,$valor,$qnt));
            }
    ?>
</body>
</html>