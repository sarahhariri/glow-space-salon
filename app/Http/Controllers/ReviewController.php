<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
        public function reviews(){
    $reviews = Review::latest()->get();
    return view('admin.reviews', compact('reviews'));
}
    public function saveReview(Request $request){
        $fields = $request->validate([
           
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);
        $alreadyReviewed = Review::where('user_id', Auth::id())->exists();
        if($alreadyReviewed){
                return redirect()->back()->with('error', 'You have already submitted a review');
        }
        Review::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'rating' => $fields['rating'],
            'comment' => $fields['comment'],
            'is_approved' => false,

        ]);
      
            return redirect()->back()->with('success', 'Thank you! Your review was submitted and is waiting for approval');
    }

public function approveReview(Review $review){
    $review->update([
        'is_approved' => true,
    ]);
     return redirect()->back()->with('success', 'Review approved Succesfully');
}
public function deleteReview($id){
    $review = Review::findOrFail($id);
    $review->delete();
     return redirect()->back()->with('success', 'Review deleted Succesfully');
}
}
