<!DOCTYPE html>
<html class="h-full bg-gray-900" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <x-layout.head />

    <body class="h-full">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="text-center text-2xl/9 font-bold tracking-tight text-white">Sign in to your account</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')

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
                            <x-form.input id="password" type="password" name="password" required
                                          autocomplete="current-password"
                            />
                            <x-form.input-error type="password" />
                        </div>
                    </div>

                    <div>
                        <x-button type="submit" class="w-full">Sign in</x-button>
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>