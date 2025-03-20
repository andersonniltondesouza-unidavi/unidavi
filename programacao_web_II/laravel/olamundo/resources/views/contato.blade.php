@extends('layout.app')
@section('title', 'Olá Mundo - Contato')
@section('content')
    <h1>Olá Mundo - Contato</h1>
    <br>
    <p>Para realizar contato com o desenvolver dessa aplicação, utilize os e-mails
    <br>
    @foreach($emails as $email)
        <a href="mailto:{{$email}}"><?php echo $email ?></a>
        <br>
    @endforeach
    </p>
    <br>
    <div class="small text-yellow-500">
        Script executado {{$script}} as {{$datahora}}
    </div>
@endsection