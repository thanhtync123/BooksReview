<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $rq)
    {
        $title = $rq->input('txb_search');
        $filter = $rq->input('filter', '');
        $books = Book::when($title, fn($query, $title) => $query->title($title));
        $books = match ($filter) {
            'popular' => $books->popular(),
            'popular_last_month' => $books->popularLastMonth(),
            'popular_6_months_ago' => $books->PopularLast6Months(),
            'highest_review_last_month' => $books->highestRatedLastMonth(),
            'highest_review_6_months_ago' => $books->highestRatedLast6Months(),
            default => $books,
        };
        $books = $books
            ->withAvgRating()
            ->withReviewCount()->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['reviews.user'])
        ->orderBy('updated_at', 'desc')
        ->withReviewCount()
        ->withAvgRating()
        ->findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
