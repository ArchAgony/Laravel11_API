<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
        $post = Post::create($fields);

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
