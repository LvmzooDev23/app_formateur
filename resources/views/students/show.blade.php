<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('students.index') }}" class="p-2 bg-slate-100 rounded-lg text-slate-600 hover:bg-slate-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="text-2xl font-bold text-slate-800 leading-tight">Fiche Bilan Étudiant</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profil Header -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-3xl font-bold">
                            {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-3xl font-extrabold text-slate-900">{{ $student->first_name }} {{ $student->last_name }}</h3>
                            <p class="text-slate-500 font-medium">Classe : <span class="text-indigo-600">{{ $student->schoolClass->name }}</span></p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-rose-50 border border-rose-100 p-4 rounded-2xl text-center min-w-[120px]">
                            <p class="text-xs font-semibold text-rose-500 uppercase mb-1">Absences</p>
                            <p class="text-2xl font-bold text-rose-700">{{ $absences }}</p>
                        </div>
                        <div class="bg-amber-50 border border-amber-100 p-4 rounded-2xl text-center min-w-[120px]">
                            <p class="text-xs font-semibold text-amber-500 uppercase mb-1">Retards</p>
                            <p class="text-2xl font-bold text-amber-700">{{ $retards }}</p>
                        </div>
                        <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-2xl text-center min-w-[120px]">
                            <p class="text-xs font-semibold text-indigo-500 uppercase mb-1">Moyenne</p>
                            <p class="text-2xl font-bold text-indigo-700">{{ $moyenne }} <span class="text-sm font-normal">/20</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Bilan Présences -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden h-full">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h4 class="font-bold text-slate-800">Historique Émargement</h4>
                        </div>
                        <div class="p-4 space-y-3">
                            @forelse($student->attendances->sortByDesc('date') as $attendance)
                                <div class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-slate-900">{{ $attendance->date->format('d/m/Y') }}</span>
                                        @if($attendance->note)
                                            <span class="text-xs text-slate-500 italic">{{ $attendance->note }}</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold px-2 py-1 rounded-full 
                                        {{ $attendance->status == 'present' ? 'bg-emerald-100 text-emerald-700' : ($attendance->status == 'absent' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-center text-slate-400 py-4 text-sm italic">Aucun enregistrement</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Relevé de Notes -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h4 class="font-bold text-slate-800">Relevé de Notes détaillé</h4>
                        </div>
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                                    <th class="px-6 py-3 text-left">Cours / Examen</th>
                                    <th class="px-6 py-3 text-center">Date</th>
                                    <th class="px-6 py-3 text-center">Coeff</th>
                                    <th class="px-6 py-3 text-center">Note</th>
                                    <th class="px-6 py-3 text-center">État</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($student->grades as $grade)
                                    <tr class="hover:bg-slate-50/80 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-slate-900">{{ $grade->exam->title }}</div>
                                            <div class="text-xs text-slate-500">{{ $grade->exam->course->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm text-slate-600">{{ $grade->exam->exam_date->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-center text-sm font-medium text-slate-700">{{ $grade->exam->coefficient }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="text-lg font-bold {{ $grade->score >= 10 ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $grade->score }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-2 py-1 rounded-full text-xs font-bold {{ $grade->score >= 10 ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                                {{ $grade->score >= 10 ? 'Succès' : 'Échec' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">Aucune note enregistrée pour cet étudiant.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
