<textarea
       {{ $attributes->merge([
            'class' => 'block p-2.5 w-full text-sm rounded-lg border  bg-white/5 border-gray-600 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500',
            'rows' => 8,
        ]) }}
>{{ $slot }}</textarea>