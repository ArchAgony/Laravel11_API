<?php

namespace App\Http\Controllers;
use App\Models\User;

// menambahkan fungsi request
use Illuminate\Http\Request;

// menambahkan fungsi authentikasi
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        //
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function simpanUser(Request $request)
    {
        //
        $user = User::Create([
            'name'  => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/register');
    }


    public function login()
    {
        //
        return view('login');
    }

    public function cekLogin(Request $request)
    {
        //
        if(!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            return redirect('login');
        } else {
            // return "berhasil login!";
            return redirect('/home');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
