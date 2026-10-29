<x-app-layout title="Mes tâches">

    @forelse ($tasks as $task)
        <x-task-card :task="$task" />
    @empty

    <x-content-card>
        <h1 class="text-center text-xl">Aucune tâche pour le moment.</h1>
    </x-content-card>
    
    @endforelse

    {{ $tasks->links() }} {{-- pagination --}}
</x-app-layout>