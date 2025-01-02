<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
// menambah middleware dari controller
implements HasMiddleware
{
    // mendefinisikan dan mengatur middleware pada suatu controller atau rute secara spesifik.
    public static function middleware()
    {
        return [
            // autentikasi menggunakan Sanctum
            // menjelaskan bahwa user harus sudah terautentikasi dengan token yang valid.
            new Middleware('auth:sanctum',

            //  middleware tidak akan diterapkan pada metode index dan show
            except: ['index', 'show'])
        ];
    }

    public function index()
    {
        //
        return Post::all();
    }

    public function store(Request $request)
    {
        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        $fields = $request->validate([
            // diisi berdasarkan fillable dalam model
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        // membuat response jika validasi berhasil
        // return 'ok';

        // menyimpan response di database
        // $post = Post::create($fields);

        // alih-alih membuat langsung dari model post, kita akan membuat yang lebih efisien (sekaligus menambah ke model user)
        // karena kita sudah nambah relasi, jadi kita akan sekalian buat ke tabel user
        // $post = $request->user()->posts()->create($fields);

            // mendapatkan data pengguna yang sedang login.
            $post = $request->user()

            // relasi hasMany dari model User
            // posts itu sendiri asal e dari nama function seng dibuat
            ->posts()

            // membuat data baru di database
            // nantinya otomatis mengisi kolom di tabel
            ->create($fields);

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        return ['post' => $post];
    }

    public function show(Post $post)
    {
        // mengembalikan data berdasarkan id yang diminta di database (menampilkan data berdasarkan id)
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        //
        Gate::authorize('modify', $post);

        // menyimpan method post di dalam database
        $fields = $request->validate([
            // diisi berdasarkan fillable dalam model
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        // membuat response jika validasi berhasil
        // return 'ok';

        // mengubah data berdasarkan id yang dipilih
        $post->update($fields);

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        return $post;
    }

    public function destroy(Post $post)
    {
        // menghapus data berdasarkan id yang dipilih
        $post->delete();

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        return response()->json([
            'message' => 'the post was deleted'
        ]);
    }
}
