<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 leading-tight">Modifier la Classe</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
                <form method="POST" action="{{ route('classes.update', $class->id) }}" class="space-y-6">
                    @csrf @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nom de la classe</label>
                        <input type="text" name="name" id="name" value="{{ $class->name }}" class="w-full border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm" required autofocus>
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('classes.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition-all">Annuler</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-2 text-sm">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
