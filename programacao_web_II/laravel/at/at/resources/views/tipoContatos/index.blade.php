<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tipo Contatos') }}
        </h2>
        <br>
        <div class="mb-4">
            <a href="{{ route('tipocontatos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Novo Tipo de Contato
            </a>
        </div>

    </x-slot>
    <script type="text/javascript">
        function exibe(id) {
            var descricao = document.getElementById(id);
            if (descricao.style.display === "none") {
                descricao.style.display = "block";
            } else {
                descricao.style.display = "none";
            }
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($tipocontatos as $tipocontato)
                        <div class="mb-4">
                            <strong onclick="exibe('descricao-{{ $tipocontato->id }}')" class="cursor-pointer">{{ $tipocontato->nome }}</strong>
                            &nbsp;-&nbsp;
                            <a href="{{ url("tipocontatos") }}/{{ $tipocontato->id }}/edit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-1 px-2 rounded">Alterar</a>
                            &nbsp;-&nbsp;
                            <span class="bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded cursor-pointer"
                            onclick="document.getElementById('form-tipocontatos-excluir-{{$tipocontato->id}}').submit()">Excluir</span>
                            <form id="form-tipocontatos-excluir-{{$tipocontato->id}}" action="{{route('tipocontatos.destroy',$tipocontato->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <p id="descricao-{{ $tipocontato->id }}" class="mt-2 text-gray-600 descricao" style="display: none;">
                                {{ $tipocontato->descricao }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
