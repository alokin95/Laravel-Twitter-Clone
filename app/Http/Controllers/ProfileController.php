<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserPicture;

class ProfileController extends Controller
{

    private $model;

    public function __construct()
    {

        $this->middleware('auth');
        $this->model = new User;
    }


    public function showUser($id = null)
    {
        $user = $id ? User::with(['following','followers','tweets' => function ($query){
            $query->orderBy('created_at','desc');}])->where('id',$id)->first() : User::with(['tweets' => function ($query) {
            $query->orderBy('created_at', 'desc');}, 'followers', 'following'])->where('id',auth()->user()->id)->first();

        return view('pages.user', compact('user'));
    }

    public function editPicture()
    {

        $rules = [
        'picture' => 'required|image'
        ];

        $validation_message = [
        'image' => 'Image is not in supported format',
        ];

        request()->validate($rules, $validation_message);

        try {
            $image = request()->file('picture');

            $name = "user_id_" . auth()->user()->id . "." . $image->getClientOriginalExtension();

            $image->move(public_path("/images/profile"), $name);

            $picture = UserPicture::where('user_id', auth()->user()->id)->first();

            $picture->path = $name;

            $picture->save();
            \Log::info('User ' . auth()->user()->email . " has updated his profile picture");
            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }

    }

    public function follow($id){

        auth()->user()->following()->attach($id);

        return redirect()->back();

    }

    public function unfollow($id){

        auth()->user()->following()->detach($id);

        return redirect()->back();

    }
}
