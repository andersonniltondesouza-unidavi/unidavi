<x-guest-layout>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="flex flex-col md:flex-row md:flex-wrap gap-4">
            <!-- Nome -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>
     
            <!-- Email -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Senha -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input id="password" class="block w-full" type="password" name="password" :value="old('password')" required autocomplete="username"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>


            <!-- Telefone -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input id="telefone" class="block w-full" type="text" name="telefone" :value="old('telefone')" required />
                <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
            </div>

            <!-- Endereço -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="endereco" :value="__('Endereço')" />
                <x-text-input id="endereco" class="block w-full" type="text" name="endereco" :value="old('endereco')" required />
                <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
            </div>

            <!-- Número -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="numero_endereco" :value="__('Número')" />
                <x-text-input id="numero_endereco" class="block w-full" type="text" name="numero_endereco" :value="old('numero_endereco')" required />
                <x-input-error :messages="$errors->get('numero_endereco')" class="mt-2" />
            </div>

            <!-- Bairro -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="bairro" :value="__('Bairro')" />
                <x-text-input id="bairro" class="block w-full" type="text" name="bairro" :value="old('bairro')" required />
                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
            </div>

            <!-- Cidade -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="cidade" :value="__('Cidade')" />
                <x-text-input id="cidade" class="block w-full" type="text" name="cidade" :value="old('cidade')" required />
                <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
            </div>

            <!-- CEP -->
            <div class="w-full md:w-[48%]">
                <x-input-label for="cep" :value="__('CEP')" />
                <x-text-input id="cep" class="block w-full" type="text" name="cep" :value="old('cep')" required />
                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
            </div>

            <!-- Referência -->
            <div class="w-full">
                <x-input-label for="referencia" :value="__('Ponto de Referência')" />
                <x-text-input id="referencia" class="block w-full" type="text" name="referencia" :value="old('referencia')" />
                <x-input-error :messages="$errors->get('referencia')" class="mt-2" />
            </div>
        </div>

        <!-- Botão -->
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Já é registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
