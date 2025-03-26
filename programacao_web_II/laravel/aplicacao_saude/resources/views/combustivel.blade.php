<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade PW2 -  Cálculo de Combustível</title>
</head>
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/style.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('resources/css/style.css') }}">
        @endif

<body> 
    <form method="post" action="resultado_combustivel">
        @csrf
        <h1>Calculo de consumo de combustivel</h1> 
        <label for="combustivel">Combustivel:</label>
        <select name="combustivel" id="combustivel">
            <option value="Gasolina Comum">Gasolina Comum</option>
            <option value="Gasolina Aditivada">Gasolina Aditivada</option>
            <option value="Etanol">Etanol</option>
        </select>
        <br>
        <label for="valor">Valor:</label>
        <input type="float" name="valor" id="valor" required>
        <br>
        <label for="distancia">Distância em KM:</label>
        <input type="float" name="distancia" id="distancia" required>
        <br>
        <label for="consumo_litro">Consumo de combustivel (KM/L):</label>
        <input type="float" name="consumo_litro" id="consumo_litro" required>
        <br>
        <button type="submit">Calcular</button>
    </form>  
</body>
</html>