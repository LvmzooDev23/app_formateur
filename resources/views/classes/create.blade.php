<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une Classe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('classes.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" value="Nom de la classe" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>Enregistrer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
