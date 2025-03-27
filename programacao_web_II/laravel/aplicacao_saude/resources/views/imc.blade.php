<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade PW2 - Cálculo IMC</title>      
</head>
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/style.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('resources/css/style.css') }}">
        @endif
<body>
    <form action="resultado_imc" method="post">
        @csrf
        <h1>Cálculo de IMC</h1>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <label for="idade">Data de Nascimento</label>
        <input type="date" name="data_nascimento" id="data_nascimento" required>
        <label for="peso">Peso:</label>
        <input type="number" name="peso" id="peso" step="0.1" required>
        <br>
        <label for="altura">Altura:</label>
        <input type="number" name="altura" id="altura" step="0.1" required>
        <br>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>