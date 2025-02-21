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

    public function show($id)
    {
        
        if(!$id){
            return response()->json(['error' => 'News not found'], 404); 
         }

         $event = Event::find($id);
         if(!$event){
             return response()->json(['error' => 'Event not found'], 404);
         } 
 
         $eventData = [
             'id' => $event->id,
             'title' => $event->title,
             'description' => $event->description,
             'link' => $event->link,
             'date' => $event->date,
             'photos' => $event->photos, // Include the full photos array
         ];

        return response()->json($eventData);
    }
}
