<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 leading-tight">Catalogue des Cours</h2>
                <p class="text-slate-500 text-sm">Définissez les modules d'enseignement par classe.</p>
            </div>
            <a href="{{ route('courses.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nouveau Cours
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nom du Cours</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Classe Associée</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @foreach($courses as $course)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">{{ $course->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="bg-slate-100 text-slate-700 text-xs px-2.5 py-1 rounded-full font-medium">
                                        {{ $course->schoolClass->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                    <a href="{{ route('courses.edit', $course->id) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">Éditer</a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-900 transition-colors" onclick="return confirm('Supprimer ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
