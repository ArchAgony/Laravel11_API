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
        // membuat sistem authentikasi menggunakan Laravel Sanctum
        // return [ new Middleware(
        //    'auth:sanctum',
        //    except: ['index', 'show']
        // )];

        // -------------------------------------------------------------------------------------------------------------------------- //

        // autentikasi menggunakan Sanctum
        return [
            // menjelaskan bahwa user harus sudah terautentikasi dengan token yang valid.
            new Middleware(
                'auth:sanctum',

                //  middleware tidak akan diterapkan pada metode index dan show
                except: ['index', 'show']
            )
        ];
    }

    public function index()
    {
        // memunculkan seluruh data pada model Post
        return Post::all();
    }

    public function store(Request $request)
    {
        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        // $fields = $request->validate([
        //     'title' => 'required|max:255',
        //     'body' => 'required'
        // ]);

        // // membuat response jika validasi berhasil
        // // return 'ok';

        // // menyimpan response di database
        // // $post = Post::create($fields);

        // kita akan membuat yang lebih efisien (sekaligus menambah ke model user)
        // karena kita sudah nambah relasi, jadi kita akan sekalian buat ke tabel user

        // mendapatkan data pengguna yang sedang login.
        // $post = $request->user()->posts()->create($fields);

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        // return ['post' => $post];

        // -------------------------------------------------------------------------------------------------------------------------- //

        // membuat validasi (ketentuan mengisi formnya, seperti kata maks, bagian yang harus diisi, dll)
        $fields = $request->validate([
            // diisi berdasarkan fillable dalam model
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

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
        // memverifikasi apakah pengguna yang sedang login memiliki izin untuk melakukan suatu tindakan
        // Gate::authorize('modify',$post);

        // menyimpan method post di dalam database
        // $fields = $request->validate([
        //     'title' => 'required|max:255',
        //     'body' => 'required'
        // ]);

        // // membuat response jika validasi berhasil
        // // return 'ok';

        // mengubah data berdasarkan id yang dipilih
        // $post->update($fields);

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        // return $post;

        // -------------------------------------------------------------------------------------------------------------------------- //

        // mengatur izin (authorization).

        // memverifikasi apakah pengguna yang sedang login memiliki izin untuk melakukan suatu tindakan
        // izinnya berasal dari policy
        Gate::authorize

            // nama function yang ada di postPolicy
            // memeriksa apakah pengguna yang sedang login adalah pemilik post.
            (
                'modify',

                // argument yang diperlukan dari policy diatas (di dalam parameter function modify)
                // jangan lupa menambah argumen yang sama di parameter function ini
                $post
            );

        // menyimpan method post di dalam database
        $fields = $request->validate([
            // diisi berdasarkan fillable dalam model
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        // mengubah data berdasarkan id yang dipilih
        $post->update($fields);

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        return $post;
    }

    public function destroy(Post $post)
    {
        // memverifikasi apakah pengguna yang sedang login memiliki izin untuk melakukan suatu tindakan
        // Gate::authorize('modify',$post);

        // // membuat response jika validasi berhasil
        // // return 'ok';

        // menghapus data berdasarkan id yang dipilih
        // $post->delete();

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        // return response()->json([
        //     'message' => 'the post was deleted'
        // ]);

        // -------------------------------------------------------------------------------------------------------------------------- //

        // mengatur izin (authorization).

        // memverifikasi apakah pengguna yang sedang login memiliki izin untuk melakukan suatu tindakan
        // izinnya berasal dari policy
        Gate::authorize

            // nama function yang ada di postPolicy
            // memeriksa apakah pengguna yang sedang login adalah pemilik post.
            (
                'modify',

                // argument yang diperlukan dari policy diatas (di dalam parameter function modify)
                // jangan lupa menambah argumen yang sama di parameter function ini
                $post
            );

        // menghapus data berdasarkan id yang dipilih
        $post->delete();

        // membuat response jika data berhasil disimpan dan menampilkan datanya
        return response()->json([
            'message' => 'the post was deleted'
        ]);
    }
}
