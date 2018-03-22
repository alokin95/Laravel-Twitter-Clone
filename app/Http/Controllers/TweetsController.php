<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tweet;
use App\Rating;
use App\User;
use App\Comment;

class TweetsController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index()
    {

        $user = new User;

        $users = $user->orderBy('created_at', 'desc')->where('id','!=',auth()->user()->id)->get();

        $tweet = new Tweet;

        $tweets = $tweet->latestTweets();

        return view('pages.home', compact('tweets', 'users'));

    }

    public function store(Request $request)
    {

        $validated = $request->validate([
        'tweet' => 'required|min:5|max:150'
        ]);

        auth()->user()->postTweet(new Tweet(['body' => $validated['tweet']]));

        return back();
    }

    public function showTweetComments()
    {

        if (request()->has('id')) {

            try {
                \Log::info("User ".auth()->user()->email. 'is viewing comments');
                return Comment::showComments();
            }
            catch (\Illuminate\Database\QueryException $ex) {
                \Log::error($ex->getMessage());
                return redirect()->back();
            }

        }
    }

    public function delete(Tweet $tweet)
    {

        try {
            $tweet->delete();
            \Log::info('Tweet deleted by ' .auth()->user()->name);
            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }

    }

    public function vote($id, $value)
    {

        try {
            $rating = Rating::where('tweet_id', $id)->first();

            $rating->users()->attach(auth()->user()->id);

            $rating->sum += $value;
            $rating->number_of_votes += 1;

            $rating->save();
            \Log::info('User '. auth()->user()->email." successfuly voted on tweet with the id of ".$rating->id);
            return number_format((float)$rating->sum / $rating->number_of_votes, 1, '.', '');
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }

    }

}
