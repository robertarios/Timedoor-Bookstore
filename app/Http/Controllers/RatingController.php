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
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|between:1,10'
        ]);

        $book = Book::findOrFail($request->book_id);

        Rating::create([
            'book_id' => $validated['book_id'],
            'rating' => $validated['rating']
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Rating submitted successfully!');
    }
}
