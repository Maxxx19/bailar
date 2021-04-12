<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request, $id, $event)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        
        if (!empty($keyword)) {
            $members = Member::where('name', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            if($event=='competitions'){ $memberable_type='App\Competition';}
            if($event=='conquers'){ $memberable_type='App\Conquer';}
            if($event=='masterclasses'){ $memberable_type='App\Masterclass';}
            $members = Member::where('memberable_id', $id)->where('memberable_type', $memberable_type)->latest()->paginate($perPage);
            foreach ($members as $participant) {
                if(!$participant->status){
                    $participant->status = 'new';
                    $participant->save();
            }else{
                $participant->status = 'old';
                $participant->save();
            }
           }
        }
        return view('admin.members.index', compact('members'), compact('event'));
    }
}
