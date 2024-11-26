<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function home(){
        return view('home', ['key' => 'home']);
    }

    public function user(){
        $user = User::all();
        return view('user', ['key' => 'user', 'user' => $user]);
    }


}
