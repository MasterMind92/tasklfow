<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class=" mt-4 pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-stat-card label="Membres projet" :value="15" />
            <x-stat-card label="Tâches complétées" :value="10" />
            <x-stat-card label="Tâches en cours" :value="5" />
            <x-stat-card label="Tâches en retard" :value="1" class="border-l-4 border-red-500" />
        </div>
    </div>
</div>

</x-app-layout>
