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

        $followed_users = User::find(auth()->user()->id)->following->pluck('id');
        $followed_users[] = auth()->user()->id;

        $users = User::orderBy('created_at', 'desc')->whereNotIn('id',$followed_users)->get();

        $followed_tweets = Tweet::latestTweets();

        return view('pages.home',compact('followed_tweets', 'users'));
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
