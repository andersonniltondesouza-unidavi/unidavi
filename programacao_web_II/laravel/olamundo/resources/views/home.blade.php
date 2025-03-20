@extends('layout.app')
@section('title', 'Olá Mundo - Home')
@section('content')
    <h1>Olá Mundo</h1>
    <br>
    <p>Exemplo aplicação Laravel BSN - T27</p>
    <br>
    <a href="{{ url('/contato') }}">Contato</a>
@endsection 