<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Altera Jogador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('jogadores.update', $jogadores->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="id" class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                            <input type="integer" name="id" id="id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ $jogadores->id }}">
                        </div>

                        <div class="mb-4">
                            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                            <input type="text" name="nome" id="nome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ $jogadores->nome }}">
                        </div>

                        <div class="mb-4">
                            <label for="data_nascimento" class="block text-gray-700 text-sm font-bold mb-2">Data de Nascimento:</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ $jogadores->data_nascimento }}">
                        </div>

                        <div class="mb-4">
                            <label for="posicao" class="block text-gray-700 text-sm font-bold mb-2">Posição:</label>
                            <input type="text" name="posicao" id="posicao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ $jogadores->posicao }}">
                        </div>

                        <div class="mb-4">
                            <label for="time_id" class="block text-gray-700 text-sm font-bold mb-2">Time:</label>
                            <select name="time_id" id="time_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:  shadow-outline" required >
                                @foreach($times as $time)
                                    <option value="{{ $time->id }}" {{ $jogadores->time_id == $time->id ? 'selected' : '' }}>{{ $time->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Salvar</button>
                    </form>
                </div>
                <div class="mb-4">
                    <a href="{{ route('jogadores.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

