<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Conquer;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConquerController extends Controller
{
    public function index(Request $request) {
        $conquer = Conquer::with('images','dances');
        
        if ($request->has('city')) {
            $conquer=$conquer->where('city', $request->city);
        }
         if ($request->has('title')) {
            $conquer= Conquer::with('images','dances')->whereHas('dances', function ($query) use ($request) {                                         
            $query->where('title', $request->title);});
        }
        if ($request->has('date_begin')) {
            $now = date('Y-m-d');
            $conquer=$conquer->whereBetween('date_begin', [$request->date_begin,$now]);
        }   
        if ($request->has('date')) {
            $conquer=$conquer->where('date', $request->date);
        }        
        if ($request->has('limit')) {
            $conquer=$conquer->paginate($request->limit);
        } 
        else{
            $conquer=$conquer->get();
        }
        return response()->json($conquer);
    }

    public function show($id) {
        $conquer = Conquer::with('images','dances')->findOrFail($id);
       
        return response()->json($conquer);
    }  
    public function store(Request $request)
    {
            $member=Member::create($request->user);
            $member->memberable_type = 'App\Conquer';
            $member->save();
        return response()->json('$member', 201);
    }
}