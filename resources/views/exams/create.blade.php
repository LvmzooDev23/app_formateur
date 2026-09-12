<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un Examen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('exams.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="title" value="Titre de l'examen" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="course_id" value="Cours associé" />
                        <select name="course_id" id="course_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Sélectionner un cours --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="exam_date" value="Date de l'examen" />
                            <input type="date" name="exam_date" id="exam_date" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required />
                        </div>
                        <div>
                            <x-input-label for="coefficient" value="Coefficient" />
                            <x-text-input id="coefficient" name="coefficient" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>Enregistrer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
