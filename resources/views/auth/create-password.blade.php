<x-guest-layout>
    <form method="POST" action="{{ route('password.store', $user) }}">
        @csrf
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="section-login__logo fill-current"/>
                </a>
            </x-slot>
            
            <div class="text-xl font-bold text-center mb-2">
                {{ __('Create Password') }}
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />        
            
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                
                <x-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" 
                placeholder="Type your password"/>
                @error('password')
                    <span style="color:red">{{$message}}</span>
                @enderror
            </div>
            
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Confirm Password')" />
                
                <x-input id="password" class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required autocomplete="current-password" 
                placeholder="Type your confirm password"/>
                @error('password_confirmation')
                    <span style="color:red">{{$message}}</span>
                @enderror
            </div>
        </x-auth-card>
        <div class="section-login text-center">
            <button type="submit" class="section-login__btn">
                Submit
            </button>
        </div>
    </form>
</x-guest-layout>
