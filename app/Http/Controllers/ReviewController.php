<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {

        return view("reviews.create", compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {

        $review = Review::create([
            'review' => $request->review,
            'rating' => $request->rating,
            'book_id' => $book->id,
            'user_id' =>  Auth::id()
        ]);

        return redirect()->route('books.show', $book->id)
            ->with('success', 'Thêm đánh giá thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function myReviews()
    {
        $reviews = Review::with('book')->where('user_id', Auth::id())->latest()
            ->get();
        return view('reviews.my_review', compact('reviews'));
    }
    public function deleteMyReviews($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('reviews.my')
            ->with('success', 'Xóa thành công');
    }
}
