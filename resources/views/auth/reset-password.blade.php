<x-guest-layout>
    {{-- パンくず --}}
    <nav class="mb-6 text-sm" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-1 text-gray-500">
            <li>
                <a href="{{ route('shops.index') }}" class="hover:text-gray-700">ホーム</a>
            </li>
            <li class="text-gray-400">/</li>
            <li>
                <a href="{{ route('login') }}" class="hover:text-gray-700">ログイン</a>
            </li>
            <li class="text-gray-400">/</li>
            <li class="text-gray-900 font-medium" aria-current="page">
                パスワード再設定
            </li>
        </ol>
    </nav>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
