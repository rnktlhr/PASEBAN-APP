@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - PASEBAN')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center px-4">
    <h1 class="text-6xl font-bold text-navy mb-4 font-['JetBrains_Mono']">404</h1>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Halaman Tidak Ditemukan</h2>
    <p class="text-gray-600 max-w-md mb-8">
        Maaf, halaman yang Anda tuju tidak dapat ditemukan. Mungkin halaman tersebut telah dihapus atau Anda salah memasukkan URL.
    </p>
    <a href="{{ url('/') }}" class="bg-navy text-white px-6 py-3 rounded-lg hover:bg-navy-900 transition duration-300 font-medium">
        Kembali ke Beranda
    </a>
</div>
@endsection
