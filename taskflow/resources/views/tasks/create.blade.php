<x-app-layout title="Nouvelle tâche">

    <x-content-card>
        <form method="POST" action="{{ route('tasks.store') }}" >
            @csrf
    
            <x-select-input name="project_id">
                
                @forelse ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @empty
                    <option value="">Aucun projet existant</option>
                @endforelse
                
            </x-select-input>
            @error('project_id') <p class="error">{{ $message }}</p> @enderror
            
             <x-text-input name="title" value="{{ old('title') }}" placeholder="Titre"></x-text-input>
            @error('title') <p class="error">{{ $message }}</p> @enderror
    
            <x-select-input name="status">
                @foreach (App\Enums\TaskStatus::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </x-select-input>

            <x-text-input type="date" name="due_at" value="{{ old('due_at') }}"></x-text-input>
    
            <x-primary-button>Créer la tâche</x-primary-button>
        </form>

    </x-content-card>
</x-app-layout>