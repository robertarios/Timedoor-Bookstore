<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
public function topAuthors()
{
    $authors = Author::query()
        ->withCount(['ratings' => function($query) {
            $query->where('rating', '>', 5);
        }])
        ->withAvg(['ratings' => function($query) {
            $query->where('rating', '>', 5);
        }], 'rating')
        ->having('ratings_count', '>', 0)
        ->orderByDesc('ratings_count')
        ->limit(10)
        ->get()
        ->each(function ($author) {
            $author->voter = fake()->numberBetween(1, 1000);
            $author->formatted_avg_rating = number_format($author->ratings_avg_rating, 2, ',', '');
        })
        ->sortByDesc('voter');

    return view('authors.top', ['authors' => $authors->values()]);
}
}
