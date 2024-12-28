@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-gray-100 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-red-700 dark:focus:border-red-800 focus:ring-red-700 dark:focus:ring-red-800 rounded-md shadow-sm',
]) !!}>
