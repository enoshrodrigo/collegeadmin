<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ApiEventsController extends Controller
{
    //
    public function index()
    {
        

        $events = Event::orderBy('created_at', 'desc')->paginate(9); 
        $events->getCollection()->transform(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
              /*   'date' => $event->date, */
                'photo' => $event->photos[0]['photo'] ?? null, // Get the first photo or null if no photos
            ];
        });

        return response()->json($events);
    }
}
