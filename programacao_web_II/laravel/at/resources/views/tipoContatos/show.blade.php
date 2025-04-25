<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tipo Contato') }} :
            {{ $tipoContato->nome }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <ul>
                            <li><strong>Id:</strong>{{ $tipoContato->id }}</li>
                            <li><strong>Nome:</strong>{{ $tipoContato->nome }}</li>
                            <li><strong>Descrição:</strong>{{ $tipoContato->descricao }}</li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('tipoContatos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
