<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tweet;

class CommentsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function store(Tweet $tweet)
    {

        try {
            $comment = request()->validate([
            'comment' => 'required|min:5|max:50'
            ]);

            $tweet->addComment($comment['comment']);
            \Log::info('Comment added by user ' . auth()->user()->email);
            return back();
            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }

    }
}
