<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return view('classes.index', ['classes' => SchoolClass::all()]);
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

    public function edit(SchoolClass $schoolClass)
    {
        return view('classes.edit', ['class' => $schoolClass]);
    }

    public function update(Request $request, SchoolClass $schoolClass)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $schoolClass->update($request->only('name'));
        return redirect()->route('classes.index')->with('success', 'Classe mise à jour.');
    }

    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
        return redirect()->route('classes.index')->with('success', 'Classe supprimée.');
    }
}
