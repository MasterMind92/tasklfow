<x-layout title="Mes tâches">
    @forelse ($tasks as $task)
        <x-task-card :task="$task" />
    @empty
        <p>Aucune tâche pour le moment.</p>
    @endforelse

    {{ $tasks->links() }} {{-- pagination --}}
</x-layout>