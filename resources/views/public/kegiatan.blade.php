@extends('layouts.app')

@section('title', 'Identifikasi Kegiatan Statistik — Paseban')

@section('content')
<div class="container" style="padding: 40px 32px 0;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Identifikasi Kegiatan Statistik {{ $tahun }}</h1>
        <p style="color: var(--muted); font-size: 15px; margin: 0;">Daftar seluruh rancangan kegiatan statistik sektoral yang diidentifikasi dari OPD Kabupaten Bantul.</p>
    </div>
</div>

<livewire:public-kegiatan-table :tahun="$tahun" />
@endsection
