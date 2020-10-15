<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <h1 style="font-size: 2rem; font-weight: bold;">econo<span style="color: #8dda06;">MEALS</span></h1> -->
            <img class="w-full" src="{{ asset('img/logo.png') }}" alt="econoMEALS Logo" style="user-drag: none; -moz-user-select: none; -webkit-user-drag: none; -webkit-user-select: none; -ms-user-select: none; pointer-events: none;">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
