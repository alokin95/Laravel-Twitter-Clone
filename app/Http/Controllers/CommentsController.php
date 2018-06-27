<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Tweet;

class CommentsController extends Controller
{

    private $data = [];


    public function index($id = null)
    {
        //
        $this->data['comments'] = Comment::with('tweet', 'user')->get();
        $this->data['tweets'] = Tweet::all();

        if (isset($id)) {
            $this->data['single'] = Comment::find($id);
        }

        return view('admin.comments', $this->data);
    }

    public function store(Request $request)
    {
        //
        $validated = $request->validate([
        'comment' => 'required',
        'tweet' => 'required|not_in:0'
        ]);

        try {
            $comm = Comment::create([
            'body' => $validated['comment'],
            'tweet_id' => $validated['tweet'],
            'user_id' => auth()->user()->id
            ]);

            \Log::info(auth()->user()->name . " has commented through admin panel. Comment: " . $comm->body . ", TweetID: " . $comm->tweet_id);
            return redirect()->back();
            } catch (\Illuminate\Database\QueryException $ex) {
                \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
        'comment' => 'required',
        'tweet' => 'required|not_in:0'
        ]);

        try {
            $comment = Comment::find($id);

            $comment->body = $validated['comment'];
            $comment->tweet_id = $validated['tweet'];

            $comment->save();

            \Log::info(auth()->user()->name . " has updated through admin panel. Comment: " . $comment->body . ", TweetID: " . $comment->tweet_id);
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        //
        try {
            $comm = Comment::destroy($id);
            \Log::info(auth()->user()->name . " has deleted comment ");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }
}
