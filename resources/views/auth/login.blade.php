<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Bem-vindo de Volta!</h1>
        <p class="text-gray-300">Acesse sua conta para continuar.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('error'))
        <div class="bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                <i class="fas fa-envelope mr-2"></i>Email
            </label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="seu@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                <i class="fas fa-lock mr-2"></i>Senha
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 bg-white/20" name="remember">
                <span class="ml-2 text-sm text-gray-300">{{ __('Lembrar de mim') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                   href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
        </div>

        <div class="flex flex-col items-center justify-end mt-4">
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-transparent">
                <i class="fas fa-sign-in-alt mr-2"></i>{{ __('Entrar') }}
            </button>
            
            @php
                $hasUsers = \App\Models\User::count() === 0;
            @endphp
            
            @if ($hasUsers && Route::has('register'))
                 <div class="mt-6 text-center">
                    <p class="text-gray-300">
                        Não tem uma conta?
                        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium">
                           Cadastre-se
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>