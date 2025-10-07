@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => 'px-3 py-2 text-xs text-center rounded-md bg-indigo-500 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'px-3 py-2 text-xs text-center rounded-md bg-indigo-500 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500']) }}
    >
        {{ $slot }}
    </button>
@endif