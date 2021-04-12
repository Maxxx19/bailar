<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PartiesContorller extends Controller
{
    public function index(Request $request){   
        
        $party = Party::with('images','dances');     
        
        if ($request->has('city')) {
            $party=$party->where('city', $request->city);
        }
        if ($request->has('title')) {
            $party= Party::with('images','dances')->whereHas('dances', function ($query) use ($request) {                                         
            $query->where('title', $request->title);});
        }
        if ($request->has('date_begin')) {
            $now = date('Y-m-d');
            $party=$party->whereBetween('date_begin', [$request->date_begin,$now]);
        }   
        if ($request->has('date')) {
            $party=$party->where('date', $request->date);
        }  
        if ($request->has('limit')) {
            $party=$party->paginate($request->limit);
        }     
        else{
            $party=$party->get();
        }
        return response()->json($party);
    }

    public function show($id) {
        $party = Party::with('images','dances')->findOrFail($id);
       
        return response()->json($party);
    }   
}