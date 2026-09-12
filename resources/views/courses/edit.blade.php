<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 leading-tight">Modifier le Cours</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                <form method="POST" action="{{ route('courses.update', $course->id) }}" class="space-y-6">
                    @csrf @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nom du cours</label>
                        <input type="text" name="name" id="name" value="{{ $course->name }}" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required autofocus>
                    </div>
                    <div>
                        <label for="class_id" class="block text-sm font-semibold text-slate-700 mb-2">Classe rattachée</label>
                        <select name="class_id" id="class_id" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required>
                            <option value="">-- Sélectionner une classe --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ $course->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('courses.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition-all">Annuler</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-2 text-sm">
                            Mettre à jour le cours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
