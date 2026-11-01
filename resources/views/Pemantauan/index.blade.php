@extends('layouts.app')
@section('title', 'Daftar Formulir')

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
            <h2 style="margin:0">Checklist Pemantauan Ruang Perangkat Jaringan Kantor IT</h2>
            <a href="{{ route('pemantauan.create') }}" class="btn orange">+ Buat Formulir</a>
        </div>

        <div class="scroll">
            <table class="list">
                <thead>
                    <tr>
                        <th>No. Ref</th>
                        <th>Tanggal</th>
                        <th>Business Area</th>
                        <th>Periode</th>
                        <th style="width:230px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($forms as $f)
                        <tr>
                            <td>{{ $f->no_ref ?: '-' }}</td>
                            <td>{{ $f->tanggal?->translatedFormat('d F Y') ?: '-' }}</td>
                            <td>{{ $f->business_area ?: '-' }}</td>
                            <td>{{ $f->nama_bulan ?: '-' }} {{ $f->tahun }}</td>
                            <td>
                                <a class="btn sm" href="{{ route('pemantauan.show', $f) }}">Lihat / PDF</a>
                                <a class="btn sm gray" href="{{ route('pemantauan.edit', $f) }}">Edit</a>
                                <form action="{{ route('pemantauan.destroy', $f) }}" method="POST" style="display:inline"
                                    onsubmit="return confirm('Hapus formulir ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn sm red">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="muted">Belum ada formulir. Klik “Buat Formulir”.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($forms->hasPages())
            <div style="margin-top:14px; display:flex; gap:10px; align-items:center">
                @if ($forms->previousPageUrl())
                    <a class="btn sm gray" href="{{ $forms->previousPageUrl() }}">‹ Sebelumnya</a>
                @endif
                <span class="muted">Halaman {{ $forms->currentPage() }} dari {{ $forms->lastPage() }}</span>
                @if ($forms->nextPageUrl())
                    <a class="btn sm gray" href="{{ $forms->nextPageUrl() }}">Berikutnya ›</a>
                @endif
            </div>
        @endif
    </div>
@endsection
