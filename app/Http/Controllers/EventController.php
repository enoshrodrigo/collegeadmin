<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::latest()->paginate(9);
        $totalEvents = Event::count();
        $activeEvents = Event::where('status', 1)->count();
        $inactiveEvents = Event::where('status', 0)->count();
        return view('pages.events.index', compact('events',
            'totalEvents', 'activeEvents', 'inactiveEvents'));
    }

    // Show form for creating an event
    public function create()
    {
        return view('pages.events.create');
    }

    // Store new event with photos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'link'        => 'nullable|url',
            'status'      => 'required|string',
            'photos'      => 'nullable|array', // Ensure photos is an array
            'photos.*'    => 'nullable|image|max:2048',
            'date'        => 'nullable|date',
        ]);

        $event = Event::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'link'        => $validated['link'] ?? null,
            'status'      => $validated['status'],
            'date'        => $validated['date'] ?? now(),
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    // Set destination path in storage/events/{event_id}
                    $destinationPath = storage_path("events/{$event->id}");
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $filename = time() . '_' . $photo->getClientOriginalName();
                    $photo->move($destinationPath, $filename);
                    $path = "events/{$event->id}/{$filename}";
                    
                    EventPhoto::create([
                        'event_id' => $event->id,
                        'photo'    => $path,
                    ]);
                }
            }
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    // Show event details (with all photos)
    public function show(Event $event)
    {
        $event->load('photos');
        return view('pages.events.show', compact('event'));
    }

    // Show form for editing an event
    public function edit(Event $event)
    {
        $event->load('photos');
        return view('pages.events.edit', compact('event'));
    }

    // Update an event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'link'        => 'nullable|url',
            'status'      => 'required|string',
            'photos'      => 'nullable|array',
            'photos.*'    => 'nullable|image|max:2048',
            'date'        => 'nullable|date',
        ]);
 
        $event->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'link'        => $validated['link'] ?? null,
            'status'      => $validated['status'],
            'date'        => $validated['date'] ?? now(),
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $destinationPath = storage_path("events/{$event->id}");
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $filename = time() . '_' . $photo->getClientOriginalName();
                    $photo->move($destinationPath, $filename);
                    $path = "events/{$event->id}/{$filename}";
                    
                    EventPhoto::create([
                        'event_id' => $event->id,
                        'photo'    => $path,
                    ]);
                }
            }
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    // Delete an event along with its photos
    public function destroy(Event $event)
    {
        foreach ($event->photos as $photo) {
            $photoPath = storage_path($photo->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
            $photo->delete();
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    // Delete a single photo
    public function destroyPhoto(Event $event, EventPhoto $photo)
    {
        if ($photo->event_id !== $event->id) {
            abort(404);
        }

        $photoPath = storage_path($photo->photo);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }

        $photo->delete();

        return redirect()->back()->with('success', 'Photo deleted successfully!');
    }
}
