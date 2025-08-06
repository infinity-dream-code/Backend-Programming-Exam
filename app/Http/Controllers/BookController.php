<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    
public function index(Request $request)
{
    $perPage = (int) $request->input('per_page', 10);
    $search = $request->input('search');

    $books = Book::with(['author:id,name', 'category:id,name'])
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('author', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->orderByDesc('avg_rating') 
        ->paginate($perPage)
        ->appends(compact('perPage', 'search'));

    return view('books.index', compact('books', 'perPage', 'search'));
}

}
