<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
 public function index()
{
    $topAuthors = DB::table('authors')
        ->select([
            'authors.id', 
            'authors.name',
            DB::raw('(
                SELECT COUNT(*)
                FROM ratings 
                JOIN books ON ratings.book_id = books.id 
                WHERE books.author_id = authors.id 
                AND ratings.rating > 5
            ) as total_votes')
        ])
        ->havingRaw('total_votes > 0')
        ->orderByDesc('total_votes')
        ->limit(10)
        ->get();

    return view('books.top-author', compact('topAuthors'));
}
}
