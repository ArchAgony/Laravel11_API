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
    public function updatestudent(Request $request, $id){
        try {
            $student = Student::find($id);
            $student->nim = $request->input('nim');
            $student->nama = $request->input('nama');
            $student->gender = $request->input('gender');
            $student->jurusan = $request->input('jurusan');
            $student->keahlian = $request->input('keahlian');
            $student->save();

            return response()->json([
                'success' => true,
                'message' => 'berhasil diubah'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'gagal diubah. Kesalahan: '.$e->getMessage(),
            ], 401);
        }
    }

    public function deletestudent($id){
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                'success' => true,
                'message' => 'berhasil dihapus'
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'gagal dihapus. ID tidak ditemukan'
            ], 401);
        }
    }
}
