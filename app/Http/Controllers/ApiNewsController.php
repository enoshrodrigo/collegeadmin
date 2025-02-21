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
        

       
        /* ordewr on created */
        $news = News::orderBy('created_at', 'desc')->get();
        return response()->json($news);
    }
}
