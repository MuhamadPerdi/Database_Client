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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('projek_id')->constrained('projek_options')->onDelete('cascade');
            $table->string('bidang');
            $table->date('mulai');
            $table->date('selesai');
            $table->string('domain');
            $table->foreignId('keterangan_id')->constrained('keterangan_options')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
