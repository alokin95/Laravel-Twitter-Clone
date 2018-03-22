<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tweet;

class TweetsController extends Controller
{

    private $data = [];


    public function index($id = null)
    {
        //
        $this->data['tweets'] = Tweet::with('user')->get();

        if(!empty($id)){
            $this->data['single'] = Tweet::with('user')->where('id',$id)->first();
        }

        return view('admin.tweets', $this->data);
    }


    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'tweet' => 'required'
        ]);

        try {
            auth()->user()->postTweet(new Tweet(['body' => $validated['tweet']]));

            \Log::info(auth()->user()->name. ' created new tweet');
            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
            }
    }


    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'tweet' => 'required'
        ]);

        try {
        $tweet = Tweet::find($id);

        $tweet->body = $validated['tweet'];

        $tweet->save();
        \Log::info('Tweet updated by '.auth()->user()->name);
        return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
        Tweet::destroy($id);
        \Log::info('Tweet is deleted by '.auth()->user()->name);
        return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }
}
