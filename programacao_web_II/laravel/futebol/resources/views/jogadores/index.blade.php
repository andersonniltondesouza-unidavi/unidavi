<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jogadores') }}
        </h2>
        <br>    
        <div class="mb-4">
            <a href="{{ route('jogadores.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Novo Jogador
            </a>
             &nbsp;
             <br> <br>
            <form action="{{ url('jogadores/search') }}" method="GET" class="inline">
                <input type="text" name="q" placeholder="Insira o jogador" class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded"> 
                    Buscar
                </button>
            </form>
            @if($q !== null)
                <a href="{{ url('jogadores') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">X</a>
            @endif
            &nbsp;  
        </div>    
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($jogadores as $jogador)
                        <div class="mb-4">
                            <a href="{{ route('jogadores.show', $jogador->id) }}" class="hover:bg-blue-900 hover:white hover:text-white rounded-md px-2 py-1"> <strong>{{ $jogador->nome }}</strong></a>                            
                            &nbsp;&nbsp;
                            <a href="{{ url("jogadores") }}/{{ $jogador->id }}/edit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-1 px-2 rounded">Alterar<a>
                            &nbsp;&nbsp;
                            <span class="bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded"
                            onclick="document.getElementById('form-jogadores-excluir-{{$jogador->id}}').submit()">Excluir</span>
                            <form id="form-jogadores-excluir-{{$jogador->id}}" action="{{route('jogadores.destroy',$jogador->id)}}" method="POST">    
                                @csrf
                                @method('DELETE')
                            </form>
                             <p class="hover:underline to-blue-950 px-2 py-1">{{ $jogador->posicao }}</p>
                            &nbsp;&nbsp;      
                    @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
