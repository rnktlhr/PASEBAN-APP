@extends('layouts.app')

@section('title', 'Pembinaan Statistik Sektoral — Paseban')

@section('content')
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">

    <!-- Header Section -->
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 32px; font-weight: 800; color: var(--navy); margin: 0 0 12px; letter-spacing: -0.5px;">Pembinaan Statistik Sektoral</h1>
        <p style="color: var(--muted); font-size: 16px; line-height: 1.6; max-width: 800px; margin: 0;">
            Materi dan dokumentasi pembinaan kegiatan statistik sektoral OPD Kabupaten Bantul — sosialisasi, panduan teknis, hingga forum evaluasi tahunan.
        </p>
    </div>

    <!-- Hero Banner -->
    <div style="background: var(--navy); border-radius: 12px; padding: 44px 48px; display: grid; grid-template-columns: 1.6fr 1fr; gap: 32px; align-items: center; position: relative; overflow: hidden; margin-bottom: 60px; box-shadow: var(--shadow-md);" class="cards-grid">
        <svg style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: .08;" aria-hidden="true">
            <defs>
                <pattern id="dots" width="22" height="22" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1.2" fill="#fff" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dots)" />
        </svg>
        <div style="position: absolute; right: -60px; top: -60px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(235,137,27,.35), transparent 65%); border-radius: 50%;">
        </div>

        <div style="position: relative; color: #fff;">

            <h2 style="margin: 0; font-size: 30px; font-weight: 800; letter-spacing: -.6px; line-height: 1.15;">
                Pembinaan Statistik Sektoral Kabupaten Bantul
            </h2>
            <p style="margin: 14px 0 24px; font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,.78); max-width: 540px;">
                Materi dan dokumentasi pembinaan kegiatan statistik sektoral — akses panduan teknis, regulasi, dan modul pelatihan untuk seluruh OPD se-Kabupaten Bantul.
            </p>
            <a href="https://bpsbantul.my.canva.site/pss2026" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 10px; padding: 13px 22px; border-radius: 6px; background: var(--orange); color: #fff; font-weight: 700; font-size: 14px; box-shadow: 0 6px 18px rgba(235,137,27,.4); text-decoration: none; transition: transform .15s ease;">
                Masuk Modul Pembinaan
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
            </a>
        </div>

        <div style="position: relative; display: flex; justify-content: center;">
            <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 20px 50px rgba(0,0,0,.3); display: flex; flex-direction: column; width: 100%; max-width: 380px;">
                <div style="font-size: 13px; font-weight: 600; color: var(--muted); margin-bottom: 8px;">Tingkat Kehadiran OPD</div>
                <h3 style="font-size: 16px; font-weight: 800; color: var(--navy); margin: 0 0 24px;">Ringkasan {{ $totalOPD }} OPD - {{ $totalSesi }} Sesi</h3>
                
                <div style="display: flex; align-items: center; gap: 32px; flex: 1;">
                    <div style="position: relative; width: 120px; height: 120px;" x-data="{ pct: 0, count: 0 }" x-init="
                        setTimeout(() => { pct = {{ $persentaseKehadiran }} }, 300);
                        let start = 0;
                        let end = {{ $persentaseKehadiran }};
                        let duration = 1500;
                        let startTimestamp = null;
                        const step = (timestamp) => {
                            if (!startTimestamp) startTimestamp = timestamp;
                            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                            const ease = 1 - Math.pow(1 - progress, 4);
                            count = Math.floor(ease * (end - start) + start);
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            }
                        };
                        setTimeout(() => window.requestAnimationFrame(step), 300);
                    ">
                        <svg viewBox="0 0 36 36" style="width: 100%; height: 100%;">
                            <!-- Background Circle -->
                            <path class="circle-bg"
                                d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="var(--bg)"
                                stroke-width="4"
                                stroke-dasharray="100, 100" />
                            <!-- Progress Circle -->
                            <path class="circle"
                                :stroke-dasharray="pct + ', 100'"
                                d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="var(--orange)"
                                stroke-width="4"
                                stroke-linecap="round"
                                style="transition: stroke-dasharray 1.5s cubic-bezier(0.165, 0.84, 0.44, 1);" />
                        </svg>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--navy); line-height: 1;"><span x-text="count">0</span>%</div>
                            <div style="font-size: 10px; font-weight: 600; color: var(--muted);">HADIR</div>
                        </div>
                    </div>
                    
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--orange);"></div>
                                <span style="font-size: 13.5px; font-weight: 500; color: var(--ink);">Hadir</span>
                            </div>
                            <span class="mono" style="font-size: 14px; font-weight: 700; color: var(--navy);">{{ $totalKehadiran }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--bg);"></div>
                                <span style="font-size: 13.5px; font-weight: 500; color: var(--ink);">Tidak Hadir</span>
                            </div>
                            <span class="mono" style="font-size: 14px; font-weight: 700; color: var(--navy);">{{ ($totalSesi * $totalOPD) - $totalKehadiran }}</span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px dashed var(--line); font-size: 13px; color: var(--muted); line-height: 1.5;">
                    <strong style="color: var(--navy);">Tingkat Kehadiran OPD {{ $persentaseKehadiran }}%</strong> — representasi partisipasi dinas pada sesi pembinaan yang tercatat.
                </div>
            </div>
        </div>
    </div>

    @if(count($programPembinaan) > 0)
    <!-- Program Tahunan -->
    <div style="margin-bottom: 60px;">
        <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Program Pembinaan Tahun 2026</h2>
        <p style="color: var(--muted); font-size: 15px; margin: 0 0 24px;">Empat program pembinaan utama yang dilaksanakan secara berkala per triwulan.</p>
        
        <div class="summary-cards-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px;">
            @foreach($programPembinaan as $index => $program)
            <!-- Card {{ $index + 1 }} -->
            <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm); position: relative; overflow: hidden;">
                <div class="mono" style="position: absolute; top: 24px; right: 24px; font-size: 24px; font-weight: 800; color: var(--bg); z-index: 0; user-select: none;">{{ str_pad($program->nomor_urut, 2, '0', STR_PAD_LEFT) }}</div>
                <div style="width: 48px; height: 48px; background: var(--orange-50); color: var(--orange); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; position: relative; z-index: 1;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg>
                </div>
                <h3 style="font-size: 16px; font-weight: 700; color: var(--navy); margin: 0 0 8px; position: relative; z-index: 1;">{{ $program->nama }}</h3>
                <p style="color: var(--muted); font-size: 13.5px; line-height: 1.5; margin: 0 0 20px; position: relative; z-index: 1;">{{ $program->deskripsi }}</p>
                <div style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; background: var(--bg); border-radius: 6px; font-size: 12px; font-weight: 600; color: var(--ink);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--orange);"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    {{ $program->kuartal }} <span style="color: var(--muted); font-weight: 400; margin-left: 4px;">{{ $program->jadwal }}</span>
                </div>
                @if($program->link)
                <div style="margin-top: 20px;">
                    <a href="{{ $program->link }}" style="color: var(--orange); font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">Selengkapnya <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Berita Acara Section -->
    <div style="margin-bottom: 60px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Berita Acara Terkini</h2>
                <p style="color: var(--muted); font-size: 15px; margin: 0;">Dokumentasi dan laporan hasil kegiatan pembinaan sektoral.</p>
            </div>
            <a href="{{ route('berita-acara.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #fff; color: var(--orange); border: 1px solid var(--line); border-radius: 30px; font-size: 13px; font-weight: 700; text-decoration: none; box-shadow: var(--shadow-sm); transition: all 0.2s;">
                Lihat Semua
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
            @foreach($latestBeritaAcara as $ba)
            <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
                @if($ba->gambar)
                <div style="height: 200px; background-image: url('{{ asset('storage/'.$ba->gambar) }}'); background-size: cover; background-position: center; position: relative;">
                @else
                <div style="height: 200px; background: linear-gradient(135deg, var(--navy), var(--orange)); position: relative;">
                @endif
                    <div style="position: absolute; top: 16px; left: 16px; background: var(--orange); color: #fff; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px;">{{ $ba->kategori }}</div>
                </div>
                <div style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
                    <div style="font-size: 12px; font-family: monospace; color: var(--muted); margin-bottom: 8px;">{{ $ba->tanggal->format('d M Y') }}</div>
                    <h3 style="font-size: 16px; font-weight: 800; color: var(--navy); margin: 0 0 12px; line-height: 1.4;">{{ $ba->judul }}</h3>
                    <p style="font-size: 13.5px; color: var(--muted); line-height: 1.6; margin: 0 0 24px; flex: 1;">{{ $ba->ringkasan }}</p>
                    <a href="{{ route('berita-acara.show', $ba->id) }}" style="color: var(--orange); font-size: 13px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                        Lihat Detail
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Rekap Kehadiran -->
    <div style="margin-bottom: 60px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Rekap Kehadiran Pembinaan</h2>
                <p style="color: var(--muted); font-size: 15px; margin: 0;">Data kehadiran OPD per sesi pembinaan tahun 2026.</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <select style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 14px center; background-size: 14px; -webkit-appearance: none; appearance: none; cursor: pointer;">
                    <option>Semua Program</option>
                </select>
                <button style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background: #fff; border: 1px solid var(--line); color: var(--ink); border-radius: 8px; font-weight: 600; font-size: 13.5px; box-shadow: var(--shadow-sm); cursor: pointer;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Ekspor
                </button>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 24px;">
            <!-- Table -->
            <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm);" x-data="{ perPage: 10, page: 1 }">
                <div style="padding: 16px 20px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 13.5px; color: var(--muted);">Tampilkan</span>
                        <select x-model.number="perPage" style="padding: 6px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; outline: none;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span style="font-size: 13.5px; color: var(--muted);">entri</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                                <th style="padding: 16px 20px; text-align: left; font-weight: 700; color: var(--navy);">OPD</th>
                                @foreach($sesiPembinaan as $index => $sesi)
                                <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); white-space: nowrap;">Sesi {{ $index + 1 }}</th>
                                @endforeach
                                <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 90px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekapKehadiran as $idx => $rekap)
                            <tr style="border-bottom: 1px solid var(--line);" x-show="page === Math.ceil({{ $idx + 1 }} / perPage)">
                                <td style="padding: 16px 20px; font-weight: 600; color: var(--ink);">
                                    {{ $rekap['dinas']->nama }}
                                </td>
                                @foreach($sesiPembinaan as $sesi)
                                <td style="padding: 16px; text-align: center;">
                                    @if(isset($rekap['kehadiran'][$sesi->id]) && $rekap['kehadiran'][$sesi->id])
                                        <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--orange-50); color: var(--orange); display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                    @else
                                        <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--bg); color: var(--muted); display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg></div>
                                    @endif
                                </td>
                                @endforeach
                                <td style="padding: 16px; text-align: center; font-weight: 700; color: var(--orange);">{{ $rekap['total'] }}/{{ $totalSesi }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ count($sesiPembinaan) + 2 }}" style="padding: 40px; text-align: center; color: var(--muted);">
                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <div style="font-weight: 600;">Belum ada data rekap kehadiran</div>
                                    <div style="font-size: 13px; margin-top: 6px;">Kehadiran OPD akan muncul setelah sesi pembinaan berjalan.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div style="padding: 16px 20px; border-top: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 13.5px; color: var(--muted);">
                        Menampilkan entri dari total {{ count($rekapKehadiran) }}
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button @click="if(page > 1) page--" style="padding: 6px 12px; border: 1px solid var(--line); background: #fff; border-radius: 6px; font-size: 13px; cursor: pointer;" :style="page === 1 ? 'opacity: 0.5; cursor: not-allowed;' : ''">Sebelumnya</button>
                        <button @click="if(page < Math.ceil({{ count($rekapKehadiran) }} / perPage)) page++" style="padding: 6px 12px; border: 1px solid var(--line); background: #fff; border-radius: 6px; font-size: 13px; cursor: pointer;" :style="page >= Math.ceil({{ count($rekapKehadiran) }} / perPage) ? 'opacity: 0.5; cursor: not-allowed;' : ''">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pustaka Section -->
    <div id="materi">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Materi Pembinaan</h2>
                <p style="color: var(--muted); font-size: 15px; margin: 0;">Unduh modul, panduan, dan rekaman pembinaan statistik sektoral.</p>
            </div>
            <div style="position: relative;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" placeholder="Cari materi..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; width: 280px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm);">
            </div>
        </div>

        <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm);" x-data="{ perPage: 10, page: 1 }">
            <div style="padding: 16px 20px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 13.5px; color: var(--muted);">Tampilkan</span>
                    <select x-model.number="perPage" style="padding: 6px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; outline: none;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span style="font-size: 13.5px; color: var(--muted);">entri</span>
                </div>
            </div>
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                            <th style="padding: 16px 20px; text-align: left; font-weight: 700; color: var(--navy);">Judul Materi</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 120px;">Jenis</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 160px;">Tanggal</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 160px;">Unduh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materiPembinaan as $idx => $materi)
                        <tr style="border-bottom: 1px solid var(--line);" x-show="page === Math.ceil({{ $idx + 1 }} / perPage)">
                            <td style="padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
                                @if($materi->jenis == 'VIDEO')
                                <div style="width: 40px; height: 40px; background: rgba(235, 137, 27, 0.1); color: var(--orange); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                </div>
                                @elseif($materi->jenis == 'DOCX')
                                <div style="width: 40px; height: 40px; background: rgba(37, 99, 235, 0.1); color: #2563eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                @else
                                <div style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.1); color: #dc2626; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                @endif
                                <div>
                                    <div style="font-weight: 700; color: var(--navy); margin-bottom: 4px;">{{ $materi->judul }}</div>
                                    <div style="font-size: 12px; color: var(--muted);">{{ $materi->ukuran_file ?? '-' }}</div>
                                </div>
                            </td>
                            <td style="padding: 20px; text-align: center;">
                                @if($materi->jenis == 'VIDEO')
                                <span style="font-size: 10px; font-weight: 800; color: var(--orange); background: rgba(235, 137, 27, 0.1); padding: 4px 8px; border-radius: 4px;">VIDEO</span>
                                @elseif($materi->jenis == 'DOCX')
                                <span style="font-size: 10px; font-weight: 800; color: #2563eb; background: rgba(37, 99, 235, 0.1); padding: 4px 8px; border-radius: 4px;">DOCX</span>
                                @else
                                <span style="font-size: 10px; font-weight: 800; color: #dc2626; background: rgba(220, 38, 38, 0.1); padding: 4px 8px; border-radius: 4px;">PDF</span>
                                @endif
                            </td>
                            <td style="padding: 20px; text-align: center; color: var(--muted);">{{ $materi->tanggal ? $materi->tanggal->format('M Y') : '-' }}</td>
                            <td style="padding: 20px; text-align: center;">
                                @if($materi->jenis == 'VIDEO' && $materi->link_url)
                                <a href="{{ $materi->link_url }}" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border: 1px solid var(--ink); color: var(--ink); border-radius: 6px; font-weight: 600; font-size: 13px; text-decoration: none; background: transparent; transition: all 0.2s; cursor: pointer;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                    Putar Video
                                </a>
                                @elseif($materi->file_path || $materi->link_url)
                                <a href="{{ $materi->file_path ? asset('storage/' . $materi->file_path) : $materi->link_url }}" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border: 1px solid var(--orange); color: var(--orange); border-radius: 6px; font-weight: 600; font-size: 13px; text-decoration: none; background: transparent; transition: all 0.2s; cursor: pointer;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    Unduh
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 40px; text-align: center; color: var(--muted);">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <div style="font-weight: 600;">Belum ada materi pembinaan</div>
                                <div style="font-size: 13px; margin-top: 6px;">Materi akan muncul di sini setelah ditambahkan oleh admin.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="padding: 16px 20px; border-top: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
                <div style="font-size: 13.5px; color: var(--muted);">
                    Menampilkan entri dari total {{ count($materiPembinaan) }}
                </div>
                <div style="display: flex; gap: 8px;">
                    <button @click="if(page > 1) page--" style="padding: 6px 12px; border: 1px solid var(--line); background: #fff; border-radius: 6px; font-size: 13px; cursor: pointer;" :style="page === 1 ? 'opacity: 0.5; cursor: not-allowed;' : ''">Sebelumnya</button>
                    <button @click="if(page < Math.ceil({{ count($materiPembinaan) }} / perPage)) page++" style="padding: 6px 12px; border: 1px solid var(--line); background: #fff; border-radius: 6px; font-size: 13px; cursor: pointer;" :style="page >= Math.ceil({{ count($materiPembinaan) }} / perPage) ? 'opacity: 0.5; cursor: not-allowed;' : ''">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
