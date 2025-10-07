@if($errors->has($type ?? ''))
    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $errors->first($type ?? '') }}</p>
@endif