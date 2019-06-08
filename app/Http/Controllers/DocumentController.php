<?php

namespace App\Http\Controllers;

use App\Document;
use App\Repository;
use App\User;
use App\State;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Caffeinated\Shinobi\Traits;
use Caffeinated\Shinobi\Models\Role;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(User $user)
    {
        $user_documents = $user->documents()->get();
        $name = Auth::user()->roles()->get();
        $templates = Repository::where('delete', '=', 0)->get();
        $documents_to_assign = Auth::user()->documents()->get();
        $states = State::all();

        return view('documents.index', compact('user', 'user_documents', 'name', 'templates', 'documents_to_assign', 'states' ));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index_user_basic(User $user)
    {
        $user_documents = Auth::user()->documents()->get();

        return view('documents.index_user_basic', compact('user', 'user_documents'));
    }


    /**
     * Store a checked resource in storage.
     * 
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_assign(Request $request, User $user)
    {
        $templates = $request->get('templates');
        $documents = $request->get('documents_to_assign');
        if($templates != null){
            foreach ($templates as $template) {
                $document = Repository::find($template);
                $old_path = $document->uri;
                $new_path = $document->uri . time() . $user->id . ".pdf";
                Storage::copy($old_path, $new_path);
                $record = Document::create([
                    'filename' => $document->filename,
                    'uri' => $new_path,
                ]);
    
                $user->documents()->toggle($record->id);
                //probar con attach en vez de toggle o 
                //con sync poniendo como segundo parámetro false para que no borre los anteriores
                //ejemplo $user->roles()->sync([1,2,3], false);
                //tener en cuenta si al volver a asignar algún documento ya asignado se le desasigna como pasa con toggle
            }

            return back()->with('status', 'Assigned documents');
        }
        elseif($documents != null){
            foreach ($documents as $document) {
                $document = Document::find($document);
                $old_path = $document->uri;
                $new_path = $document->uri . time() . $user->id . ".pdf";
                Storage::copy($old_path, $new_path);
                $record = Document::create([
                    'filename' => $document->filename,
                    'uri' => $new_path,
                ]);
    
                $user->documents()->toggle($record->id);
            }

            return back()->with('status', 'Assigned documents');           
        }

        return back();
    }

    /**
     * Store a checked document state.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function state_assign(Request $request, $id)
    {        
        $document = Document::find($id);
        $document->state_id = request('state_id');
        $document->save();

        return back();
    }

    /**
     * Show the form for uploading a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(User $user)
    {
        return view('documents.upload', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
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
            $record = Document::create([
                'filename' => $file->getClientOriginalName(),
                'uri' => $file->store('public'),
            ]);

            $user->documents()->toggle($record->id);            
        }

        return back()->with('status', 'Documents Uploaded');
    }

    /**
     * Download the specified resource.
     *
     * @param  \App\Document  $id
     * @return \Illuminate\Http\Response
     */
    public function download ($document_id)
    {
        $download = Document::find($document_id);

        return Storage::download($download->uri, $download->filename);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        Storage::delete($document->uri);
        $document->uri = Null;
        $document->delete = '1';
        $document->save();

        return back()->with('status', 'Document deleted');
    }
}
