<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade PW2 - Home</title>
</head>
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/style.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('resources/css/style.css') }}">
        @endif
<body>
    <div>
        <h1>Home</h1>
        <p>
            Seja bem-vindo(a) ao sistema de gerenciamento de saúde! <br>
            Selecione uma das opções abaixo:       
        </p>
        <ul>
            <li><a href="{{url('/imc')}}">Calcular IMC</a></li>
            <li><a href="{{url('/sono')}}">Avaliar o sono</a></li>
            <li><a href="{{url('/combustivel')}}">Gastos de Viagem</a></li>
        </ul>
    </div>
</body>
</html>