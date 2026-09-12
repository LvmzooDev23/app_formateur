<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('attendances.index') }}" class="p-2 bg-slate-100 rounded-lg text-slate-600 hover:bg-slate-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="text-2xl font-bold text-slate-800 leading-tight">Historique des Émargements</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtres -->
            <form method="GET" action="{{ route('attendances.history') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-8 flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Classe</label>
                    <select name="class_id" class="w-full border-slate-200 rounded-xl text-sm py-2 shadow-sm">
                        <option value="">Toutes les classes</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Statut</label>
                    <select name="status" class="w-full border-slate-200 rounded-xl text-sm py-2 shadow-sm">
                        <option value="">Tous les statuts</option>
                        <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Présent</option>
                        <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Retard</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Du</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border-slate-200 rounded-xl text-sm py-2 shadow-sm">
                </div>
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Au</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border-slate-200 rounded-xl text-sm py-2 shadow-sm">
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2 rounded-xl shadow-sm transition-all">
                    Filtrer
                </button>
            </form>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-3 text-left">Date</th>
                            <th class="px-6 py-3 text-left">Étudiant</th>
                            <th class="px-6 py-3 text-left">Classe</th>
                            <th class="px-6 py-3 text-center">Statut</th>
                            <th class="px-6 py-3 text-left">Remarque</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($attendances as $attendance)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $attendance->date->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $attendance->student->first_name }} {{ $attendance->student->last_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-full border border-slate-200">{{ $attendance->student->schoolClass->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusColors = [
                                            'present' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            'absent' => 'bg-rose-100 text-rose-700 border-rose-200',
                                            'late' => 'bg-amber-100 text-amber-700 border-amber-200',
                                        ];
                                        $color = $statusColors[$attendance->status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                    @endphp
                                    <span class="{{ $color }} text-xs font-bold px-2.5 py-1 rounded-full border">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $attendance->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $attendances->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
