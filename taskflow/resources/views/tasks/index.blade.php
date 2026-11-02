<x-app-layout title="Mes tâches">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Taches') }}
        </h2>
    </x-slot>

    @forelse ($tasks as $task)
        <x-task-card :task="$task" />
    @empty

    <x-content-card>
        <h1 class="text-center text-xl">Aucune tâche pour le moment.</h1>
    </x-content-card>
    
    @endforelse

    {{ $tasks->links() }} {{-- pagination --}}
</x-app-layout>