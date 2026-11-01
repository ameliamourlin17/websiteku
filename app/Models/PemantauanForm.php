<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemantauanForm extends Model
{
    protected $table = 'pemantauan_forms';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal'         => 'date',
        'petugas_tanggal' => 'date',
        'minggu'          => 'array',
        'checklist'       => 'array',
    ];

    public const SUBJECTS = [
        'Kebersihan Ruangan',
        'Lampu Ruangan',
        'Kerapihan Kabel',
        'CCTV',
        'Alat Pemadam Api Ringan',
        'Suhu Ruangan (18⁰ - 27⁰C)',
        'Humidity (40%-60%)',
    ];

    public const JUMLAH_MINGGU = 4;

    public const BULAN = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    public const DOKUMEN = [
        'perusahaan' => 'PT. KERETA API INDONESIA (PERSERO)',
        'divisi'     => 'TEKNOLOGI INFORMASI',
        'judul'      => ['FORMULIR CHECKLIST PEMANTAUAN', 'RUANG PERANGKAT JARINGAN KANTOR IT', '(NON DATA CENTER)'],
        'nomor'      => 'FR.SM/TI/015.010/05-2026',
        'tanggal'    => '04 Mei 2026',
        'revisi'     => '003-2026',
        'halaman'    => '1 dari 1',
    ];

    public function getNamaBulanAttribute(): string
    {
        return self::BULAN[$this->bulan] ?? '';
    }

    public function nilai(int $subject, int $minggu): string
    {
        return $this->checklist[$subject][$minggu] ?? '';
    }

    public function infoMinggu(int $minggu, string $key): string
    {
        return $this->minggu[$minggu][$key] ?? '';
    }
}
