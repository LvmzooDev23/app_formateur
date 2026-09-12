<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-800 leading-tight">Saisie des Présences</h2>
            <a href="{{ route('attendances.history') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Voir l'historique
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtres Supérieurs -->
            <form method="GET" action="{{ route('attendances.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-8 flex flex-wrap gap-6 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Classe</label>
                    <select name="class_id" class="w-full border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm">
                        <option value="">-- Sélectionner une classe --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $selectedClass == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Date</label>
                    <input type="date" name="date" value="{{ $selectedDate }}" class="w-full border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5 shadow-sm">
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-xl shadow-sm transition-all duration-200">
                    Filtrer
                </button>
            </form>

            @if($selectedClass)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <form method="POST" action="{{ route('attendances.store') }}">
                        @csrf
                        <input type="hidden" name="date" value="{{ $selectedDate }}">
                        
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                                    <th class="px-6 py-3 text-left">Étudiant</th>
                                    <th class="px-6 py-3 text-center">Statut de Présence</th>
                                    <th class="px-6 py-3 text-left">Remarque</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($students as $student)
                                    <tr class="hover:bg-slate-50/80 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $student->first_name }} {{ $student->last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex justify-center gap-3">
                                                <!-- Présent -->
                                                <label class="relative cursor-pointer group">
                                                    <input type="radio" name="attendances[{{ $student->id }}][status]" value="present" class="peer sr-only" checked>
                                                    <div class="px-4 py-1.5 rounded-full border border-emerald-200 text-emerald-700 text-xs font-semibold transition-all duration-200 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 group-hover:border-emerald-400">
                                                        Présent
                                                    </div>
                                                </label>
                                                <!-- Absent -->
                                                <label class="relative cursor-pointer group">
                                                    <input type="radio" name="attendances[{{ $student->id }}][status]" value="absent" class="peer sr-only">
                                                    <div class="px-4 py-1.5 rounded-full border border-rose-200 text-rose-700 text-xs font-semibold transition-all duration-200 peer-checked:bg-rose-500 peer-checked:text-white peer-checked:border-rose-500 group-hover:border-rose-400">
                                                        Absent
                                                    </div>
                                                </label>
                                                <!-- Retard -->
                                                <label class="relative cursor-pointer group">
                                                    <input type="radio" name="attendances[{{ $student->id }}][status]" value="late" class="peer sr-only">
                                                    <div class="px-4 py-1.5 rounded-full border border-amber-200 text-amber-700 text-xs font-semibold transition-all duration-200 peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-500 group-hover:border-amber-400">
                                                        Retard
                                                    </div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" name="attendances[{{ $student->id }}][note]" class="w-full border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-xs py-2 px-3 shadow-sm" placeholder="Ajouter une note...">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="p-6 bg-slate-50 flex justify-end">
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-md font-bold transition-all">
                                Enregistrer l'Émargement
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-slate-300">
                    <div class="mx-auto w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800">Aucune classe sélectionnée</h3>
                    <p class="text-slate-500 text-sm">Veuillez choisir une classe pour commencer l'émargement.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
