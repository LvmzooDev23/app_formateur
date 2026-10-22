<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <a href="{{ route('classes.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-all">← Retour aux classes</a>
                <h2 class="mt-2 text-2xl font-bold text-slate-900 leading-tight">{{ $class->name }}</h2>
                <p class="text-slate-500 text-sm">{{ $class->students->count() }} étudiant(s) inscrit(s)</p>
            </div>
            <a href="{{ route('students.create', ['class_id' => $class->id]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-2 text-sm">
                + Ajouter un étudiant
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <p class="text-sm font-medium text-slate-500">Étudiants inscrits</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $class->students->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <p class="text-sm font-medium text-slate-500">Cours associés</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $class->courses->count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900">Étudiants de la classe</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/80">
                            <tr class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                                <th class="px-6 py-3.5 text-left">Nom &amp; Prénom</th>
                                <th class="px-6 py-3.5 text-left">Date d'inscription</th>
                                <th class="px-6 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($class->students as $student)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">{{ $student->last_name }} {{ $student->first_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $student->created_at?->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <a href="{{ route('students.show', $student) }}" class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-all">Fiche / Bilan</a>
                                        <a href="{{ route('students.edit', $student) }}" class="bg-slate-100 text-slate-700 px-3 py-1.5 rounded-lg hover:bg-slate-200 transition-all">Éditer</a>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-rose-50 text-rose-600 px-3 py-1.5 rounded-lg hover:bg-rose-100 transition-all" onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-500">Aucun étudiant inscrit dans cette classe</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
