<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Rating::truncate();
        Book::truncate();
        Category::truncate();
        Author::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Config::set('database.connections.mysql.strict', false);
        DB::reconnect();

        $authors = Author::factory()->count(1000)->create();

        $categories = Category::factory()->count(3000)->create();

        $bookCount = 0;
        $chunkSize = 5000;

        while ($bookCount < 100000) {
            $currentChunkSize = min($chunkSize, 100000 - $bookCount);

            $books = Book::factory()
                ->count($currentChunkSize)
                ->create([
                    'author_id' => function() use ($authors) {
                        return $authors->random()->id;
                    },
                    'category_id' => function() use ($categories) {
                        return $categories->random()->id;
                    }
                ]);

            $bookCount += $currentChunkSize;
            unset($books);
        }

        $ratingCount = 0;
        $ratingChunkSize = 10000;

        $bookIds = Book::pluck('id');

        while ($ratingCount < 500000) {
            $currentChunkSize = min($ratingChunkSize, 500000 - $ratingCount);

            Rating::factory()
                ->count($currentChunkSize)
                ->create([
                    'book_id' => function() use ($bookIds) {
                        return $bookIds->random();
                    },
                    'rating' => rand(1, 10),
                    'voter_name' => function() {
                        return rand(0, 1) ? fake()->name() : null;
                    }
                ]);

            $ratingCount += $currentChunkSize;
        }

        Config::set('database.connections.mysql.strict', true);
        DB::reconnect();
    }
}
