<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // bagian yang bisa diisi
    protected $fillable = [
        'title',
        'body'
    ];

    // ngehubungin model Post ke User
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    // ngehubungin model Post ke User
    // menjelaskan bahwa model Post punya hubungan dengan model lain, yaitu User.

    public function user()
    {
        //belongsTo buat ngambil foreign key ke model yang dituju

        // maksud e gini, di model user itu punya yang namanya foreign key
        // nah, foreign key ini yang bakal kita pake.
        // klo dilihat di struktur tabel post, nanti ada kolom user_id.
        // user_id itulah foreign keynya. dan user_id itu ambilya kan otomatis harus di model user
        return $this->belongsTo(User::class);
    }
}
