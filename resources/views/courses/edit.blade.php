<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Cours') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('courses.update', $course->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="name" value="Nom du cours" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $course->name }}" required autofocus />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="class_id" value="Classe associée" />
                        <select name="class_id" id="class_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Sélectionner une classe --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ $course->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>Mettre à jour</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
