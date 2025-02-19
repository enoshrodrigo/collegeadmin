<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Event;
use App\Models\Admission;
use App\Models\Intake;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Summary Counts
        $totalNews = News::count();
        $totalEvents = Event::count();
        $totalAdmissions = Admission::count();
        $totalIntakes = Intake::count();
        
        // Latest News (Paginated)
        $latestNews = News::latest()->paginate(5, ['*'], 'news_page');
        
        // Upcoming Events (Paginated, assuming 'event_date' is a field on Event model)\n 
        $upcomingEvents = Event::where('created_at', '>=', Carbon::today())->orderBy('created_at', 'asc')->paginate(5, ['*'], 'events_page');
        
        // Recent Admissions (Paginated)
        $recentAdmissions = Admission::latest()->paginate(5, ['*'], 'admissions_page');
        
        // Intake Batches (Paginated, assuming 'start_date' is a field on Intake model)
        $intakeBatches = Intake::orderBy('date', 'asc')->paginate(5, ['*'], 'intakes_page');
        
        return view('dashboard', compact(
            'totalNews',
            'totalEvents',
            'totalAdmissions',
            'totalIntakes',
            'latestNews',
            'upcomingEvents',
            'recentAdmissions',
            'intakeBatches'
        ));
    }
}
