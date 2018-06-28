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

            $comment = $tweet->addComment($comment['comment']);

            return $comment;
            \Log::info('Comment added by user ' . auth()->user()->email);
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }

    }
}
