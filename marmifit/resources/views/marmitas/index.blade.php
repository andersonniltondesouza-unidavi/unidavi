<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro') }}
        </h2>
        <br>
         <a href="{{ route('marmitas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nova Marmita
            </a>
    </x-slot>

     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($marmitas as $marmita)
                        <div class="mb-4">
                            <a class="hover:bg-blue-900 hover:white hover:text-white rounded-md px-2 py-1"> <strong>{{ $marmita->nome }}</strong></a>                            
                            &nbsp;&nbsp;
                            <a href="{{ url("marmitas") }}/{{ $marmita->id }}/edit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-1 px-2 rounded">Alterar<a>
                            &nbsp;&nbsp;
                           <button type="button" class="bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded"
                            onclick="if(confirm('Tem certeza que deseja excluir essa marmita?')) document.getElementById('form-marmitas-excluir-{{$marmita->id}}').submit()">Excluir</button>
                            <form id="form-marmitas-excluir-{{$marmita->id}}" action="{{route('marmitas.destroy',$marmita->id)}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                             <p class="px-2 py-1">{{ $marmita->descricao}}</p>
                            &nbsp;&nbsp;      
                    @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
