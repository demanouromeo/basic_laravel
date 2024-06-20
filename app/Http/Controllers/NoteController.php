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

        $notes = Note::query()
        ->where('user_id', request()->user()->id)
        ->orderBy("created_at","desc")
        ->paginate();
        //dd($notes);//dd means print the variable and die right now. Don't continue
        return view('note.index', ['notes' => $notes]);
        //return index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'note' => ['required', 'string']/*note is input name from the create form (Property name of the textArea)
            required means the input is required, String means the value must be a string*/
        ]);

        $data['user_id'] = $request->user()->id;
        //$data['user_id'] = 1;
        $note = Note::create($data);

        return to_route('note.show', $note)->with('my_message', 'Note was create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //return "show $id";
        //OR return 'show'.$id;
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('note.show', ['note'=> $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('note.edit', ['note'=> $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        /*
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        */
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $note->update($data);

        return to_route('note.show', $note)->with('my_message', 'Note was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //return "destroy";
        $note->delete();
        return to_route('note.index')->with('my_message', 'Note was deleted');
    }
}
