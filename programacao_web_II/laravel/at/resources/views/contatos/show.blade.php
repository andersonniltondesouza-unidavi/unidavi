<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contato') }} ::
            {{ $contato->id }} - {{ $contato->nome }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <ul>
                            <li><strong>Id:</strong>{{ $contato->id }}</li>
                            <li><strong>Nome:</strong>{{ $contato->nome }}</li>
                            <li><strong>e-mail:</strong><a href="mailto:{{ $contato->email }}" class="hover:underline to-blue-950">{{ $contato->email }}</a></li>
                            <li><strong>Telefone:</strong>{{ $contato->telefone }}</li>
                            <li><strong>Cidade:</strong>{{ $contato->cidade }}</li>
                            <li><strong>Estado:</strong>{{ $contato->estado }}</li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('contatos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
