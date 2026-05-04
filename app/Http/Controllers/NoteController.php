<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = auth()->user()->notes();
        // return view('dashboard', compact('notes'));
        return view('dashboard')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //$this->validate($request, [
        //    'title' => 'required',
        //    'description' => 'required'
        //]);
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = auth()->user()->id;
        $note->save();
        return redirect('/dashboard'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Add a newly created resource in storage.
     */
    public function add()
    {
        return view('add');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if (auth()->user()->id == $note->user_id)
        {            
                return view('edit', compact('note'));
        }           
        else {
             return redirect('/dashboard');
         }                
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //$this->validate($request, [
        //    'title' => 'required',
        //    'description' => 'required'
        //]);
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();
        return redirect('/dashboard'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect('/dashboard');
        // return redirect('/dashboard')->with('success', 'Note deleted successfully');

    }
}