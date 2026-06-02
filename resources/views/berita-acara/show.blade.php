@extends('layouts.app')

@section('title', $beritaAcara->judul . ' — Berita Acara Paseban')

@section('content')
<section style="background: linear-gradient(135deg, var(--navy) 0%, var(--navy-900) 60%, #021a3d 100%); color: #fff; padding: 60px 0 40px; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 10;">
        <a href="{{ route('berita-acara.index') }}" style="display: inline-flex; align-items: center; gap: 6px; color: rgba(255,255,255,.7); text-decoration: none; font-size: 14px; margin-bottom: 20px; transition: .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.7)'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Daftar Berita Acara
        </a>
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <div style="padding: 5px 12px; border-radius: 4px; background: var(--orange); color: #fff; font-size: 12px; font-weight: 700; letter-spacing: .5px;">{{ ucfirst($beritaAcara->kategori) }}</div>
            <div class="mono" style="font-size: 13px; color: rgba(255,255,255,.8); letter-spacing: .5px;">{{ $beritaAcara->tanggal->format('d F Y') }}</div>
        </div>
        <h1 style="margin: 0; font-size: 36px; font-weight: 800; letter-spacing: -.5px; line-height: 1.3;">{{ $beritaAcara->judul }}</h1>
    </div>
</section>

<section style="padding: 60px 0; background: #f8fafc; min-height: 50vh;">
    <div class="container">
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 40px; box-shadow: var(--shadow-sm);">
            <style>
                .prose figcaption.attachment__caption { display: none !important; }
                .prose figure.attachment { margin: 24px 0; text-align: center; }
                .prose figure.attachment img { max-width: 100%; height: auto; border-radius: 8px; }
            </style>

            <div style="font-size: 16px; line-height: 1.8; color: var(--ink);">
                {!! nl2br(e($beritaAcara->ringkasan)) !!}
            </div>
            @if($beritaAcara->narasi)
                <div class="prose" style="font-size: 16px; line-height: 1.8; color: var(--ink); margin-top: 32px; padding-top: 32px; border-top: 1px solid var(--line);">
                    {!! $beritaAcara->narasi !!}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
