<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function index(Request $request){   
        
        $news = News::with('images');
        if ($request->has('limit')) {
            $news=$news->paginate($request->limit);
        } 
        else{
            $news=$news->get();
        }
        return response()->json($news);
    }

    public function show($id) {
        $news = News::with('images')->findOrFail($id);
       
        return response()->json($news);
    }   
}