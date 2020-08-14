<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findorFail($id);

        return view('users.show')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('users.edit')->with('user', $user);
    }

    public function update($id)
    {
        $user = User::findorFail($id);


        return view('users.show')->with('user', $user);
    }
}
