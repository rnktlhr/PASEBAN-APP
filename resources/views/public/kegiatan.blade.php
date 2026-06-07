@extends('layouts.app')

@section('title', 'Identifikasi Kegiatan Statistik — Paseban')

@section('content')
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);" x-data="{ search: '', dinasFilter: '' }">
    <div class="flex-col-mobile" style="margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Identifikasi Kegiatan Statistik {{ $tahun }}</h1>
            <p style="color: var(--muted); font-size: 15px; margin: 0;">Daftar seluruh rancangan kegiatan statistik sektoral yang diidentifikasi dari OPD Kabupaten Bantul.</p>
        </div>
        
        <div style="display: flex; gap: 12px; align-items: center;">
            <select x-model="dinasFilter" style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 14px center; background-size: 14px; -webkit-appearance: none; appearance: none; box-shadow: var(--shadow-sm); transition: border-color 0.2s, box-shadow 0.2s; max-width: 200px; cursor: pointer;" onfocus="this.style.borderColor='var(--orange)'; this.style.boxShadow='0 0 0 3px rgba(235, 137, 27, 0.1)';" onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='var(--shadow-sm)';">
                <option value="">Semua OPD / Dinas</option>
                @foreach($dinasList as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
            <div style="position: relative;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" x-model="search" placeholder="Cari kegiatan atau OPD..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; width: 280px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm); transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='var(--orange)'; this.style.boxShadow='0 0 0 3px rgba(235, 137, 27, 0.1)';" onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='var(--shadow-sm)';">
            </div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                    <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 60px;">No</th>
                    <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 220px;">OPD</th>
                    <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy);">Nama Kegiatan</th>
                    <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 360px;">Jenis</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan as $idx => $item)
                <tr style="border-bottom: 1px solid var(--line);" x-show="(dinasFilter === '' || '{{ $item->dinas_id }}' === dinasFilter) && (search === '' || $el.dataset.search.toLowerCase().includes(search.toLowerCase()))" data-search="{{ addslashes(strtolower($item->dinas->singkatan ?? '')) }} {{ addslashes(strtolower($item->nama)) }}">
                    <td style="padding: 16px; text-align: center; color: var(--muted);">{{ $idx + 1 }}</td>
                    <td style="padding: 16px; font-weight: 600; color: var(--navy);">{{ $item->dinas->singkatan ?? '-' }}</td>
                    <td style="padding: 16px; color: var(--ink);">{{ $item->nama }}</td>
                    <td style="padding: 16px; text-align: center;">
                        @php
                            $jenisEnum = $item->jenis instanceof \App\Enums\JenisKegiatan ? $item->jenis : \App\Enums\JenisKegiatan::tryFrom($item->jenis);
                        @endphp
                        <span style="display: inline-block; width: 310px; text-align: center; padding: 6px 0; border-radius: 999px; font-size: 11.5px; font-weight: 600; color: {{ $jenisEnum?->cssColor() ?? 'var(--muted)' }}; background: {{ $jenisEnum?->cssBgColor() ?? '#f5f5f5' }};">
                            {{ $jenisEnum?->label() ?? ucfirst(str_replace('_', ' ', $keg->jenis)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada data kegiatan untuk tahun ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
