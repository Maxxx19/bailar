<?php

namespace App\Http\Controllers\Api;

use App\Masterclass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;

class MasterclassController extends Controller
{
    public function index(Request $request){   
        
            $masterclass = Masterclass::with('images');
        
        if ($request->has('title')) {
            $masterclass=$masterclass->where('title', $request->title);
        }
        if ($request->has('city')) {
            $masterclass=$masterclass->where('city', $request->city);
        }
        if ($request->has('date_begin')) {
            $now = date('Y-m-d');
            $masterclass=$masterclass->whereBetween('date_begin', [$request->date_begin,$now]);
        }   
        if ($request->has('price')) {
            $masterclass=$masterclass->where('price', $request->price);
        }        
        if ($request->has('limit')) {
            $masterclass=$masterclass->paginate($request->limit);
        } 
        else{
            $masterclass=$masterclass->get();
        }
        return response()->json($masterclass);
    }

    public function show($id)
    {
            $masterclass = Masterclass::with('images')->findOrFail($id);
        return response()->json($masterclass);
        
    }
    public function store(Request $request)
    {
            $member=Member::create($request->user);
            $member->memberable_type = 'App\Masterclass';
            $member->save();
        return response()->json('$member', 201);
    }
}
