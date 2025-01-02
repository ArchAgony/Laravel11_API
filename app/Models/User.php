<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // memuat fitur bawaan sanctum untuk membuat token
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // ngehubungin model Post ke User
    // nama function ini akan dipakai saat menambah data (cek ke postController)
    public function posts(){
        // hasMany buat ngasih foreign key ke model yang dituju

        // maksud e gini, di model post itu punya yang namanya foreign key
        // nah, foreign key ini yang bakal kita pake.
        // klo dilihat di struktur tabel post, nanti ada kolom user_id.
        // user id itulah foreign keynya. dan user_id itu ambilya kan otomatis harus di model user
        return $this->hasMany(Post::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
