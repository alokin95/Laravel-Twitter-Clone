<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rating;

class RatingsController extends Controller
{
    //
    private $data = [];

    public function index($id = null){

        $this->data['ratings'] = Rating::with('tweet', 'users')->get();

        if(isset($id)){

            $this->data['single'] = Rating::find($id);

        }

        return view('admin.ratings', $this->data);
    }

    public function store(){

        $validated = request()->validate([
            'tweet' => 'required|not_in:0',
            'sum' => 'required|integer',
            'number' => 'required|integer'
        ]);

        try {
            Rating::create([
                'tweet_id' => $validated['tweet'],
                'sum' => $validated['sum'],
                'number_of_votes' => $validated['number']
            ]);
        \Log::info('New rating added by '. auth()->user()->name);
        return redirect('admin/ratings');
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id){

        try {
            Rating::destroy($id);
            \Log::info('Rating destroyed!');
            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }

    public function update($id){

        $validated = request()->validate([
            'tweet' => 'required|not_in:0',
            'sum' => 'required|integer',
            'number' => 'required|integer'
        ]);

        try {
            $rate = Rating::find($id);

            $rate->sum = $validated['sum'];
            $rate->number_of_votes = $validated['number'];
            $rate->tweet_id = $validated['tweet'];

            $rate->save();
            \Log::info('Rating updated');
            return redirect('admin/ratings');
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }
}
