<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class ApiNewsController extends Controller
{
    /**
     * Return all news in JSON format.
     */
    public function index()
    {
        

        $news = News::all();
        return response()->json($news);
    }
}
