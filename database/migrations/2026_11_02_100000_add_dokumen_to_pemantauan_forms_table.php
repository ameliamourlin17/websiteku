<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemantauan_forms', function (Blueprint $table) {
            $table->string('doc_nomor')->nullable();
            $table->string('doc_tanggal')->nullable();   // tanggal terbit (teks bebas)
            $table->string('doc_revisi')->nullable();
            $table->string('doc_halaman')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pemantauan_forms', function (Blueprint $table) {
            $table->dropColumn(['doc_nomor', 'doc_tanggal', 'doc_revisi', 'doc_halaman']);
        });
    }
};
