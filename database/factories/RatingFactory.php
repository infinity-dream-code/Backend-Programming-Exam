<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rating;
use App\Models\Book;

class RatingFactory extends Factory {
    protected $model = Rating::class;
    
    public function definition() {
        return [
            'book_id' => Book::factory(),
            'rating' => $this->faker->numberBetween(1, 10)
        ];
    }
}