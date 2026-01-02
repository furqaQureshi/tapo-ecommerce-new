<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'remarks' => 'required|string|max:1000',
        ]);

        // Check if user has purchased the product
        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->whereHas('items', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', __('lang.purchase_required_to_review'));
        }

        // Check if user has already reviewed this product
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($existingReview) {
            return redirect()->back()->with('error', __('lang.already_reviewed'));
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'remarks' => $request->remarks,
        ]);

        return redirect()->back()->with('success', __('lang.review_submitted_successfully'));
    }
}
