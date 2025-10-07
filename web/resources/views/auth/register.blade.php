<!DOCTYPE html>
<html class="h-full bg-gray-900" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layout.head />

<body class="h-full">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="text-center text-2xl/9 font-bold tracking-tight text-white">Create a new account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form action="{{ route('complete-registration') }}" method="POST" class="space-y-6">
            @csrf
            @method('POST')

            <div>
                <x-form.input-label for="email">
                    Name
                </x-form.input-label>
                <div class="mt-2">
                    <x-form.input id="name" type="name" name="name" required
                                  autocomplete="name"
                    />
                    <x-form.input-error type="name" />
                </div>
            </div>

            <div>
                <x-form.input-label for="email">
                    Email address
                </x-form.input-label>
                <div class="mt-2">
                    <x-form.input id="email" type="email" name="email"
                                  required autocomplete="email"
                    />
                    <x-form.input-error type="email" />
                </div>
            </div>

            <div>
                <x-form.input-label for="password">
                    Password
                </x-form.input-label>
                <div class="mt-2">
                    <x-form.input id="password" type="password" name="password"
                                  required autocomplete="current-password"/>
                    <x-form.input-error type="password" />
                </div>
            </div>

            <div>
                <x-form.input-label for="password_confirmation">
                    Confirm Password
                </x-form.input-label>
                <div class="mt-2">
                    <x-form.input id="password_confirmation" type="password" name="password_confirmation"
                                  required autocomplete="new-password" />
                    <x-form.input-error type="password_confirmation" />
                </div>
            </div>

            <div>
                <x-button type="submit" class="w-full">Register</x-button>
            </div>
        </form>
    </div>
</div>
</body>

</html>