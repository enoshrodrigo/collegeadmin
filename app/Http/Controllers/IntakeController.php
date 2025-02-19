<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use Illuminate\Http\Request;

class IntakeController extends Controller
{
    // List all intakes (admin)
    public function index()
    {
        $intakes = Intake::orderBy('name')->get();
        return view('pages.intakes.index', compact('intakes'));
    }

    // Show the form to create a new intake
    public function create()
    {
        return view('pages.intakes.create');
    }

    // Store a new intake
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_enabled' => 'required|boolean',
            'date' => 'date',
        ]);

        Intake::create($validated);
        return redirect()->route('intakes.index')
            ->with('success', 'Intake created successfully.');
    }

    // Show the form to edit an intake
    public function edit(Intake $intake)
    {
        return view('pages.intakes.edit', compact('intake'));
    }

    // Update an intake
    public function update(Request $request, Intake $intake)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_enabled' => 'required|boolean',
            'date' => 'date',
        ]);

        $intake->update($validated);
        return redirect()->route('intakes.index')
            ->with('success', 'Intake updated successfully.');
    }

    // Delete an intake (optional, consider cascade delete on admissions or restrict)
    public function destroy(Intake $intake)
    {
        $intake->delete();
        return redirect()->route('intakes.index')
            ->with('success', 'Intake deleted successfully.');
    }
}
