@extends('layouts.app')
@section('title', 'Edit Formulir Checklist Pemantauan')

@push('head')
    @include('pemantauan._css')
@endpush

@section('bare')
    <form action="{{ route('pemantauan.update', $form) }}" method="POST">
        @csrf @method('PUT')
        <div class="toolbar no-print">
            <span>Ubah isian lalu klik Simpan.</span>
            <div class="act">
                <a href="{{ route('pemantauan.show', $form) }}" class="btn red">Batal</a>
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
