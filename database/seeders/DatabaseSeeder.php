<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
   public function run(): void
{
    $authors = Author::factory(1000)->create();
    $categories = Category::factory(3000)->create();

    $books = Book::factory(100000)->create([
        'author_id' => fn() => $authors->random()->id,
        'category_id' => fn() => $categories->random()->id,
    ]);

    Rating::factory(500000)->create([
        'book_id' => fn() => $books->random()->id,
    ]);

    $avgRatings = \App\Models\Rating::selectRaw('book_id, AVG(rating) as avg_rating')
        ->groupBy('book_id')
        ->get();

    foreach ($avgRatings as $item) {
        \App\Models\Book::where('id', $item->book_id)->update([
            'avg_rating' => $item->avg_rating
        ]);
    }
}

}
