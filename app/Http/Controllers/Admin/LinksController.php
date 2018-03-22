<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Link;
use App\Role;

class LinksController extends Controller
{

    private $data = [];


    public function index($id = null)
    {
        //
        $this->data['links'] = Link::all();
        $this->data['roles'] = Role::all();

        if(isset($id)){
            $this->data['single'] = Link::find($id);
        }

        return view('admin.links', $this->data);
    }


    public function store(Request $request)
    {
        //

        $validated = $request->validate([
        'role' => 'required|not_in:0',
        'order' => 'required',
        'title' => 'required',
        'href' => 'required'
        ]);

    try {
        Link::create([
        'role_id' => $validated['role'],
        'order' => $validated['order'],
        'title' => $validated['title'],
        'href' => $validated['href']
        ]);

        \Log::info('Link inserted through admin panel by ' .auth()->user()->name);
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
            'role' => 'required|not_in:0',
            'order' => 'required',
            'href' => 'required',
            'title' => 'required'
        ]);

        try {
            $link = Link::find($id);

            $link->role_id = $validated['role'];
            $link->order = $validated['order'];
            $link->href = $validated['href'];
            $link->title = $validated['title'];

            $link->save();

            \Log::info('Link updated through admin panel by '.auth()->user()->name);
            return redirect('/admin/links');
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        try {
            Link::destroy($id);

            \Log::info('Link deleted via admin panel by '.auth()->user()->name);
            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back();
        }
    }
}
