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
        Schema::create('configurasis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('logo'); // Ganti dengan text jika ukuran logo lebih besar dari 255 karakter
            $table->text('favicon'); // Ganti dengan text jika ukuran favicon lebih besar dari 255 karakter
            $table->string('email');
            $table->string('email2')->nullable();
            $table->string('phone');
            $table->text('alamat'); // Ganti dengan text jika alamat panjang
            $table->text('map')->nullable(); // Ganti dengan text untuk URL peta
            $table->text('footer'); // Ganti dengan text jika footer panjang
            $table->string('instagram')->nullable(); // Nullable jika tidak semua entri memiliki Instagram
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('overview'); // Ganti dengan text jika overview panjang
            $table->text('metakeyword'); // Ganti dengan text jika keyword panjang
            $table->text('metadeskripsi'); // Ganti dengan text jika deskripsi panjang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurasis');
    }
};
