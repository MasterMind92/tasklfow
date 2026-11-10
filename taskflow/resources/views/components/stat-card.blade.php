@props(['label', 'value' => 0])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6']) }}>
    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
        {{ $label }}
    </h3>
    <p class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">
        {{ $value }}
    </p>
</div>
