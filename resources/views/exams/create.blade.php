<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 leading-tight">Créer un Examen</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                <form method="POST" action="{{ route('exams.store') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Titre de l'évaluation</label>
                        <input type="text" name="title" id="title" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required autofocus placeholder="ex: Examen Final Trimestre 1">
                    </div>
                    <div>
                        <label for="course_id" class="block text-sm font-semibold text-slate-700 mb-2">Cours associé</label>
                        <select name="course_id" id="course_id" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required>
                            <option value="">-- Sélectionner un cours --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="exam_date" class="block text-sm font-semibold text-slate-700 mb-2">Date de l'examen</label>
                            <input type="date" name="exam_date" id="exam_date" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required>
                        </div>
                        <div>
                            <label for="coefficient" class="block text-sm font-semibold text-slate-700 mb-2">Coefficient</label>
                            <input type="number" step="0.01" name="coefficient" id="coefficient" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required value="1.00">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('exams.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition-all">Annuler</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-2 text-sm">
                            Enregistrer l'examen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
