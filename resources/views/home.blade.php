@extends('layouts.app')

@section('title', 'PASEBAN')
@section('meta_description', 'Dashboard pemantauan kegiatan statistik sektoral Kabupaten Bantul. Lihat progress Romantik, Metadata, Aliran Data, dan Monitoring Evaluasi.')

@section('content')
    @include('partials.home-hero')

    {{-- Summary Cards --}}
    <section style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; padding: 60px 0;">
        <div class="container">
            <div class="scroll-reveal" style="margin-bottom: 40px;">
                <h2 style="margin: 0; font-size: 38px; font-weight: 800; color: var(--navy); letter-spacing: -.8px;">
                    Ringkasan Kegiatan Statistik</h2>
                <p style="margin: 12px 0 0; color: var(--muted); font-size: 16px;">Capaian kegiatan statistik sektoral
                    lintas OPD per tahun {{ $tahun }}.</p>
            </div>
            <div class="summary-cards-grid">
                @php
                    $cards = [
                        ['icon' => '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>', 'title' => 'Identifikasi Kegiatan Statistik', 'value' => $totalKegiatan, 'label' => 'kegiatan tahun ini', 'sub' => null, 'url' => route('public.kegiatan')],
                        ['icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><polyline points="9 15 11 17 15 13"/>', 'title' => 'Romantik', 'value' => $romantikDiajukan, 'label' => 'sudah diajukan', 'sub' => ['value' => $romantikBelum, 'label' => 'belum diajukan'], 'url' => route('public.romantik')],
                        ['icon' => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>', 'title' => 'Metadata Kegiatan', 'value' => $metaKegiatanDone, 'label' => 'sudah menyusun', 'sub' => ['value' => $metaKegiatanTotal - $metaKegiatanDone, 'label' => 'belum menyusun'], 'url' => route('public.metadata')],
                        ['icon' => '<line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>', 'title' => 'Metadata Variabel', 'value' => $metaVariabelDone, 'label' => 'sudah menyusun', 'sub' => ['value' => $metaVariabelTotal - $metaVariabelDone, 'label' => 'belum menyusun'], 'url' => route('public.metadata')],
                        ['icon' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>', 'title' => 'Metadata Indikator', 'value' => $metaIndikatorDone, 'label' => 'sudah menyusun', 'sub' => ['value' => $metaIndikatorTotal - $metaIndikatorDone, 'label' => 'belum menyusun'], 'url' => route('public.metadata')],
                        ['icon' => '<path d="M21.2 15c.7-1.2 1-2.5.7-3.9-.6-2-2.4-3.5-4.4-3.5h-1.2c-.7-3-3.2-5.2-6.2-5.6-3-.3-5.9 1.3-7.3 4-1.2 2.5-1 6.5.5 8.8m8.7-1.6V21"/><path d="M16 16l-4-4-4 4"/>', 'title' => 'Aliran Data Sedata Sebantul', 'value' => $aliranTayang, 'label' => 'sudah tayang', 'sub' => ['value' => $aliranBelum, 'label' => 'belum tayang'], 'url' => route('public.aliran_data')],
                    ];
                @endphp
                @foreach($cards as $index => $card)
                    <a href="{{ $card['url'] }}" class="card-link scroll-reveal" style="--delay: {{ $index * 100 }}ms; padding: 28px; display: flex; flex-direction: column; min-height: 220px;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                            <div
                                style="width: 52px; height: 52px; border-radius: 12px; background: var(--orange-50); color: var(--orange-600); display: grid; place-items: center;">
                                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $card['icon'] !!}</svg>
                            </div>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" style="color: var(--muted);">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>
                        <h3 style="margin: 0 0 auto; font-size: 18px; font-weight: 700; color: var(--navy); line-height: 1.4;">
                            {{ $card['title'] }}</h3>
                        <div style="display: flex; gap: 24px; align-items: flex-end; margin-top: 24px;">
                            <div>
                                <span class="mono" x-data="countUp({{ $card['value'] }})" x-text="count"
                                    style="font-size: 36px; font-weight: 800; color: var(--ink); letter-spacing: -.5px; line-height: 1;">0</span>
                                <span
                                    style="font-size: 14px; color: var(--muted); margin-left: 6px; font-weight: 500;">{{ $card['label'] }}</span>
                            </div>
                            @if($card['sub'])
                                <div style="padding-bottom: 4px;">
                                    <span class="mono" x-data="countUp({{ $card['sub']['value'] }})" x-text="count"
                                        style="font-size: 18px; font-weight: 700; color: var(--muted);">0</span>
                                    <span
                                        style="font-size: 13px; color: var(--muted); margin-left: 4px;">{{ $card['sub']['label'] }}</span>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Visualisasi Data Section --}}
    <section style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; padding: 60px 0;">
        <div class="container">
            <div class="scroll-reveal" style="margin-bottom: 28px;">
                <h2 style="margin: 0; font-size: 38px; font-weight: 800; color: var(--navy); letter-spacing: -.8px;">
                    Visualisasi Progress Pemantauan</h2>
                <p style="margin: 8px 0 0; color: var(--muted); font-size: 14.5px;">Klik diagram untuk melihat rincian per
                    dinas.</p>
            </div>
            <div class="scroll-reveal" style="--delay: 100ms;">
                @include('partials.dashboard-charts')
            </div>
        </div>
    </section>

    {{-- Monitoring & Evaluasi Section --}}
    <section
        style="padding: 60px 0; background: #fff; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); min-height: 100vh; display: flex; flex-direction: column; justify-content: center;">
        <div class="container scroll-reveal">
            <livewire:monev-calendar :tahun-awal="$tahun" />
        </div>
    </section>

    {{-- Pembinaan Section --}}
    <section style="padding: 80px 0;">
        <div class="container">
            <div
                style="background: var(--navy); border-radius: 12px; padding: 44px 48px; display: grid; grid-template-columns: 1.6fr 1fr; gap: 32px; align-items: center; position: relative; overflow: hidden;" class="cards-grid">
                <svg style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: .08;" aria-hidden="true">
                    <defs>
                        <pattern id="dots" width="22" height="22" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1.2" fill="#fff" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#dots)" />
                </svg>
                <div
                    style="position: absolute; right: -60px; top: -60px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(235,137,27,.35), transparent 65%); border-radius: 50%;">
                </div>

                <div style="position: relative; color: #fff;">
                    <h2 style="margin: 0; font-size: 38px; font-weight: 800; letter-spacing: -.8px; line-height: 1.15;">
                        Pembinaan Statistik Sektoral Kabupaten Bantul</h2>
                    <p
                        style="margin: 14px 0 24px; font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,.78); max-width: 540px;">
                        Materi dan dokumentasi pembinaan kegiatan statistik sektoral — akses panduan teknis, regulasi, dan
                        modul pelatihan untuk seluruh OPD se-Kabupaten Bantul.
                    </p>
                    <a href="https://bpsbantul.my.canva.site/pss2026" target="_blank" rel="noopener noreferrer" class="w-full-mobile" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 6px; background: var(--orange); color: #fff; font-weight: 700; font-size: 14px; text-decoration: none; box-shadow: 0 6px 18px rgba(235, 137, 27, 0.3); transition: all 0.2s;">
                        Masuk Modul Pembinaan <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                            <polyline points="15 3 21 3 21 9" />
                            <line x1="10" y1="14" x2="21" y2="3" />
                        </svg>
                    </a>
                </div>

                <div style="position: relative; display: flex; justify-content: center;">
                    <div
                        style="background: #fff; border-radius: 10px; width: 220px; padding: 18px; box-shadow: 0 20px 50px rgba(0,0,0,.3); transform: rotate(-3deg);">
                        <div
                            style="width: 40px; height: 40px; border-radius: 8px; background: var(--orange-50); color: var(--orange-600); display: grid; place-items: center; margin-bottom: 12px;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <div
                            style="font-size: 11px; color: var(--muted); font-weight: 600; letter-spacing: .5px; text-transform: uppercase;">
                            Tahun {{ $tahun }}</div>
                        <div
                            style="font-size: 14px; font-weight: 700; color: var(--navy); margin-top: 4px; line-height: 1.3;">
                            Tingkat Kehadiran Pembinaan</div>
                        <div
                            style="margin-top: 14px; height: 4px; background: #eef0f4; border-radius: 2px; overflow: hidden;">
                            <div style="width: {{ $pctKehadiran }}%; height: 100%; background: var(--orange);"></div>
                        </div>
                        <div class="mono"
                            style="font-size: 10px; color: var(--muted); margin-top: 6px; letter-spacing: .5px;">
                            {{ $totalKehadiran }} / {{ $maxKehadiran }} kehadiran OPD</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kegiatan Pendampingan Section --}}
    <section style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; padding: 60px 0; background: #fff; border-top: 1px solid var(--line);">
        <div class="container">
            <div style="margin-bottom: 28px;">
                <h2 style="margin: 0; font-size: 38px; font-weight: 800; color: var(--navy); letter-spacing: -.8px;">Kegiatan
                    Pendampingan</h2>
            </div>
            <style>
                .berita-slider::-webkit-scrollbar { display: none; }
            </style>
            <div x-data="{
                    timer: null,
                    start() {
                        if (this.$refs.slider.children.length > 3) {
                            this.timer = setInterval(() => this.next(), 4000);
                        }
                    },
                    pause() { clearInterval(this.timer); },
                    resume() { 
                        clearInterval(this.timer);
                        this.start(); 
                    },
                    next() {
                        const el = this.$refs.slider;
                        if (!el) return;
                        if (el.scrollLeft + el.clientWidth >= el.scrollWidth - 10) {
                            el.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            el.scrollBy({ left: el.children[0].offsetWidth + 20, behavior: 'smooth' });
                        }
                    }
                }" 
                x-init="start()" 
                @mouseenter="pause()" 
                @mouseleave="resume()"
                style="position: relative; margin: 0 -10px;">
                
                <div x-ref="slider" class="berita-slider" style="display: flex; gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory; padding: 10px; scrollbar-width: none; -ms-overflow-style: none;">
                    @foreach($kegiatanPendampingan as $berita)
                        <div style="flex: 0 0 calc(33.333% - 14px); min-width: 300px; scroll-snap-align: start; display: flex;">
                            <a href="{{ route('kegiatan-pendampingan.show', $berita) }}" style="width: 100%; text-decoration: none; color: inherit; border-radius: var(--radius); overflow: hidden; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-sm); display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--shadow-sm)';">
                                <div style="height: 180px; background: linear-gradient(135deg, var(--navy), var(--orange)); position: relative;">
                                    @php
                                        $coverImage = $berita->gambar ? asset('storage/' . $berita->gambar) : null;
                                        if (!$coverImage && $berita->narasi) {
                                            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $berita->narasi, $image);
                                            $coverImage = $image['src'] ?? null;
                                        }
                                    @endphp
                                    @if($coverImage)
                                        <img src="{{ $coverImage }}" alt="{{ $berita->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                    <div style="position: absolute; top: 14px; left: 14px; padding: 5px 10px; border-radius: 4px; background: var(--orange); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: .3px; z-index: 10;">
                                        {{ ucfirst($berita->kategori) }}</div>
                                </div>
                                <div style="padding: 22px; flex: 1; display: flex; flex-direction: column;">
                                    <div class="mono"
                                        style="font-size: 11px; color: var(--muted); letter-spacing: .8px; margin-bottom: 10px;">
                                        {{ $berita->tanggal->format('d M Y') }}</div>
                                    <h3
                                        style="margin: 0; font-size: 16.5px; line-height: 1.35; font-weight: 700; color: var(--navy); letter-spacing: -.2px;">
                                        {{ $berita->judul }}</h3>
                                    <p style="margin: 10px 0 16px; font-size: 13.5px; color: var(--muted); line-height: 1.55; flex: 1;">
                                        {{ Str::limit($berita->ringkasan, 150) }}</p>
                                    <div style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: var(--orange-600); margin-top: auto;">
                                        Lihat Detail
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div style="margin-top: 36px; text-align: center;">
                <a href="{{ route('kegiatan-pendampingan.index') }}" class="btn-outline-orange">
                    Lihat Semua Kegiatan Pendampingan
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0"></script>
@endpush
