<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        return view('profile');
    }

    public function update(){

        $this->validate(request(),[
            'password' => 'required|min:8|confirmed'
        ]);

        auth()->user()->update([
            'password' => bcrypt(request('password'))
        ]);

        return redirect('profile')
        ->with('success', true)
        ->with('message','Success updating your password');
    }
}
