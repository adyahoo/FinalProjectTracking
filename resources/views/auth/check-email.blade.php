<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="section-login__logo fill-current" />
            </a>
        </x-slot>

        <div class="text-xl font-bold text-center mx-2">
            Please Check Your Email To Reset Your Password
        </div>
    </x-auth-card>
    <div class="section-login text-center">
        <a href="{{ route('login') }}">
            <br>Already have an account?
        </a>
    </div>
</x-guest-layout>