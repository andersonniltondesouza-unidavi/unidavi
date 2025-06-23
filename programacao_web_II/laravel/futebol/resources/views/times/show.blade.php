<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Time: ') }}
             {{ $time->nome }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <ul>
                            <li><strong>Id: </strong>{{ $time->id }}</li>
                            <li><strong>Nome: </strong>{{ $time->nome }}</li>
                            <li><strong>Sigla: </strong>{{ $time->sigla }}</a></li>
                            <li><strong>Estado: </strong>{{ $time->estado }}</li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('times.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</x-app-layout>
