<?php

namespace App\Http\Controllers;

use App\Repository;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Repository::paginate(20);

        return view('repositories.index', compact('templates'));
    }

    /**
     * Show the form for uploading a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return view('repositories.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file.*' => 'required|file|mimes:pdf|max:20000'
        ],[
            'file.*.max' => 'Maximum size of each file is 20MB'
        ]);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $files = $request->file('file');
        foreach ($files as $file) {
            Repository::create([
                'filename' => $file->getClientOriginalName(),
                'uri' => $file->store('public'),
            ]);    
        }

        return back()->with('status', 'Documents Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repository  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $download = Repository::find($id);

        return Storage::download($download->uri, $download->filename);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Repository::find($id);
        Storage::delete($template->uri);
        $template->uri = Null;
        $template->delete = '1';
        $template->save();

        return back()->with('status', 'Document deleted');
    }
}
