<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Intake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdmissionSubmitted;
use Carbon\Carbon;

class AdmissionController extends Controller
{
    // Publicly accessible admission form
    public function create()
    {
        // Only show intakes with registration enabled
        $activeIntakes = Intake::where('registration_enabled', true)->orderBy('name')->get();
        return view('pages.admissions.create', compact('activeIntakes'));
    }
    
    public function applynow()
    {
        $activeIntakes = Intake::where('registration_enabled', true)->orderBy('name')->get();
        return view('pages.admissions.create', compact('activeIntakes'));
    }

    // Save a new admission and send confirmation email
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nic'        => 'required|string',
            'dob'        => 'required|date',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'mobile_no'  => 'required|string|max:20',
            'intake_id'  => 'required|exists:intakes,id',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $admission = Admission::create($validated);

        // Send confirmation email
        Mail::to($admission->email)->send(new AdmissionSubmitted($admission));

        return redirect()->route('admissions.create')
            ->with('success', 'Your admission details have been submitted successfully. Please check your email for confirmation.');
    }

    // (For admin) List all admissions along with statistics
    public function index(Request $request)
    {
        // Filter admissions if an intake is selected
        $query = Admission::query();
        if ($request->filled('intake_id')) {
            $query->where('intake_id', $request->intake_id);
        }
        $admissions = $query->latest()->paginate(20);
    
        // Statistics
        $fullyFilledCount = Admission::count();
        $todayCount = Admission::whereDate('created_at', Carbon::today())->count();
        $intakeCount = Intake::count();
        $intakes = Intake::orderBy('name')->get();
    
        return view('pages.admissions.index', compact(
            'admissions',
            'fullyFilledCount',
            'todayCount',
            'intakeCount',
            'intakes'
        ));
    }
    

    // (For admin) Show details of a single admission
    public function show(Admission $admission)
    {
        return view('pages.admissions.show', compact('admission'));
    }

    // (For admin) Show the edit form
    public function edit(Admission $admission)
    {
        $activeIntakes = Intake::where('registration_enabled', true)->orderBy('name')->get();
        return view('pages.admissions.edit', compact('admission', 'activeIntakes'));
    }
    
    

    // (For admin) Update an admission
    public function update(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'nic'        => 'required|string',
            'dob'        => 'required|date',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'mobile_no'  => 'required|string|max:20',
            'intake_id'  => 'required|exists:intakes,id',
        ]);
        

        $admission->update($validated);

        return redirect()->route('admissions.index')
            ->with('success', 'Admission details updated successfully.');
    }

    // (For admin) Delete an admission
    public function destroy(Admission $admission)
    {
        $admission->delete();
        return redirect()->route('admissions.index')
            ->with('success', 'Admission details deleted successfully.');
    }
}
