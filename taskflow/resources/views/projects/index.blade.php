<x-app-layout title="Mes tâches">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projets') }}
        </h2>
    </x-slot>

    @forelse ($project as $projekt)
        <x-task-card :task="$projekt" />
    @empty

    <x-content-card>
        <h1 class="text-center text-xl">Aucun projets pour le moment.</h1>
    </x-content-card>
    
    @endforelse

    {{-- {{ $project->links() }} --}}
     {{-- pagination --}}
</x-app-layout>