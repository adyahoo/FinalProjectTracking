<x-guest-layout>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="section-login__logo fill-current" />
                </a>
            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />


            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

        </x-auth-card>
        <div class="section-login text-center">
            <button type="submit" href="/" class="section-login__btn">
                Login
            </button>
        </div>
    </form>
</x-guest-layout>