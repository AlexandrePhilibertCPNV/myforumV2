<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Refactor into middleware
        if(!Auth::user()->is_admin) {
            return redirect('/')->with("message", "Accès interdit");
        }

        $users = User::all();

        // Create a sub collection containing only the admin users
        $admin_users = $users->filter(function ($user) {
            return $user->is_admin;
        });

        return view('users.index', compact('users', 'admin_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO: Refactor into middleware
        if(!Auth::user()->is_admin) {
            return redirect('/')->with("message", "Opération interdite");
        }

        $user = User::find($id);
        $role = Role::where('slug', $request->input('role'))->first();

        $user->role()->associate($role);
        $user->save();

        return redirect(route('users.index'))->with("message", "L'utilisateur a maintenant le role $role->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
