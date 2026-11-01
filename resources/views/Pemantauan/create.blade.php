@extends('layouts.app')
@section('title', 'Formulir Checklist Pemantauan Ruang Jaringan KAI')

@push('head')
    @include('pemantauan._css')
@endpush

@section('bare')
    <form action="{{ route('pemantauan.store') }}" method="POST">
        @csrf
        <div class="toolbar no-print">
            <span>Isi langsung pada kolom formulir, lalu klik Simpan.</span>
            <div class="act">
                <a href="{{ route('pemantauan.index') }}" class="btn gray">Daftar Formulir</a>
                <button type="submit" class="btn green">Simpan &amp; Lihat PDF</button>
            </div>
        </div>
        @if ($errors->any())
            <div class="err no-print" style="max-width:1100px; margin:0 auto 12px">
                <b>Periksa kembali isian Anda:</b>
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @include('pemantauan._kertas', ['edit' => true])
    </form>
@endsection
