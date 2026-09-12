<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Étudiant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="first_name" value="Prénom" />
                            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" required autofocus />
                        </div>
                        <div>
                            <x-input-label for="last_name" value="Nom" />
                            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" required />
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-input-label for="class_id" value="Classe" />
                        <select name="class_id" id="class_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Sélectionner une classe --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>Enregistrer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
