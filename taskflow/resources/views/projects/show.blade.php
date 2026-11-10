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


</x-app-layout>