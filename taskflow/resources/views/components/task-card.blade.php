@props(['task'])

<article class="card py-12">
    <x-content-card>
        <h3>{{ $task->title }}</h3>

        {{-- {{ }} échappe automatiquement le HTML : protection contre les failles XSS --}}
        <p>{{ $task->description }}</p>

        @if ($task->due_at?->isPast())
            <span class="badge badge--late">En retard</span>
        @endif

        <a href="{{ route('tasks.show', $task) }}" >
            <x-button>
                Ouvrir
            </x-button>
        </a>
    </x-content-card>
            
</article>