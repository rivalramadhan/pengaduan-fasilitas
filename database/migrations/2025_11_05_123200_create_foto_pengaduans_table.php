<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('foto_pengaduans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pengaduan_id')->constrained('pengaduans')->onDelete('cascade');
        $table->string('path');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_pengaduans');
    }
};
