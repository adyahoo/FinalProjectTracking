<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}" id="forgetForm">
        @csrf
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="section-login__logo fill-current" />
                </a>
            </x-slot>

            <div class="text-xl font-bold text-center mb-2">
                {{ __('Forget Password') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="Session::get('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    placeholder="Type your email address" required autofocus />
            </div>
        </x-auth-card>
        <div class="section-login text-center">
            <button type="submit" href="/" class="section-login__btn" id="btnSubmit">
                Submit
            </button>
            <a href="{{ route('login') }}">
                <br>Already have account?
            </a>
        </div>
    </form>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>    
</x-guest-layout>