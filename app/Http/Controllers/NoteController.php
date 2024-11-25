<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->get();
        return view('notes', compact('notes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:trabajo,personal,ideas'
        ]);

        Note::create($validated);

        return redirect()->back()->with('success', 'Nota creada exitosamente');
    }

    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:trabajo,personal,ideas'
        ]);

        $note->update($validated);

        return redirect()->back()->with('success', 'Nota actualizada exitosamente');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->back()->with('success', 'Nota eliminada exitosamente');
    }

    public function toggleFavorite(Note $note)
    {
        $note->update(['is_favorite' => !$note->is_favorite]);
        return response()->json(['is_favorite' => $note->is_favorite]);
    }

    public function getByCategory($category)
    {
        $notes = Note::where('category', $category)->latest()->get();
        return response()->json($notes);
    }

    public function getFavorites()
    {
        $notes = Note::where('is_favorite', true)->latest()->get();
        return response()->json($notes);
    }
}
