<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemantauan_forms', function (Blueprint $table) {
            $table->id();
            $table->string('no_ref')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('business_area')->nullable();
            $table->unsignedTinyInteger('bulan')->nullable();
            $table->unsignedSmallInteger('tahun')->nullable();

            $table->json('minggu')->nullable();     // minggu[0..3] = {ruangan, tanggal, jam}
            $table->json('checklist')->nullable();  // checklist[0..6][0..3] = 'V' | 'X' | null

            $table->text('catatan')->nullable();

            $table->string('mengetahui_nama')->nullable();
            $table->string('mengetahui_nipp')->nullable();

            $table->string('petugas_kota')->nullable();
            $table->date('petugas_tanggal')->nullable();
            $table->string('petugas_nama')->nullable();
            $table->string('petugas_nipp')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemantauan_forms');
    }
};
