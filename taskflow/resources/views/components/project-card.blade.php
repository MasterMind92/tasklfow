@props(['project'])

<article class="card pt-4">
    <x-content-card>
        <h3>{{ $project->name }}</h3>

        {{-- {{ }} échappe automatiquement le HTML : protection contre les failles XSS --}}
        <p>{{ $project->description }}</p>

        <a href="{{ route('projects.show', $project) }}" >
            <x-primary-button>
                Ouvrir
            </x-primary-button>
        </a>
    </x-content-card>
            
</article>