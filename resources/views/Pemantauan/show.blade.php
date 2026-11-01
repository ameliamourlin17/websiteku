@extends('layouts.app')
@section('title', 'Log Pemantauan Ruang Jaringan KAI')

@push('head')
    @include('pemantauan._css')
@endpush

@section('bare')
    <div class="toolbar no-print">
        <span>{{ session('sukses') }}</span>
        <div class="act">
            <a href="{{ route('pemantauan.create') }}" class="btn red">Kembali</a>
            <a href="{{ route('pemantauan.edit', $form) }}" class="btn gray">Edit</a>
            <button type="button" class="btn green" onclick="window.print()">Print PDF</button>
        </div>
    </div>
    @include('pemantauan._kertas', ['edit' => false])
@endsection
