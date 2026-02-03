<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        return Book::whereHas('author', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->with('author')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_id'   => 'required|exists:authors,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Ensure the author belongs to the authenticated user
        $author = $request->user()
            ->authors()
            ->findOrFail($validated['author_id']);

        return $author->books()->create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);
    }

    public function show(Request $request, $id)
    {
        return Book::whereHas('author', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->with('author')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $book = Book::whereHas('author', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book->update($validated);
        return $book;
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::whereHas('author', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->findOrFail($id);

        $book->delete();

        return response()->json(['message' => 'Book deleted']);
    }
}
