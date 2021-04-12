<?php

namespace App\Http\Controllers\Api;

use App\Aboutdance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutdanceController extends Controller
{
    public function index(Request $request){   
        
        $aboutdances = Aboutdance::with('images');
        if ($request->has('limit')) {
            $aboutdances=$aboutdances->paginate($request->limit);
        } 
        else{
            $aboutdances=$aboutdances->get();
        }
        
        //
        return response()->json($aboutdances);
    }

    public function show($id)
    {
        $aboutdances = Aboutdance::with('images')->findOrFail($id);
        return response()->json($aboutdances);  
    }
    
}
