<x-layout title="Nouvelle tâche">
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <select name="project_id">
            @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
        @error('project_id') <p class="error">{{ $message }}</p> @enderror

        <input name="title" value="{{ old('title') }}" placeholder="Titre">
        @error('title') <p class="error">{{ $message }}</p> @enderror

        <select name="status">
            @foreach (App\Enums\TaskStatus::cases() as $case)
                <option value="{{ $case->value }}">{{ $case->label() }}</option>
            @endforeach
        </select>

        <input type="date" name="due_at" value="{{ old('due_at') }}">

        <button>Créer la tâche</button>
    </form>
</x-layout>