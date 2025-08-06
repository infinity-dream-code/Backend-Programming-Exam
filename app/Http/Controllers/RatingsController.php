<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;

class RatingsController extends Controller
{

public function create()
{
    $authors = Author::limit(1000)->get();
    return view('ratings.create', compact('authors'));
}

public function getBooksByAuthor($authorId)
{
    $books = Book::where('author_id', $authorId)->get();
    return response()->json($books);
}

public function store(Request $request)
{
    $request->validate([
        'author_id' => 'required|exists:authors,id',
        'book_id' => 'required|exists:books,id',
        'rating' => 'required|integer|min:1|max:10',
    ]);

    Rating::create([
        'author_id' => $request->author_id,
        'book_id' => $request->book_id,
        'rating' => $request->rating,
    ]);

    return redirect()->route('books.index')->with('success', 'Rating berhasil disimpan!');
}
}