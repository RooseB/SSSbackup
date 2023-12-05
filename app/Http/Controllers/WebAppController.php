<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use App\Models\webapp;

use Maatwebsite\Excel\Facades\Excel;

class WebAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $webapps = webapp::with('user')->get();
        return view('welcome', ['webapps'=> $webapps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //fix this future Ben :D
        // $request->validate([
        //      'webapp'=>'required|mimes:csv, ods, xlsx'
        // ]);

        //dd($request);
        $user = Auth::user();
        //dd($user = Auth::user());
    
        $webapps = new webapp;
        $webapps->mimeType = $request->file('WebAppTable')->getMimeType();
        $webapps->originalName = $request->file('WebAppTable')->getClientOriginalName();
        $webapps->path = $request->file('WebAppTable')->store('WebAppTable');
        $webapps->user_id = $user->id;
        $webapps->save();
        return view('create',
            ['id'=>$webapps->id,
            'path'=>$webapps->path,
            'originalName'=>$webapps->originalName,
            'mimeType'=>$webapps->mimeType]
        );
    }

    /**
     * Display the specified resource.
     * @param \App\Models\webapp $webapps
     * @return \Illuminate\Http\Response
     */
    public function show(webapp $webapps, Request $request)
    {
        //
        $webapps = webapp::findorFail($webapps->id);

        //I have no clue if this will work or not...
        Excel::import(new UserImport, $webapps->originalName);

        return response()->file(storage_path().'/app/'. $webapps->path);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('edit',
        ['id'=>$webapps->id,
        'path'=>$webapps->path,
        'mimeType'=>$webapps->mimeType,
        'originalName'=>$webapps->originalName]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $webapps = WebApp::findorFail($webapps->id);
        Storage::delete($webapps -> path);
        $webapps->origName = request()->file('webapp')->getClientOriginalName();
		$webapps->path = request()->file('webapp')->store('webapps');
		$webapps->mimeType = $request->file('webapp')->getClientMimeType();
		$webapps->save();
		return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $webapps = WebApp::findOrFail($webapps->id);
        Storage::delete($webapps->path);
        $webapps->delete();
        return back()->with(['operation'=>'deleted', 'id'=>$webapps->id]);
    }
}
