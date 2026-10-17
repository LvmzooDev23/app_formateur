<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::withCount(['students', 'courses'])->latest()->get();

        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        SchoolClass::create($request->only('name'));

        return redirect()->route('classes.index')->with('success', 'Classe créée.');
    }

    public function edit($id)
    {
        $class = SchoolClass::findOrFail($id);

        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = SchoolClass::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);
        $class->update($request->only('name'));

        return redirect()->route('classes.index')->with('success', 'Classe mise à jour.');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Classe supprimée.');
    }
}
