<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required'
        ]);

        $review = new Review();
        $review->title = $request->input('title');
        $review->content = $request->input('content');
        $review->shop_id = $request->input('shop_id');
        $review->user_id = Auth::user()->id;
        $review->score = $request->input('score');
        $review->save();

        return back();
    }

        public function index()
    {
    // 公開されているレビューだけ取得
    $reviews = Review::where('hidden', false)->latest()->get();

    return view('reviews.index', compact('reviews'));
    }
}
