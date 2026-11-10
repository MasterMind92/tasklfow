<x-app-layout title="Projets">
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projets') }}
            </h2>

            <div>
                <x-primary-button x-data x-on:click.prevent="$dispatch('open-modal', 'add_project')">
                    Ajouter un projet
                </x-primary-button>

            </div>
        </div>
    </x-slot>

    <x-modal name="add_project" maxWidth="lg" focusable>
        <form method="POST" action="{{ route('projects.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium">Nouveau projet</h2>
            <input type="hidden" name="owner_id" value="{{Auth::id()}}">
            <x-text-input name="name" class="mt-4 block w-full" placeholder="Nom du projet"/>
            <x-text-input name="description" class="mt-4 block w-full" placeholder="Description"/>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuler
                </x-secondary-button>
                <x-primary-button type="submit">Créer</x-primary-button>
            </div>
        </form>
    </x-modal>


    <div class="mt-6 pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <x-stat-card label="Membres projet" :value="0" />
                <x-stat-card label="Tâches complétées" :value="0" />
                <x-stat-card label="Tâches en cours" :value="0" />
                <x-stat-card label="Tâches en retard" :value="0" class="border-l-4 border-red-500" />
            </div>
        </div>
    </div>

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