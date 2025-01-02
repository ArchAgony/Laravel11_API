<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    // menentukan apakah pengguna tertentu ($user) memiliki izin untuk memodifikasi sebuah post ($post)
    public function modify(
        // pengguna yang sedang mencoba melakukan aksi.
        User $user,
        // model Post yang akan dimodifikasi.
        Post $post): Response
    {
        // Mengecek apakah ID pengguna yang sedang login ($user->id) sama dengan ID pengguna yang memiliki post tersebut ($post->user_id).
        // Jika cocok, berarti pengguna memiliki izin untuk memodifikasi post tersebut.
        return $user->id === $post->user_id

            // jika benar, maka aksi boleh dilakukan
            ? Response::allow()

            // jika salah, maka aksi akan ditolak dan menampilkan pesan
            : Response::deny('you do not own this post');
    }
}
