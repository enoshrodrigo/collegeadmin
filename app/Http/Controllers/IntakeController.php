<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use Illuminate\Http\Request;

class IntakeController extends Controller
{
    // List all intakes (admin) with pagination
    public function index(Request $request)
    {
        // Filter intakes based on the provided filters
        $query = Intake::query();
    
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        if ($request->filled('status')) {
            $query->where('registration_enabled', $request->status);
        }
    
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
    
        $intakes = $query->orderBy('name')->paginate(10);
    
        // Statistics
        $totalIntakes = Intake::count();
        $activeIntakes = Intake::where('registration_enabled', true)->count();
        $inactiveIntakes = Intake::where('registration_enabled', false)->count();
    
        return view('pages.intakes.index', compact(
            'intakes',
            'totalIntakes',
            'activeIntakes',
            'inactiveIntakes'
        ));
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
            'date' => 'nullable|date',
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
            'date' => 'nullable|date',
        ]);

        $intake->update($validated);
        return redirect()->route('intakes.index')
            ->with('success', 'Intake updated successfully.');
    }
 
  // Delete an intake (optional, consider cascade delete on admissions or restrict)
public function destroy(Intake $intake)
{
    // Check if there are any admissions associated with this intake
    if ($intake->admissions()->exists()) {
        return redirect()->route('intakes.index')
            ->with('error', 'Intake cannot be deleted because there are admissions associated with it.');
    }

    $intake->delete();
    return redirect()->route('intakes.index')
        ->with('success', 'Intake deleted successfully.');
}

}
