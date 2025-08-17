<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = UserReview::latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        $users = User::all();
        $reviews = UserReview::latest()->get();
        return view('reviews.create', compact('users', 'reviews'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'video_path' => 'required|file|mimes:mp4,mov,avi,webm|max:51200',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('video_path')) {
            $video = $request->file('video_path');
            $videoName = time().'_'.$video->getClientOriginalName();
            $video->move(public_path('reviews/videos'), $videoName);
            $videoPath = 'reviews/videos/'.$videoName;
        }


        // Create review
        $review = UserReview::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'video_path' => $videoPath,
            'description' => $request->description,
            'status' => '1', // default status
        ]);

        return redirect()->back()->with([
            'response' => true,
            'msg' => 'রিভিউ সফলভাবে জমা দেওয়া হয়েছে।'
        ]);
    }
}
