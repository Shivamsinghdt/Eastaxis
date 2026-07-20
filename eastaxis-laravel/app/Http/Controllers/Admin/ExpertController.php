<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = Expert::orderBy('sort_order')->paginate(20);

        return view('admin.experts.index', compact('experts'));
    }

    public function create()
    {
        return view('admin.experts.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('experts', 'public');
        }

        Expert::create($data);

        return redirect()->route('admin.experts.index')->with('status', 'Expert added successfully.');
    }

    public function edit(Expert $expert)
    {
        return view('admin.experts.edit', compact('expert'));
    }

    public function update(Request $request, Expert $expert)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            if ($expert->photo) {
                Storage::disk('public')->delete($expert->photo);
            }
            $data['photo'] = $request->file('photo')->store('experts', 'public');
        }

        $expert->update($data);

        return redirect()->route('admin.experts.index')->with('status', 'Expert updated successfully.');
    }

    public function destroy(Expert $expert)
    {
        if ($expert->photo) {
            Storage::disk('public')->delete($expert->photo);
        }
        $expert->delete();

        return back()->with('status', 'Expert removed.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['is_published'] = $request->boolean('is_published', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
