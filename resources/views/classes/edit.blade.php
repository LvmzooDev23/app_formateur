<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la Classe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('classes.update', $class->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="name" value="Nom de la classe" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $class->name }}" required autofocus />
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>Mettre à jour</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
