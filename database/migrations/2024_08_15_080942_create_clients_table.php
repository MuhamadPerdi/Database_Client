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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('tanggal');
            $table->foreignId('jenis_id')->constrained('jenis_options')->onDelete('cascade');
            $table->string('kebutuhan');
            $table->string('no_telp');
            $table->text('alamat');
            $table->string('sumber');
            $table->text('keterangan');
            $table->foreignId('status_id')->constrained('status_options')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
