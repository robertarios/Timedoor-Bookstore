<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Book::with(['author', 'category'])
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->orderByDesc('ratings_avg_rating');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhereHas('author', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
            });
        }
        $books = $query->paginate($perPage);

        return view('books.index', compact('books'));
    }
}
