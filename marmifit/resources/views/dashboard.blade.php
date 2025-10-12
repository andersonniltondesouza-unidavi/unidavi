<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marmitas') }}
        </h2>
    </x-slot>
    
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($marmitas as $marmita)
                        <div class="bg-white rounded-xl shadow hover:shadow-md transition p-4">
                            <div class="w-full h-48 overflow-hidden rounded-lg">
                                <img 
                                    src="{{ asset('images/marmitas/marmita_' . $marmita->id . '.jpg') }}" 
                                    alt="{{ $marmita->nome }}" 
                                    class="w-full h-full object-cover block"
                                />
                            </div>

                            <div class="mt-3">
                                <a class="block text-lg font-semibold text-gray-800 hover:text-blue-600">
                                    {{ $marmita->nome }}
                                </a>
                                <p class="text-gray-700 font-medium">{{ $marmita->preco}} R$</p>
                                <p class="text-gray-600 text-sm mt-1">{{ $marmita->descricao }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
