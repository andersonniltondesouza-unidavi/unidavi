<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade PW2 - Avaliação de Sono</title>
</head>
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/style.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('resources/css/style.css') }}">
        @endif

<body> 
    <form method="post" action="resultado_sono">
        @csrf
        <h1>Avaliação de Sono</h1> 
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <label for="idade">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" required>
        <br>
        <label for="horas">Horas de Sono:</label>
        <input type="float" name="horas" id="horas" required>
        <br>
        <button type="submit">Calcular</button>
    </form>  
</body>
</html>