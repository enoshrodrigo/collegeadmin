<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('pages.events.index', compact('events'));
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
            'photos.*'    => 'nullable|image|max:2048',
        ]);

        $event = Event::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'link'        => $validated['link'] ?? null,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Store in a folder named for the event's ID
                $path = $photo->store("events/{$event->id}", 'public');
                EventPhoto::create([
                    'event_id' => $event->id,
                    'photo'    => $path,
                ]);
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
            'photos.*'    => 'nullable|image|max:2048',
        ]);

        $event->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'link'        => $validated['link'] ?? null,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store("events/{$event->id}", 'public');
                EventPhoto::create([
                    'event_id' => $event->id,
                    'photo'    => $path,
                ]);
            }
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    // Delete an event along with its photos
    public function destroy(Event $event)
    {
        foreach ($event->photos as $photo) {
            if (Storage::disk('public')->exists($photo->photo)) {
                Storage::disk('public')->delete($photo->photo);
            }
        }
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
    
    public function destroyPhoto(Event $event, EventPhoto $photo)
{
    // Ensure the photo belongs to the given event
    if ($photo->event_id !== $event->id) {
        abort(404);
    }

    // Delete the photo file from storage if it exists
    if (Storage::disk('public')->exists($photo->photo)) {
        Storage::disk('public')->delete($photo->photo);
    }

    // Delete the photo record from the database
    $photo->delete();

    return redirect()->back()->with('success', 'Photo deleted successfully!');
}

}
