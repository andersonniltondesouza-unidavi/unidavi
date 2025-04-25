<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contatos') }}
        </h2>
        <br>
        <div class="mb-4">
            <a href="{{ route('contatos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Novo Contato
            </a>
            &nbsp;
            <form action="{{ url('contatos/search') }}" method="GET" class="inline">
                <input type="text" name="q" placeholder="Pesquisar..." class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded">
                    <img src="{{ asset('images/lupa.png') }}" alt="Pesquisar" class="inline w-4 h-4">
                </button>
            </form>
            @if($q !== null)
                <a href="{{ url('contatos') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">X</a>
            @endif
            &nbsp;
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div id="success-message" class="alert alert-success items-center bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                const successMessage = document.getElementById('success-message');
                                if (successMessage) {
                                    successMessage.style.display = 'none';
                                }
                            }, 5000);
                        </script>
                    @endif
                    @foreach ($contatos as $contato)
                        <div class="mb-4">
                            <a href="{{ route('contatos.show', $contato->id) }}" class="hover:bg-blue-900 hover:white hover:text-white rounded-md px-2 py-1">
                            <strong>{{ $contato->nome }}</strong></a> -
                            <a href="mailto:{{ $contato->email }}" class="hover:underline to-blue-950">{{ $contato->email }}</a>
                            &nbsp;-&nbsp;
                            <a href="{{ url("contatos") }}/{{ $contato->id }}/edit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-1 px-2 rounded">Alterar</a>
                            &nbsp;-&nbsp;
                            <button type="button" class="bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded"
                            onclick="if(confirm('Tem certeza que deseja excluir este contato?')) document.getElementById('form-contatos-excluir-{{$contato->id}}').submit()">Excluir</button>
                            <form id="form-contatos-excluir-{{$contato->id}}" action="{{route('contatos.destroy',$contato->id)}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>