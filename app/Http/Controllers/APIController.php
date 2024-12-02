<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function student(){
        $student = Student::all();
        return response()->json([
            'success' => true,
            'message' => 'berhasil ditampilkan',
            'data' => $student
        ], 200);
    }

    public function addstudent(Request $request){
        try {
            Student::create([
                'nim' => $request->input('nim'),
                'nama' => $request->input('nama'),
                'gender' => $request->input('gender'),
                'jurusan' => $request->input('jurusan'),
                'keahlian' => $request->input('keahlian')
            ]);
            return response()->json([
                'success' => true,
                'message' => 'berhasil ditambahkan'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'gagal ditambahkan. Kesalahan: '.$e->getMessage()
            ], 422);
        }
    }
}
