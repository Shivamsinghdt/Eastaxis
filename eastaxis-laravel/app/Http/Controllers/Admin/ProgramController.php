<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('sort_order')->paginate(20);

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        Program::create($this->validated($request));

        return redirect()->route('admin.programs.index')->with('status', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $program->update($this->validated($request));

        return redirect()->route('admin.programs.index')->with('status', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return back()->with('status', 'Program deleted.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['is_published'] = $request->boolean('is_published', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
