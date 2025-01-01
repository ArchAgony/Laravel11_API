<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        $fields = $request->validate([
            // data yang harus diisi dan maksimal katanya adalah 255
            'name' => 'required|max:255',
            // data yang harus diisi, harus dalam bentuk email (menggunakan @), dan unik (belum ada di table users)
            'email' => 'required|email|unique:users',
            // data yang harus diisi dan harus sama persis dengan passwordnya (contohnya seperti saat mengisi password 2 kali)
            // tujuan confirmed adalah mempermudah dan membuat simpel proses validasi
            'password' => 'required|confirmed'
        ]);

        // membuat data berdasarkan hasil validasi
        $user = User::create($fields);

        // membuat token setelah data yang diperlukan dibuat
        // urutannya gini, kita buwat variabel. nah di variabel itu, kita memanggil variabel user yang didalamnya adalah perintah membuat data
        // variabel user itu kita gunakan untuk media membuat token. terus, di parameternya, kita mengambil variabel request
        // nah kan $request tadi isinya validate, dan didalamnya kan kita tambah data yang perlu di validate, salah satune ya name
        // si name itu nanti ne dibuat token. jadi, tokennya diambil dari name yang ada di validate.
        $token = $user->createToken($request->name);

        // membuat pesan jika data berhasil dibuat dan menampilkan datanya
        return response()->json([
            'message' => 'user registered successfully',
            'data' => $user,
            // menampilkan hanya teks tokennya saja, tidak sampai detailnya
            'token' => $token->plainTextToken
        ]);
    }

    public function login(Request $request){
        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        $fields = $request->validate([
            // data yang harus diisi, harus dalam bentuk email (menggunakan @), dan unik (harus ada di table users)
            'email' => 'required|email|exists:users',
            // data yang harus diisi dan harus sama persis dengan passwordnya (contohnya seperti saat mengisi password 2 kali)
            // tujuan confirmed adalah mempermudah dan membuat simpel proses validasi
            'password' => 'required'
        ]);

        // mencari user dengan kondisi tertentu
        // kita membuat variabel, dimana ia menampung sebuah model yang diberi method where. method tersebut digunakan untuk mencari.
        // di dalam parameternya, kita mencari kata 'email', lalu mengarahkannya ke validate yang didalamnya terdapat email
        // setelah itu, kita mencari data yang pertama. jadi, kita tidak akan mendapatkan hasil yang bersifat array
        $user = User::where('email', $request->email)->first();

        // mengecek apakah password user yang diisi sudah benar seperti di dalam database
        // kita menggunakan hash::check yang tujuannya untuk mengecek password yang di enkripsi
        // setelah itu, kita mengecek, apakah password di dalam validate dan model sudah benar
        // nah, kode ini akan berjalan jika model user yang sebelumnya dicari itu ada, namun datanya tidak sama dengan validate
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'your provided credentials are incorrect'
            ]);
        }

        // membuat token setelah data yang diperlukan dibuat
        // urutannya gini, kita buwat variabel. nah di variabel itu, kita memanggil variabel user yang didalamnya adalah perintah membuat data
        // variabel user itu kita gunakan untuk media membuat token. terus, di parameternya, kita mengambil variabel request
        // nah kan $request tadi isinya validate, dan didalamnya kan kita tambah data yang perlu di validate, salah satune ya name
        // si name itu nanti ne dibuat token. jadi, tokennya diambil dari name yang ada di validate.

        // bedanya, kita disini akan membuat token berdasarkan model user yang dicari
        $token = $user->createToken($user->name);

        // membuat pesan jika data berhasil dibuat dan menampilkan datanya
        return response()->json([
            'data' => $user,
            // menampilkan hanya teks tokennya saja, tidak sampai detailnya
            'token' => $token->plainTextToken
        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
