<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-800 leading-tight">Saisie des Notes</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">{{ session('success') }}</div>
            @endif

            <!-- Header Examen -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white p-8 rounded-2xl shadow-lg mb-8 relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-indigo-400/30 text-indigo-100 text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wider">Examen Officiel</span>
                    </div>
                    <h3 class="text-3xl font-extrabold mb-2">{{ $exam->title }}</h3>
                    <div class="flex flex-wrap gap-6 text-indigo-100 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                            {{ $exam->course->name }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-//9 5h.01M12 12h.01M12 15h.01M12 18h.01M15 12h.01M9 12h.01"></path></svg>
                            Coeff: {{ $exam->coefficient }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 5h.01M12 12h.01M12 15h.01M12 18h.01M15 12h.01M9 12h.01"></path></svg>
                            Date: {{ $exam->exam_date->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
                <!-- Decorative circle -->
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <form method="POST" action="{{ route('grades.store', $exam->id) }}">
                    @csrf
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                                <th class="px-6 py-4 text-left">Étudiant</th>
                                <th class="px-6 py-4 text-center">Note / 20</th>
                                <th class="px-6 py-4 text-center">Résultat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($students as $student)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input type="number" step="0.01" name="grades[{{ $student->id }}]" 
                                               value="{{ $grades[$student->id] ?? '' }}" 
                                               class="w-24 border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-center py-2 shadow-sm font-bold" 
                                               min="0" max="20" required>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @php $score = $grades[$student->id] ?? null; @endphp
                                        @if($score !== null)
                                            <span class="{{ $score >= 10 ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50' }} text-xs font-bold px-2 py-1 rounded-full border {{ $score >= 10 ? 'border-emerald-100' : 'border-rose-100' }}">
                                                {{ $score >= 10 ? 'Admis' : 'Ajourné' }}
                                            </span>
                                        @else
                                            <span class="text-slate-400 text-xs italic">En attente</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-6 bg-slate-50 flex justify-end border-t border-slate-100">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-md font-bold transition-all">
                            Enregistrer les Notes
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
