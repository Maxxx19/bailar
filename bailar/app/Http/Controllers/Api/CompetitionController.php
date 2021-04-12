<?php

namespace App\Http\Controllers\Api;

use App\Competition;
use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(Request $request){   
        
        $comp = Competition::with('images','dances');
        
        if ($request->has('city')) {
            $comp=$comp->where('city', $request->city);
        }
         if ($request->has('title')) {
            $comp= Competition::with('images','dances')->whereHas('dances', function ($query) use ($request) {                                         
            $query->where('title', $request->title);});
        }
        if ($request->has('date_begin')) {
            $now = date('Y-m-d');
            $comp=$comp->whereBetween('date_begin', [$request->date_begin,$now]);
        }   
        if ($request->has('date')) {
            $comp=$comp->where('date', $request->date);
        }        
        if ($request->has('limit')) {
            $comp=$comp->paginate($request->limit);
        } 
        else{
            $comp=$comp->get();
        }
        return response()->json($comp);
    }

    public function show($id)
    {
        $com = Competition::with('images','dances')->findOrFail($id);
        return response()->json($com);
        
    }
    
    public function store(Request $request)
    {
            $member=Member::create($request->user);
            $member->memberable_type = 'App\Competition';
            $member->save();
        return response()->json('$member', 201);
    }
}
