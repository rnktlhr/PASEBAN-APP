@extends('layouts.app')

@section('title', 'PASEBAN')
@section('meta_description', 'Dashboard pemantauan kegiatan statistik sektoral Kabupaten Bantul. Lihat progress Romantik, Metadata, Aliran Data, dan Monitoring Evaluasi.')

@section('content')
    {{-- Hero Section --}}
    <section
        style="background: linear-gradient(135deg, var(--navy) 0%, var(--navy-900) 60%, #021a3d 100%); color: #fff; position: relative; overflow: hidden; margin-top: -74px; padding-top: 74px;">

        {{-- glow --}}
        <div
            style="position: absolute; right: -100px; top: -100px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(235,137,27,.25), transparent 70%); border-radius: 50%;">
        </div>

        <div class="container hero-grid" style="padding-top: 72px; padding-bottom: 88px; position: relative;">
            <div style="min-width: 0;">
                <div class="anim-fade-up delay-1"
                    style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 12px; border-radius: 999px; background: rgba(235,137,27,.18); border: 1px solid rgba(235,137,27,.4); font-size: 12px; font-weight: 600; color: var(--orange); margin-bottom: 24px;">
                    <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--orange);"></span>
                    Periode Pelaporan &middot; Tahun {{ $tahun }}
                </div>
                <style>
                    @keyframes cursor-blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
                </style>
                <h1 class="hero-title anim-fade-up delay-2" style="margin: 0; min-height: 1.2em;" x-data="{ text1: '', text2: '', full1: 'Selamat Datang di ', full2: 'Paseban' }" x-init="
                    setTimeout(() => {
                        let typeLoop = () => {
                            let i = 0, j = 0;
                            text1 = '';
                            text2 = '';
                            
                            let typeChar = () => {
                                if (i < full1.length) {
                                    text1 += full1.charAt(i);
                                    i++;
                                    setTimeout(typeChar, Math.random() * 50 + 30);
                                } else if (j < full2.length) {
                                    text2 += full2.charAt(j);
                                    j++;
                                    // Make 'Paseban' type slightly slower for dramatic effect
                                    setTimeout(typeChar, Math.random() * 80 + 50);
                                } else {
                                    setTimeout(() => {
                                        let delChar = () => {
                                            if (text2.length > 0) {
                                                text2 = text2.slice(0, -1);
                                                setTimeout(delChar, 20);
                                            } else if (text1.length > 0) {
                                                text1 = text1.slice(0, -1);
                                                setTimeout(delChar, 20);
                                            } else {
                                                setTimeout(typeLoop, 800);
                                            }
                                        };
                                        delChar();
                                    }, 5000);
                                }
                            };
                            typeChar();
                        };
                        typeLoop();
                    }, 400);
                ">
                    <span x-text="text1" style="color: #fff;"></span><span
                        style="background: linear-gradient(120deg, #fff 0%, var(--orange) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;" x-text="text2"></span>
                </h1>
                <p class="anim-fade-up delay-3"
                    style="margin: 20px 0 0; max-width: 560px; font-size: 17px; line-height: 1.6; color: rgba(255,255,255,.78); font-weight: 400;">
                    <strong style="color: #fff; font-weight: 600;">Pemantauan Statistik Sektoral Bantul</strong> — platform
                    terpadu BPS Kabupaten Bantul untuk pembinaan, pendampingan, dan monitoring kegiatan statistik sektoral
                    di lingkungan Pemerintah Kabupaten Bantul.
                </p>

                <div class="hero-stats">
                    <div class="anim-fade-up" style="animation-delay: 400ms;">
                        <div class="mono" style="font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -.5px;"
                             x-data="{ 
                                 count: 0, target: {{ $totalDinas }},
                                 animate() {
                                     this.count = 0;
                                     let step = this.target / 40;
                                     let int = setInterval(() => { this.count += step; if(this.count >= this.target){ this.count = this.target; clearInterval(int); } }, 30);
                                 }
                             }" 
                             x-init="setTimeout(() => animate(), 600)"
                             @slider-changed.window="animate()"
                             x-text="Math.floor(count)">0</div>
                        <div
                            style="font-size: 11.5px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 2px;">
                            OPD Terdaftar</div>
                    </div>
                    <div class="anim-fade-up" style="animation-delay: 550ms;">
                        <div class="mono" style="font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -.5px;"
                             x-data="{ 
                                 count: 0, target: {{ $totalKegiatan }},
                                 animate() {
                                     this.count = 0;
                                     let step = this.target / 40;
                                     let int = setInterval(() => { this.count += step; if(this.count >= this.target){ this.count = this.target; clearInterval(int); } }, 30);
                                 }
                             }" 
                             x-init="setTimeout(() => animate(), 750)"
                             @slider-changed.window="setTimeout(() => animate(), 150)"
                             x-text="Math.floor(count)">0</div>
                        <div
                            style="font-size: 11.5px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 2px;">
                            Kegiatan {{ $tahun }}</div>
                    </div>
                    <div class="anim-fade-up" style="animation-delay: 700ms;">
                        <div class="mono" style="font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -.5px;"
                             x-data="{ 
                                 count: 0, target: {{ $tingkatRespon }},
                                 animate() {
                                     this.count = 0;
                                     let step = this.target / 40;
                                     let int = setInterval(() => { this.count += step; if(this.count >= this.target){ this.count = this.target; clearInterval(int); } }, 30);
                                 }
                             }" 
                             x-init="setTimeout(() => animate(), 900)"
                             @slider-changed.window="setTimeout(() => animate(), 300)"
                             ><span x-text="Math.floor(count)">0</span>%</div>
                        <div
                            style="font-size: 11.5px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 2px;">
                            Tingkat Respon</div>
                    </div>
                </div>
            </div>

            <div style="position: relative; height: 380px;" x-data="heroSlider" x-init="start()">
                <div class="anim-chart"
                    style="position: absolute; top: 20px; right: 0; width: 100%; background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.02) 100%); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 22px 22px 10px; backdrop-filter: blur(12px); box-shadow: 0 10px 40px rgba(0,0,0,0.25); transform: rotate(2deg);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0px;">
                        <span class="mono"
                            :style="`transition: opacity 0.3s ease, transform 0.3s ease; opacity: ${isChanging ? 0 : 1}; transform: translateY(${isChanging ? '4px' : '0'}); letter-spacing: 1.5px; font-size: 10.5px; font-weight: 600; color: rgba(255,255,255,.8); display: inline-block;`" x-html="slides[active].title + ' &middot; {{ $tahun }}'">ROMANTIK
                            &middot; {{ $tahun }}</span>
                        <span
                            style="color: #00B69B; font-weight: 700; letter-spacing: 1px; font-size: 10px; display: flex; align-items: center; gap: 5px;">
                            <span
                                style="width: 6px; height: 6px; background: #00B69B; border-radius: 50%; box-shadow: 0 0 6px #00B69B;"></span>
                            LIVE
                        </span>
                    </div>
                    <div id="hero-mini-chart" style="height: 140px; width: 100%;"></div>
                </div>
                <div class="anim-card"
                    style="position: absolute; bottom: 0; left: 20px; width: 220px; background: rgba(255,255,255,.96); color: var(--ink); border-radius: 14px; padding: 16px; box-shadow: 0 24px 60px rgba(0,0,0,.4); transform: rotate(-3deg);">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                        <div
                            style="width: 36px; height: 36px; border-radius: 10px; background: #e6f8f5; color: #00B69B; display: grid; place-items: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        <div>
                            <div
                                style="font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">
                                Status</div>
                            <div :style="`transition: opacity 0.3s ease, transform 0.3s ease; opacity: ${isChanging ? 0 : 1}; transform: translateY(${isChanging ? '2px' : '0'}); font-size: 14px; font-weight: 700; display: block;`" x-text="slides[active].cardTitle">Romantik Disetujui</div>
                        </div>
                    </div>
                    <div style="height: 6px; background: #eef0f4; border-radius: 3px; overflow: hidden;">
                        <div
                            :style="`width: ${slides[active].cardPct}%; height: 100%; background: linear-gradient(90deg, #00B69B, #34d399); transition: width 0.8s cubic-bezier(0.16, 1, 0.3, 1);`">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 8px; font-size: 11px; color: var(--muted);"
                        class="mono">
                        <span x-text="animValue + ' / ' + slides[active].cardTotal">{{ $romantikDiajukan }} / {{ $totalKegiatan }}</span><span x-text="animPct + '%'">{{ $pctRomantik }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Summary Cards --}}
    <section style="padding: 72px 0 40px;">
        <div class="container">
            <div class="scroll-reveal" style="margin-bottom: 28px;">
                <div
                    style="font-size: 12px; letter-spacing: 1.5px; color: var(--orange-600); text-transform: uppercase; font-weight: 700; margin-bottom: 6px;">
                    ◆ Ringkasan Statistik</div>
                <h2 style="margin: 0; font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px;">
                    Ringkasan Kegiatan Statistik</h2>
                <p style="margin: 8px 0 0; color: var(--muted); font-size: 14.5px;">Capaian kegiatan statistik sektoral
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
                    <a href="{{ $card['url'] }}" class="card-link scroll-reveal" style="--delay: {{ $index * 100 }}ms;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                            <div
                                style="width: 44px; height: 44px; border-radius: 10px; background: var(--orange-50); color: var(--orange-600); display: grid; place-items: center;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $card['icon'] !!}</svg>
                            </div>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" style="color: var(--muted);">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>
                        <h3 style="margin: 0 0 16px; font-size: 15.5px; font-weight: 700; color: var(--navy);">
                            {{ $card['title'] }}</h3>
                        <div style="display: flex; gap: 20px; align-items: flex-end;">
                            <div>
                                <span class="mono" x-data="countUp({{ $card['value'] }})" x-text="count"
                                    style="font-size: 28px; font-weight: 800; color: var(--ink); letter-spacing: -.5px; line-height: 1;">0</span>
                                <span
                                    style="font-size: 13px; color: var(--muted); margin-left: 6px;">{{ $card['label'] }}</span>
                            </div>
                            @if($card['sub'])
                                <div>
                                    <span class="mono" x-data="countUp({{ $card['sub']['value'] }})" x-text="count"
                                        style="font-size: 16px; font-weight: 600; color: var(--muted);">0</span>
                                    <span
                                        style="font-size: 12px; color: var(--muted); margin-left: 4px;">{{ $card['sub']['label'] }}</span>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Visualisasi Data Section --}}
    <section style="padding: 20px 0 80px;">
        <div class="container">
            <div class="scroll-reveal" style="margin-bottom: 28px;">
                <div
                    style="font-size: 12px; letter-spacing: 1.5px; color: var(--orange-600); text-transform: uppercase; font-weight: 700; margin-bottom: 6px;">
                    ◆ Visualisasi Data</div>
                <h2 style="margin: 0; font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px;">
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
        style="padding: 72px 0; background: #fff; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line);">
        <div class="container scroll-reveal">
            <livewire:monev-calendar :tahun-awal="$tahun" />
        </div>
    </section>

    {{-- Pembinaan Section --}}
    <section style="padding: 72px 0;">
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
                    <div
                        style="font-size: 12px; letter-spacing: 1.5px; color: var(--orange); text-transform: uppercase; font-weight: 700; margin-bottom: 10px;">
                        ◆ Pembinaan Statistik</div>
                    <h2 style="margin: 0; font-size: 30px; font-weight: 800; letter-spacing: -.6px; line-height: 1.15;">
                        Pembinaan Statistik Sektoral Kabupaten Bantul</h2>
                    <p
                        style="margin: 14px 0 24px; font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,.78); max-width: 540px;">
                        Materi dan dokumentasi pembinaan kegiatan statistik sektoral — akses panduan teknis, regulasi, dan
                        modul pelatihan untuk seluruh OPD se-Kabupaten Bantul.
                    </p>
                    <a href="{{ config('paseban.pedoman_url') }}" target="_blank" rel="noopener noreferrer"
                        style="display: inline-flex; align-items: center; gap: 10px; padding: 13px 22px; border-radius: 6px; background: var(--orange); color: #fff; font-weight: 700; font-size: 14px; box-shadow: 0 6px 18px rgba(235,137,27,.4); text-decoration: none; transition: transform .15s ease;">
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
                            Penyusunan Metadata Kegiatan</div>
                        <div
                            style="margin-top: 14px; height: 4px; background: #eef0f4; border-radius: 2px; overflow: hidden;">
                            <div style="width: {{ $pctMetadata }}%; height: 100%; background: var(--orange);"></div>
                        </div>
                        <div class="mono"
                            style="font-size: 10px; color: var(--muted); margin-top: 6px; letter-spacing: .5px;">
                            {{ $metaKegiatanDone }} / {{ $metaKegiatanTotal }} kegiatan selesai</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Berita Acara Section --}}
    <section style="padding: 72px 0; background: #fff; border-top: 1px solid var(--line);">
        <div class="container">
            <div style="margin-bottom: 28px;">
                <div
                    style="font-size: 12px; letter-spacing: 1.5px; color: var(--orange-600); text-transform: uppercase; font-weight: 700; margin-bottom: 6px;">
                    ◆ Berita Acara</div>
                <h2 style="margin: 0; font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px;">Berita
                    Acara Kegiatan</h2>
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
                    @foreach($beritaAcara as $berita)
                        <div style="flex: 0 0 calc(33.333% - 14px); min-width: 300px; scroll-snap-align: start; display: flex;">
                            <a href="{{ route('berita-acara.show', $berita) }}" style="width: 100%; text-decoration: none; color: inherit; border-radius: var(--radius); overflow: hidden; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-sm); display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--shadow-sm)';">
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
                <a href="{{ route('berita-acara.index') }}" class="btn-outline-orange">
                    Lihat Semua Berita Acara
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            

        });

        // Alpine.js component for hero slider
        document.addEventListener('alpine:init', () => {

            Alpine.data('heroSlider', () => ({
                active: 0,
                animValue: 0,
                animPct: 0,
                isChanging: false,
                chartInstance: null,
                slides: [
                    { 
                        title: 'ROMANTIK', 
                        cardTitle: 'Romantik Disetujui',
                        cardValue: {{ $romantikDiajukan }},
                        cardTotal: {{ $totalKegiatan }},
                        cardPct: {{ $pctRomantik }},
                        chartData: @json($heroMonthlyRomantik)
                    },
                    { 
                        title: 'METADATA', 
                        cardTitle: 'Metadata Terisi',
                        cardValue: {{ $metaKegiatanDone }},
                        cardTotal: {{ $metaKegiatanTotal ?: 1 }},
                        cardPct: {{ $pctMetadata }},
                        chartData: @json($heroMonthlyMetadata)
                    },
                    { 
                        title: 'ALIRAN DATA', 
                        cardTitle: 'Data Sudah Tayang',
                        cardValue: {{ $aliranTayang }},
                        cardTotal: {{ $aliranTotal ?: 1 }},
                        cardPct: {{ $pctAliran }},
                        chartData: @json($heroMonthlyAliran)
                    }
                ],
                start() {
                    this.animValue = this.slides[0].cardValue;
                    this.animPct = this.slides[0].cardPct;
                    this.initChart();
                    setInterval(() => {
                        this.isChanging = true;
                        setTimeout(() => {
                            this.active = (this.active + 1) % this.slides.length;
                            this.updateChart();
                            this.animateCardValues();
                            window.dispatchEvent(new CustomEvent('slider-changed'));
                            this.isChanging = false;
                        }, 300);
                    }, 10000); // changes every 10 seconds
                },
                animateCardValues() {
                    let targetValue = this.slides[this.active].cardValue;
                    let targetPct = this.slides[this.active].cardPct;
                    let startValue = this.animValue;
                    let startPct = this.animPct;
                    let duration = 800;
                    let startTime = null;
                    
                    let step = (timestamp) => {
                        if (!startTime) startTime = timestamp;
                        let progress = Math.min((timestamp - startTime) / duration, 1);
                        // easeOut cubic
                        let ease = 1 - Math.pow(1 - progress, 3);
                        
                        this.animValue = Math.round(startValue + (targetValue - startValue) * ease);
                        this.animPct = Math.round(startPct + (targetPct - startPct) * ease);
                        
                        if (progress < 1) requestAnimationFrame(step);
                    };
                    requestAnimationFrame(step);
                },
                initChart() {
                    const options = {
                        series: [{ name: 'Total', data: this.slides[this.active].chartData }],
                        chart: {
                            type: 'bar',
                            height: 150,
                            toolbar: { show: false },
                            parentHeightOffset: 0,
                            animations: { enabled: true, dynamicAnimation: { speed: 800 } }
                        },
                        colors: ['#00B69B'],
                        plotOptions: { 
                            bar: { 
                                columnWidth: '55%', 
                                borderRadius: 3,
                                colors: { 
                                    backgroundBarColors: ['rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)'], 
                                    backgroundBarRadius: 3 
                                },
                                dataLabels: { position: 'center' }
                            } 
                        },
                        xaxis: {
                            categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                            labels: { style: { colors: 'rgba(255,255,255,0.5)', fontSize: '9px', fontFamily: 'JetBrains Mono', fontWeight: 600 } },
                            axisBorder: { show: false },
                            axisTicks: { show: false }
                        },
                        yaxis: { show: false, min: 0, max: this.slides[this.active].cardTotal },
                        grid: { show: false, padding: { top: 0, right: 0, bottom: 0, left: 10 } },
                        dataLabels: { 
                            enabled: true,
                            formatter: function(val) { return val > 0 ? val : ''; },
                            style: { colors: ['#ffffff'], fontSize: '10px', fontFamily: 'JetBrains Mono', fontWeight: 700 },
                            offsetY: 0
                        },
                        tooltip: { enabled: false }
                    };
                    this.chartInstance = new ApexCharts(document.querySelector("#hero-mini-chart"), options);
                    this.chartInstance.render();
                },
                updateChart() {
                    if(this.chartInstance) {
                        this.chartInstance.updateOptions({
                            yaxis: { min: 0, max: this.slides[this.active].cardTotal, show: false }
                        }, false, false);
                        this.chartInstance.updateSeries([{
                            data: this.slides[this.active].chartData
                        }]);
                    }
                }
            }));
        });
    </script>
@endpush