<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')
        ->with('roles', Role::get())
        ->with('users', User::latest()->get());
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
    public function store()
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'role_id' => 'required|in:'.Role::all()->implode('id',','),
            'password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('addError', true);
        }

        $request = request()->all();
        $request['password'] = bcrypt(request('password'));
        User::create($request);

        return redirect('users')
        ->with('success', true)
        ->with('message','Success creating a user');
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
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        if($user->role_id == 1){
            return back();
        }
        $validator = Validator::make(request()->all(),[
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$user->id.'|email|max:255',
            'role_id' => 'required|in:'.Role::all()->implode('id',','),
            'password' => 'nullable|confirmed|min:8',
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('addError', true);
        }

        $request = request()->all();
        
        
        $user->name = request('name');
        $user->email = request('email');
        $user->role_id = request('role_id');

        if(request('password')){
            $user->password = bcrypt(request('password'));
        }
        $user->save();

        return redirect('users')
        ->with('success', true)
        ->with('message','Success updating a user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users')
        ->with('success', true)
        ->with('message','Success deleting a user');
    }
}
