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
     {  /* ordewr on created */
         
         /* $news = News::orderBy('created_at', 'desc')->paginate(2); */
        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        return response()->json($news);
     }

    public function index()
    {  /* ordewr on created */
        $news = News::orderBy('created_at', 'desc')->paginate(3);
        return response()->json($news);
    }

    public function show($id)
    {  /* ordewr on created */
        //get the news id and display the details if its action is more_info
        if(!$id){
            return response()->json(['error' => 'News not found'], 404); 
         }
        $news = News::where('id', $id)->where('action', 'more_info')->first();
        if(!$news || $news == null){
            return response()->json(['error' => 'News not found'], 404);
        } 
        return response($news);

    }
}
