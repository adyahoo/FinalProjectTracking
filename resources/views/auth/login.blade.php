<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="section-login__logo fill-current" />
                </a>
            </x-slot>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <div class="text-center">
                <x-label for="login-title" class="text-xl font-bold" :value="__('Login')"/>
            </div>
            
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />
                
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Type your email address" required autofocus />
            </div>
            
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                
                <x-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" 
                placeholder="Type your password"/>
            </div>
            
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
        </x-auth-card>
        <div class="section-login text-center">
            <button type="submit" href="/" class="section-login__btn">
                Login
            </button>
            <a href="{{ route('password.request') }}">
                <br>Forget Password?
            </a>
        </div>
    </form>
</x-guest-layout>