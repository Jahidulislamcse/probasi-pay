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
        $reviews = UserReview::latest()->paginate(15);

        return view('reviews.show', compact('reviews'));
    }

    public function create()
    {
        $users = User::all();
        $reviews = UserReview::latest()->paginate(15);
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
            $videoName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('reviews/videos'), $videoName);
            $videoPath = 'reviews/videos/' . $videoName;
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

    public function update(Request $request, UserReview $review)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,webm|max:51200',
            'description' => 'nullable|string',
        ]);

        // If a new video is uploaded, delete the old one and move the new video
        if ($request->hasFile('video_path')) {
            if ($review->video_path && file_exists(public_path($review->video_path))) {
                unlink(public_path($review->video_path));
            }

            $video = $request->file('video_path');
            $videoName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('reviews/videos'), $videoName);
            $review->video_path = 'reviews/videos/' . $videoName;
        }

        // Update other fields
        $review->title = $request->title;
        $review->description = $request->description;
        $review->save();

        return redirect()->back()->with([
            'response' => true,
            'msg' => 'রিভিউ সফলভাবে আপডেট হয়েছে।'
        ]);
    }

    public function destroy(UserReview $review)
    {
        // Delete video file if exists
        if ($review->video_path && file_exists(public_path($review->video_path))) {
            unlink(public_path($review->video_path));
        }

        $review->delete();

        return redirect()->back()->with([
            'response' => true,
            'msg' => 'রিভিউ মুছে ফেলা হয়েছে।'
        ]);
    }
}
