<?php

namespace App\Http\Controllers\Admin;

use App\Aboutdance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutdanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $aboutdances = Aboutdance::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aboutdances = Aboutdance::paginate($perPage);
        }

        return view('admin.aboutdances.index', compact('aboutdances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aboutdances = Aboutdance::all();
        return view('admin.aboutdances.create', compact('aboutdances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Aboutdance::$VALIDATION_RULES); 
        $aboutdances=Aboutdance::create($request->all());
        $aboutdances->save();
        $aboutdances->storeImage($request);
        return redirect('admin/aboutdances')->with('flash_message', 'Aboutdances added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aboutdance  $aboutdances
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aboutdances = Aboutdance::findOrFail($id);
               
        return view('admin.aboutdances.show', compact('aboutdances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aboutdance  $aboutdances
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aboutdances = Aboutdance::findOrFail($id);
        return view('admin.aboutdances.edit', compact('aboutdances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aboutdance  $aboutdances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aboutdances= Aboutdance::findOrFail($id);
        $request->validate(Aboutdance::$VALIDATION_RULES);
        $aboutdances_path = $aboutdances->images()->get(['path'])->first();
       
        if(!$aboutdances_path==null){
            $aboutdances->update($request->all());

        }else{
            $image1=null;
            $aboutdances->update($request->all());
        }
       
        $aboutdances->storeImage($request);  
          //dd($request);
        return redirect('admin/aboutdances')->with('flash_message', 'Aboutdances updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aboutdance  $aboutdances
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aboutdances = Aboutdance::findOrFail($id);
        if($aboutdances->images()){
            //dd($aboutdances);
            
            $aboutdances->deleteImage();
        }
         
        Aboutdance::destroy($id);

        return redirect('admin/aboutdances')->with('flash_message', 'Aboutdances deleted!');
    }
}
