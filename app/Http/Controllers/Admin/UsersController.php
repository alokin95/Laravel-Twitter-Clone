<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\UserPicture;

class UsersController extends Controller
{

    private $data = [];

    public function index($id = null)
    {
        $this->data['roles'] = Role::all();
        $this->data['users'] = User::with('picture')->get();

        if(!empty($id)){
            $this->data['single'] = User::with('picture')->where('id',$id)->first();
        }

        return view('admin.users', $this->data);
    }

    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|min:5|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1',
            'role' => 'required|integer|not_in:0',
            'picture' => 'image|mimes:png,jpg,jpeg'
        ]);

        try {
           $user = User::create([
                'name' => $validated['name'],
                'password' => bcrypt($validated['password']),
                'role_id' => $validated['role'],
                'email' => $validated['email']
            ]);


            UserPicture::create(['user_id' => $user->id]);
            \Log::info('New user was created: '.$user->name.", ".$user->id.", by user ".auth()->user()->name());
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|min:5|alpha',
            'email' => 'required|email',
            'password' => 'required|min:1',
            'role' => 'required|integer|not_in:0',
            'picture' => 'image'
        ]);

        try {
        $user = User::find($id);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;

        $user->save();

        //

            $image = request()->file('picture');

            $name = "user_id_" . $id . "." . $image->getClientOriginalExtension();

            $image->move(public_path("/images/profile"), $name);

            $picture = UserPicture::where('user_id', $id)->first();

            $picture->path = $name;

            $picture->save();

        \Log::info('Picture updated!');

        return redirect('admin/users');
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        //
        try {
        $user = User::with('picture')->where('id',$id)->first();

        $path = public_path('images/profile/'.$user->picture->path);

        $user->delete();

        \File::delete($path);
        \Log::info('User and his picture deleted');
        return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }
}
