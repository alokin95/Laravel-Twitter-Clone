<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserPicture;

class AuthController extends Controller
{

    public function __construct()
    {

        $this->middleware('guest', ['except' => 'destroy']);

    }


    public function index()
    {

        return view('pages.welcome');

    }

    public function register(Request $request)
    {

        $validation_rules = [
        'name' => 'required|regex:/^[A-z]{4,15}+$/',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'password' => 'required|confirmed'
        ];

        $validation_messages = [
        'regex' => 'Name must be atleast 4 characters and must contain only letters',
        ];

        $data = $request->validate($validation_rules, $validation_messages);

        try {
        $user = User::create(['role_id' => 2, 'email' => $data['email'], 'name' => $data['name'], 'password' => bcrypt($data['password'])]);

        UserPicture::create(['user_id' => $user->id]);

        auth()->login($user);
        \Log::info("New user registered! ".$user->email."; ".$user->name);
        return redirect()->home();
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }

    }

    public function login(Request $request)
    {
            if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                \Log::info('User logged in! ' . auth()->user()->name);
                return redirect('/home');
            }
            return back()->with("Message", "Wrong email or password");

    }

    public function destroy()
    {

        auth()->logout();
        return redirect('/');

    }
}
