<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ApiEventsController extends Controller
{
    //
    public function index()
    {
        

        $events = Event::all(); 
        $events = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'date' => $event->date,
                'photos' => $event->photos,
            ];
        });

        return response()->json($events);
    }
}
