<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->user()
            ->authors()
            ->with('books')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000'
        ]);

        return $request->user()->authors()->create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        return $request->user()
            ->authors()
            ->with('books')
            ->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = $request->user()->authors()->findOrFail($id);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000'
        ]);

        $author->update($validated);
        return $author;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $request->user()->authors()->findOrFail($id)->delete();
        return response()->json(['message' => 'Author deleted']);
    }
}
