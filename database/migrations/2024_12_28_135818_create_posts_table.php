<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // $table->string('title');
            // $table->text('body');

            // Membuat kolom foreign key bernama user_id untuk menghubungkan tabel ini ke tabel users
            $table->foreignId('user_id')

            // menjelaskan bahwa user_id itu foreign id nyambung ke tabel lain
            ->constrained()

            // membuat aturan, jika di tabel induk (users) dihapus, maka di tabel ini dihapus
            // misal klo mau delete user, nanti id yang asal e dari sana ikut dihapus
            ->cascadeOnDelete();

            // isi dari tabel post database
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
