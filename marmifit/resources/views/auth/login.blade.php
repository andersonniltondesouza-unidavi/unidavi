<x-guest-layout>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex flex-col md:flex-row md:flex-wrap gap-4">
        <!-- Email Address -->
            <div class="w-full md:w-[100%]">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

        <!-- Password -->
            <div class="w-full md:w-[100%]">
                <x-input-label for="password" :value="__('Senha')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar-se de mim') }}</span>
                </label>
            </div>
            <div class="flex mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
         </div>
    </form>
</x-guest-layout>
