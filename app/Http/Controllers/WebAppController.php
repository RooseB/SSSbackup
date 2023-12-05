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
        return view('uploads', ['webapps'=> $webapps]);
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
        //      $request =>'file|mimetypes:text/csv, application/vnd.oasis.opendocument.spreadsheet, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/excel',
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
        //Excel::import(new UserImport, $webapps->originalName);

        return response()->file(storage_path().'/app/'. $webapps->path);  
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\webapp $webapps
     * @return \Illuminate\Http\Response
     */
    public function change($id)
    {
        //dd($id);
        try{
            $webapps = webapp::findOrFail($id);
            //dd($$webapps = webapp::findOrFail($webapps));
        }catch(ModelNotFoundException $e){
           
            return abort(404);
        }
        //
        return view('edit',
        ['id'=>$webapps->id,
        'path'=>$webapps->path,
        'mimeType'=>$webapps->mimeType,
        'originalName'=>$webapps->originalName]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\webapp  $webapps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request);
        try{
            $webapps = webapp::findOrFail($id);
            //dd($$webapps = webapp::findOrFail($webapps));
        }catch(ModelNotFoundException $e){
           
            return abort(404);
        }

        //Storage::delete($webapps -> path);
        //dd($webapps);
        $webapps->originalName = request()->file('WebAppTable')->getClientOriginalName();
		$webapps->path = request()->file('WebAppTable')->store('webapps');
		$webapps->mimeType = $request->file('WebAppTable')->getClientMimeType();
		$webapps->save();
		return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\webapp $webapps
     * @return \Iluminate\Http\Response
     */
    public function decimate($id)
    {
        //
        //dd($webapp);
    
        //this line is causing it to fail
        try{
            $deleteWebapp = webapp::findOrFail($id);
            //dd($deleteWebapp = webapp::findOrFail($webapp));
        }catch(ModelNotFoundException $e){
           
            return abort(404);
        }
        
         
        Storage::delete($deleteWebapp->path);
        $deleteWebapp->delete();
        return to_route('dashboard');
    }
}
