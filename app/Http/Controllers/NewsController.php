<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
      /*   dd($request); */
        $news = News::latest()->paginate(10);
        return view('pages.news.index', compact('news'));
    }

    public function create()
    {
        return view('pages.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'image'         => 'required|image|max:2048',
            'description'   => 'required|string',
            'button_text'   => 'required|string|max:50',
            'action'        => 'required|in:link,more_info',
            'action_link'   => 'nullable|required_if:action,link|url',
            'more_info'     => 'nullable|required_if:action,more_info|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news_images', 'public');
            $validated['image'] = $path;
        }

        News::create($validated);

        return redirect()->route('news.index')->with('success', 'News created successfully!');
    }

    public function show(News $news)
    {
        return view('pages.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('pages.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'image'         => 'nullable|image|max:2048',
            'description'   => 'required|string',
            'button_text'   => 'required|string|max:50',
            'action'        => 'required|in:link,more_info',
            'action_link'   => 'nullable|required_if:action,link|url',
            'more_info'     => 'nullable|required_if:action,more_info|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $path = $request->file('image')->store('news_images', 'public');
            $validated['image'] = $path;
        }

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    public function destroy(News $news)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }
}
