<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 leading-tight">Ajouter un Cours</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                <form method="POST" action="{{ route('courses.store') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nom du cours</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required autofocus placeholder="ex: Programmation Laravel">
                    </div>
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-2">
                            <p class="text-sm font-semibold text-slate-700">Classes rattachées</p>
                            <button type="button" id="select-all-classes" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-all">Sélectionner tout</button>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($classes as $class)
                                <label class="flex items-center gap-3 p-3 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-100 transition-all">
                                    <input type="checkbox" name="class_ids[]" value="{{ $class->id }}" class="rounded text-indigo-600 focus:ring-indigo-500 w-4 h-4" {{ in_array($class->id, (array) old('class_ids', [])) ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-slate-700">{{ $class->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('class_ids')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @foreach($errors->get('class_ids.*') as $messages)
                            @foreach($messages as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('courses.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition-all">Annuler</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-2 text-sm">
                            Enregistrer le cours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('select-all-classes').addEventListener('click', () => {
            document.querySelectorAll('input[name="class_ids[]"]').forEach((checkbox) => {
                checkbox.checked = true;
            });
        });
    </script>
</x-app-layout>
