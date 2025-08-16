<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Book;
use App\Models\Author;

class RatingController extends Controller
{
    public function create()
    {
        $authors = Author::with('books')->orderBy('name')->get();
        return view('ratings.create', compact('authors'));
    }

    public function getBooksByAuthor($authorId)
    {
        $books = Book::where('author_id', $authorId)
                ->orderBy('title')
                ->get()
                ->map(function($book) {
                    return [
                        'id' => $book->id,
                        'text' => $book->title
                    ];
                });
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_id' => 'required|exists:authors,id',
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|between:1,10'
        ]);

        if (!Book::where('id', $request->book_id)
                ->where('author_id', $request->author_id)
                ->exists()) {
            return back()->with('error', 'The selected book does not belong to this author.');
        }

        Rating::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Rating submitted successfully!');
    }
}
