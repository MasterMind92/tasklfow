<x-app-layout title="Mes tâches">

    @forelse ($project as $task)
        <x-task-card :task="$task" />
    @empty

    <x-content-card>
        <h1 class="text-center text-xl">Aucune projets pour le moment.</h1>
    </x-content-card>
    
    @endforelse

    {{ $project->links() }} {{-- pagination --}}
</x-app-layout>