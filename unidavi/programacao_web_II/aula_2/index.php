<!-- Criar um página em PHP+HTML+CSS que contenha um formulário com os dados:

Nome - Texto
Telefone - numérico 
e-mail - texto
Mensagem - texto parágrafo

Fazer o envio dos dados através de um form para um destino e nesse destino exibir os dados enviados e também todo o cabeçalho da requisição HTTP, bem como o método utilizado.
Também montar uma URL que envie requisição por GET. -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PW2 - Atividade 01 - 20.02 </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Atividade 1</h1>
    <hr>
    <form method="GET" action="destino.php">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" class="input" required placeholder="Insira seu nome"> <br> 
    <label for="telefone">Telefone</label>
    <input type="number" id="telefone" name="telefone" class="input" required placeholder="Insira seu telefone"><br>
    <label for="email">E-mail</label>
    <input type="text" id="email" name="email" class="input" required placeholder="Insira seu e-mail"><br>
    <label for="mensagem">Mensagem</label>
    <input type="text" id="mensagem" name="mensagem" class="input" required placeholder="Deixe uma mensagem"><br>
    <button type="submit">Enviar</button>
    </form>
    <br>
     <p>
        Você também pode fazer REQUEST na URL: <a href="destino.php">http://localhost/unidavi/programacao_web_II/aula_2/destino.php?nome=aaa&telefone=123&email=aaa&mensagem=123</a>
     </p>   
</body>
 
</html>