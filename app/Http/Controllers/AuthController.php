<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // kita menggunakan Request $request yang fungsinya untuk menangani data yang diterima dari permintaan
    // termasuk informasi pengguna
    public function register(Request $request)
    {
        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        // $fields = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed'
        // ]);

        // membuat data berdasarkan hasil validasi
        // $user = User::create($fields);

        // membuat token setelah data yang diperlukan dibuat
        // $token = $user->createToken($request->name);

        // membuat pesan jika data berhasil dibuat dan menampilkan datanya
        // return response()->json([
        //     'message' => 'user registered successfully',
        //     'data' => $user,
        //     'token' => $token->plainTextToken
        // ]);

        // -------------------------------------------------------------------------------------------------------------------------- //

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
        // urutannya gini, kita buwat variabel.
        $token =

            // nah di variabel itu, kita memanggil variabel user
            $user

            //  didalam variabel tersebut ada perintah membuat data
            // variabel user itu kita gunakan untuk media membuat token.
            ->createToken(
                // terus, di parameternya, kita mengambil variabel request

                // nah kan $request tadi isinya validate, dan didalamnya kan kita tambah data yang perlu di validate, yaitu name
                $request

                // si name itu nanti ne dibuat token. jadi, tokennya diambil dari name yang ada di validate.
                // ga harus name kok. tergantung maunya apa. syaratnya harus ada di table auth
                ->name
            );

        // membuat pesan jika data berhasil dibuat dan menampilkan datanya
        return response()->json([
            'message' => 'user registered successfully',
            'data' => $user,
            // menampilkan hanya teks tokennya saja, tidak sampai detailnya
            'token' => $token->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        // $request->validate([
        //     'email' => 'required|email|exists:users',
        //     'password' => 'required'
        // ]);

        // mencari user dengan kondisi tertentu
        // $user = User::where('email, $request->email)->first();

        // membuat kondisi
        // if (!$user || !Hash::check(
        //         $request->password,
        //         $user->password
        //     )
        // ) {
        //     return response()->json([
        //         'message' => 'your provided credentials are incorrect'
        //     ]);
        // }

        // membuat token setelah data yang diperlukan dibuat
        // $token = $user->createToken($user->name);

        // membuat pesan jika data berhasil dibuat dan menampilkan datanya
        // return response()->json([
        //     'data' => $user,
        //     'token' => $token->plainTextToken
        // ]);

        // -------------------------------------------------------------------------------------------------------------------------- //

        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        $request->validate([
            // data yang harus diisi, harus dalam bentuk email (menggunakan @), dan unik (harus ada di table users)
            'email' => 'required|email|exists:users',
            // data yang harus diisi dan harus sama persis dengan passwordnya (contohnya seperti saat mengisi password 2 kali)
            // tujuan confirmed adalah mempermudah dan membuat simpel proses validasi
            'password' => 'required'
        ]);

        // kita membuat variabel
        $user =

            // variabel tersebut menampung sebuah model yang diberi method where, digunakan untuk mencari
            User::where(

                // di dalam parameternya, kita mencari kata 'email'
                'email',

                // lalu mengarahkannya ke validate yang didalamnya terdapat email
                $request->email
            )

            // setelah itu, kita mencari data yang pertama. jadi, kita tidak akan mendapatkan hasil yang bersifat array
            ->first();

        // membuat kondisi
        if (
            !$user ||

            // kita menggunakan hash::check yang tujuannya untuk mengecek password yang di enkripsi
            !Hash::check(

                // setelah itu, kita mengecek, apakah password di dalam validate dan model sudah benar
                $request->password,
                $user->password
            )
        ) {
            return response()->json([
                'message' => 'your provided credentials are incorrect'
            ]);
        }

        // membuat data berdasarkan hasil validasi
        // bedanya, kita disini akan membuat token berdasarkan model user yang dicari
        // urutannya gini, kita buwat variabel.
        $token =

            // nah di variabel itu, kita memanggil variabel user
            $user

            //  didalam variabel tersebut ada perintah membuat data
            // variabel user itu kita gunakan untuk media membuat token.
            ->createToken(
                // terus, di parameternya, kita mengambil variabel request

                // kita pake $user, soale token yang ditambah itu berdasarkan data user yang diinput
                $user

                // si name itu nanti ne dibuat token. jadi, tokennya diambil dari name yang ada di validate.
                // ga harus name kok. tergantung maunya apa. syaratnya harus ada di table auth
                ->name
            );

        // membuat pesan jika data berhasil dibuat dan menampilkan datanya
        return response()->json([
            'data' => $user,
            // menampilkan hanya teks tokennya saja, tidak sampai detailnya
            'token' => $token->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        // mengambil informasi pengguna yang lagi login
        // $request->user()->tokens()->delete();

        // membuat response logout berhasil
        // return response()->json([
        //     'message' => 'logout success'
        // ]);

        // -------------------------------------------------------------------------------------------------------------------------- //

        // untuk logoutnya lumayan rumit, kyk gini penjelasannya

        // pertama, kita mengambil informasi pengguna yang lagi login

        // informasi ne dapet dari middleware authentikasi
        // yang ini ->middleware('auth:sanctum'), letak e di route.

        // authentikasi ini fungsine ngecek, apakah user sudah login
        // kalo belum, ntar ada error bawaannya sendiri ('message' => 'unauthenticated')
        $request->user()

            // kedua, sehabis mengambil informasi, kita mengarahkan ke tokens() yang nyambung ke user() dengan token authentikasi
            // karena kita pake e sanctum, model user itu kehubung ke model personal_access_token
            // nah, personal_access_tokens itulah tempat kita menyimpan token yang sebelumnya dibuat saat login
            ->tokens()

            // terakhir, kita mengarahkan ke delete() yang akan menghapus semua token terkait dengan pengguna itu
            // pengguna tidak bisa mengakses endpoint yang lain. jika ingin mengakses lagi, pengguna harus login
            // syaratnya ya harus nyambung ke middleware auth:sanctum, karena middleware itu buat authentikasi
            ->delete();

        // membuat response logout berhasil
        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
