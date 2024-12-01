<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function home(){
        return view('home', ['key' => 'home']);
    }

    public function user(){
        $user = User::paginate(2);
        return view('user', ['key' => 'user', 'user' => $user]); // navigasi, menampung
    }

    public function student(){
        $student = Student::all();
        return view('student', ['key' => 'student', 'student' => $student]);
        // return dd($student);
    }
}
