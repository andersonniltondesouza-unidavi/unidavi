<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade PW2 - Cálculo IMC</title>
    <link rel="stylesheet" href="resources/css/style.css">        
</head>
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/style.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('resources/css/style.css') }}">
        @endif
<body>
    <form action="/resultado" method="post">
        @csrf
        <h1>Cálculo de IMC</h1> 
        <label for="peso">Peso:</label>
        <input type="text" name="peso" id="peso">
        <br>
        <label for="altura">Altura:</label>
        <input type="text" name="altura" id="altura">
        <br>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>