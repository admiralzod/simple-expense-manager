<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index')
        ->with('roles', Role::latest()->get());
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
            'description' => 'required|max:255'
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('addError', true);
        }

        Role::create(request()->all());

        return redirect('roles')
        ->with('success', true)
        ->with('message','Success creating a role');

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
    public function update(Role $role)
    {
        if($role->id == 1){
            return back();
        }
        
        $validator = Validator::make(request()->all(),[
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('editError', true);
        }

        $role->update(request()->all());

        return redirect('roles')
        ->with('success', true)
        ->with('message','Success updating a role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if($role->id == 1){
            return back();
        }
        $role->delete();
        return redirect('roles')
        ->with('success', true)
        ->with('message','Success deleting a role');
    }
}
