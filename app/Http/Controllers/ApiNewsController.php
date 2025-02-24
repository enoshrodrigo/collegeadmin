<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class ApiNewsController extends Controller
{
    /**
     * Return all news in JSON format.
     */

    public function home()
    {
        // Get the latest 3 news items with status 1
        $news = News::where('status', 1)->orderBy('date', 'desc')->take(3)->get();
        return response()->json($news);
    }

    public function index()
    {
        // Get paginated news items with status 1
        $news = News::where('status', 1)->orderBy('date', 'desc')->paginate(9);
        return response()->json($news);
    }

    public function show($id)
    {
        // Get the news item by id with status 1 and action 'more_info'
        if (!$id) {
            return response()->json(['error' => 'News not found'], 404);
        }
        $news = News::where('id', $id)->where('status', 1)->where('action', 'more_info')->first();
        if (!$news) {
            return response()->json(['error' => 'News not found'], 404);
        }
        return response()->json($news);
    }
}