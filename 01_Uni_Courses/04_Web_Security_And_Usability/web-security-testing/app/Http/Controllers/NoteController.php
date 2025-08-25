<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notes = Note::all();
        return view('notes.create', ['notes' => $notes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note = Note::create($validated);

        return redirect()->route('notes.create')->with('success', 'Note successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('notes.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note->title = $validated['title'];
        $note->content = $validated['content'];

        $note->save();

        return redirect()->route('notes.create')->with('success', 'Note successfully updated');
    }

    public function delete(Note $note)
    {
        return view('notes.delete', ['note' => $note]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.create')->with('success', 'Note successfully deleted');
    }
}
