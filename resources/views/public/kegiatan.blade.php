@extends('layouts.app')

@section('title', 'Identifikasi Kegiatan Statistik — Paseban')

@section('content')
    <livewire:public-kegiatan-table :tahun="$tahun" />
@endsection
