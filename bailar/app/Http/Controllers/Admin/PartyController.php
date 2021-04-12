<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Party;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Dance;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $id=AdminHomeController::chooseSchool();
        
        if (!empty($keyword)) {
            $party = Party::where('title', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $party = Party::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }

        return view('admin.parties.index', compact('party'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $dances = Dance::all();
        return view('admin.parties.create', compact('dances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $request->validate(Party::$VALIDATION_RULES);
        $id=AdminHomeController::chooseSchool();
        $party = Party::create($request->all());
        $party->school_id=$id;
        $party->save();
        $party->storeImage($request);
        $party->dances()->sync($request->dance_style); 
        return redirect('admin/parties')->with('flash_message', 'party added!');
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show($id)
    {
        $party = Party::findOrFail($id);
        
        return view('admin.parties.show', compact(['party', 'dances']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit($id)
    {
        $party = Party::findOrFail($id);
        $dances = Dance::all();
        return view('admin.parties.edit', compact(['party', 'dances']));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, Party $party)
    {
        $request->validate(Party::$VALIDATION_RULES);
        $party_path = $party->images()->get(['path'])->first();
        if(!$party_path==null){
            $party->update($request->all());
        }else{
            $image1=null;
            $party->update($request->all());
        }
        $party->storeImage($request);
        $party->dances()->sync($request->dance_style);
        return redirect('admin/parties')->with('flash_message', 'Party updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Party $party)
    {
        $party->deleteImage();
        $party->dances()->detach();
        $party->delete();

        return redirect('admin/parties')->with('flash_message', 'Conquer deleted!');
    }
}
