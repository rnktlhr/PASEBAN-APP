@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 40px 32px 0;">
        <div style="margin-bottom: 32px;">
            <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Pemantauan Aliran Data</h1>
            <p style="color: var(--muted); font-size: 15px; margin: 0;">Status publikasi dan pemantauan aliran data statistik sektoral di Sedata Sebantul oleh OPD.</p>
        </div>

        {{-- Banner Top --}}
        <div class="scroll-reveal"
            style="background: #f0f4f8; border: 1px solid #dce4ec; border-radius: 12px; padding: 24px; display: flex; align-items: center; justify-content: space-between; gap: 24px; margin-bottom: 24px; flex-wrap: wrap;">
            <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div
                    style="background: #fff; width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm); flex-shrink: 0; color: #002B6A;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 11px; font-weight: 800; color: #002B6A; letter-spacing: 1px; text-transform: uppercase;">
                        Pemantauan Aliran Data Statistik Sektoral
                    </div>
                    <div style="font-size: 14px; color: var(--muted); margin-top: 6px; line-height: 1.5;">
                        Sistem memantau secara riil <strong>{{ number_format($totalIndikator, 0, ',', '.') }} indikator data</strong> dari <strong>{{ $totalData }} instansi (OPD/Kapanewon)</strong> yang terpublikasi di portal Sedata Sebantul. Pemutakhiran terkini: <strong>{{ $terbaruPemutakhiran }}</strong>.
                    </div>
                </div>
            </div>
            <a href="https://data.bantulkab.go.id/" target="_blank"
                style="background: #EB891B; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; flex-shrink: 0; transition: background 0.2s;"
                onmouseover="this.style.background='#d27814'" onmouseout="this.style.background='#EB891B'">
                Buka Sedata Sebantul <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
            </a>
        </div>

        {{-- 4 KPI Stat Cards Grid --}}
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;" class="stats-cards-grid">
            {{-- Card 1: Total Data Indikator --}}
            <div class="scroll-reveal"
                style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; --delay: 100ms;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Total Data Indikator</div>
                    <div
                        style="color: #002B6A; background: rgba(0, 43, 106, 0.06); width: 32px; height: 32px; border-radius: 8px; display: grid; place-items: center; flex-shrink: 0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="mono"
                        style="margin-top: 14px; font-size: 28px; font-weight: 800; color: var(--navy); line-height: 1;"
                        x-data="countUp({{ $totalIndikator }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">
                        indikator statistik aktif
                    </div>
                </div>
            </div>

            {{-- Card 2: Total OPD Dipantau --}}
            <div class="scroll-reveal"
                style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; --delay: 200ms;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Total OPD Dipantau</div>
                    <div
                        style="color: #002B6A; background: rgba(0, 43, 106, 0.06); width: 32px; height: 32px; border-radius: 8px; display: grid; place-items: center; flex-shrink: 0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                            <line x1="9" y1="22" x2="9" y2="22.01"></line>
                            <line x1="15" y1="22" x2="15" y2="22.01"></line>
                            <line x1="9" y1="6" x2="9" y2="6.01"></line>
                            <line x1="15" y1="6" x2="15" y2="6.01"></line>
                            <line x1="9" y1="10" x2="9" y2="10.01"></line>
                            <line x1="15" y1="10" x2="15" y2="10.01"></line>
                            <line x1="9" y1="14" x2="9" y2="14.01"></line>
                            <line x1="15" y1="14" x2="15" y2="14.01"></line>
                            <line x1="9" y1="18" x2="9" y2="18.01"></line>
                            <line x1="15" y1="18" x2="15" y2="18.01"></line>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="mono"
                        style="margin-top: 14px; font-size: 28px; font-weight: 800; color: var(--navy); line-height: 1;"
                        x-data="countUp({{ $totalData }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">
                        instansi di Kab. Bantul
                    </div>
                </div>
            </div>

            {{-- Card 3: OPD Sudah Tayang --}}
            <div class="scroll-reveal"
                style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; --delay: 300ms;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="font-size: 13px; font-weight: 600; color: var(--muted);">OPD Sudah Tayang</div>
                    <div
                        style="color: #00B69B; background: rgba(0, 182, 155, 0.08); width: 32px; height: 32px; border-radius: 8px; display: grid; place-items: center; flex-shrink: 0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="mono"
                        style="margin-top: 14px; font-size: 28px; font-weight: 800; color: #00B69B; line-height: 1;"
                        x-data="countUp({{ $sudahTayang }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">
                        {{ $pctTayang }}% instansi terpublikasi
                    </div>
                </div>
            </div>

            {{-- Card 4: OPD Belum Tayang --}}
            <div class="scroll-reveal"
                style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; --delay: 400ms;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="font-size: 13px; font-weight: 600; color: var(--muted);">OPD Belum Tayang</div>
                    <div
                        style="color: #EB891B; background: rgba(235, 137, 27, 0.08); width: 32px; height: 32px; border-radius: 8px; display: grid; place-items: center; flex-shrink: 0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="mono"
                        style="margin-top: 14px; font-size: 28px; font-weight: 800; color: #EB891B; line-height: 1;"
                        x-data="countUp({{ $belumTayang }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">
                        {{ $pctBelum }}% belum tayang
                    </div>
                </div>
            </div>
        </div>

        {{-- 2 Visualizations Grid --}}
        <div style="display: grid; grid-template-columns: 1fr 1.15fr; gap: 24px; margin-bottom: 32px;" class="visual-cards-grid">
            {{-- Visual Kiri: Donut Chart Status Publikasi OPD --}}
            <div class="scroll-reveal"
                style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; --delay: 150ms;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div>
                            <div style="font-size: 11px; font-weight: 700; color: var(--muted); letter-spacing: 1px; text-transform: uppercase;">
                                Distribusi Publikasi
                            </div>
                            <h3 style="margin: 4px 0 0; font-size: 17px; font-weight: 800; color: var(--navy);">
                                Status Publikasi OPD
                            </h3>
                        </div>
                        <div style="border: 1px solid var(--line); border-radius: 6px; padding: 5px 12px; font-size: 12px; font-weight: 700; color: var(--navy);">
                            Tahun {{ $tahun }}
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; align-items: center; min-height: 210px; margin: 8px 0;">
                        <div id="aliran-donut-chart"></div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 16px;">
                        <div style="border: 1px solid var(--line); border-radius: 8px; padding: 12px 16px; background: #f8fafc; display: flex; align-items: center; gap: 10px;">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: #002B6A; flex-shrink: 0;"></span>
                            <div>
                                <div style="font-size: 12px; color: var(--muted); font-weight: 600;">Sudah Tayang</div>
                                <div style="font-size: 16px; font-weight: 800; color: #002B6A; font-family: 'JetBrains Mono', monospace;">
                                    {{ $sudahTayang }} <span style="font-size: 12px; font-weight: 600; color: var(--muted);">({{ $pctTayang }}%)</span>
                                </div>
                            </div>
                        </div>

                        <div style="border: 1px solid var(--line); border-radius: 8px; padding: 12px 16px; background: #f8fafc; display: flex; align-items: center; gap: 10px;">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: #EB891B; flex-shrink: 0;"></span>
                            <div>
                                <div style="font-size: 12px; color: var(--muted); font-weight: 600;">Belum Tayang</div>
                                <div style="font-size: 16px; font-weight: 800; color: var(--muted); font-family: 'JetBrains Mono', monospace;">
                                    {{ $belumTayang }} <span style="font-size: 12px; font-weight: 600; color: var(--muted);">({{ $pctBelum }}%)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid var(--line); font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 8px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00B69B" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Seluruh <strong>{{ $totalData }} instansi</strong> telah aktif mengalirkan data ke Sedata Sebantul.</span>
                </div>
            </div>

            {{-- Visual Kanan: Volume Indikator Top 5 OPD --}}
            <div class="scroll-reveal"
                style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; --delay: 250ms;">
                <div>
                    <div style="margin-bottom: 20px;">
                        <div style="font-size: 11px; font-weight: 700; color: var(--muted); letter-spacing: 1px; text-transform: uppercase;">
                            Volume Data Riil
                        </div>
                        <h3 style="margin: 4px 0 0; font-size: 17px; font-weight: 800; color: var(--navy);">
                            Top 5 OPD Volume Indikator Terbanyak
                        </h3>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        @foreach($topDinas as $namaDinas => $jumlah)
                            @php
                                $pct = $maxTopDinas > 0 ? round(($jumlah / $maxTopDinas) * 100) : 0;
                            @endphp
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <span style="font-size: 13.5px; font-weight: 600; color: var(--navy);" title="{{ $namaDinas }}">
                                        {{ $namaDinas }}
                                    </span>
                                    <span style="font-size: 13px; font-weight: 800; color: #002B6A; font-family: 'JetBrains Mono', monospace; flex-shrink: 0; margin-left: 12px;">
                                        {{ number_format($jumlah, 0, ',', '.') }} <span style="font-size: 11px; font-weight: 500; color: var(--muted);">data</span>
                                    </span>
                                </div>
                                <div style="width: 100%; height: 6px; background: #f1f5f9; border-radius: 999px; overflow: hidden;">
                                    <div style="width: {{ $pct }}%; height: 100%; background: linear-gradient(90deg, #002B6A, #0052cc); border-radius: 999px;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid var(--line); font-size: 12px; color: var(--muted); display: flex; justify-content: space-between; align-items: center;">
                    <span>Total seluruh indikator terpublikasi:</span>
                    <strong style="color: #002B6A; font-family: 'JetBrains Mono', monospace; font-size: 13px;">{{ number_format($totalIndikator, 0, ',', '.') }} Data</strong>
                </div>
            </div>
        </div>
    </div>

    <livewire:public-aliran-data-table :tahun="$tahun" />

    <style>
        @media (max-width: 1024px) {
            .stats-cards-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .visual-cards-grid {
                grid-template-columns: 1fr !important;
            }
        }
        @media (max-width: 640px) {
            .stats-cards-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const options = {
                series: [{{ $sudahTayang }}, {{ $belumTayang }}],
                labels: ['Sudah Tayang', 'Belum Tayang'],
                chart: {
                    type: 'donut',
                    height: 200,
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: { enabled: true, delay: 150 },
                        dynamicAnimation: { enabled: true, speed: 350 }
                    }
                },
                colors: ['#002B6A', '#EB891B'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                name: { show: true, color: '#6B6560', fontSize: '10px', fontWeight: 700, fontFamily: 'Inter', offsetY: 24 },
                                value: { show: true, color: '#002B6A', fontSize: '32px', fontWeight: 800, fontFamily: 'JetBrains Mono', offsetY: -8 },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'SUDAH TAYANG',
                                    fontSize: '10px',
                                    fontWeight: 700,
                                    color: '#6B6560',
                                    formatter: function (w) { return "{{ $pctTayang }}%"; }
                                }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false },
                stroke: { width: 3, colors: ['#fff'] },
                legend: { show: false },
                tooltip: {
                    enabled: true,
                    theme: 'light',
                    fillSeriesColor: true,
                    y: { formatter: function (val) { return val + " data" } }
                }
            };

            const chart = new ApexCharts(document.querySelector("#aliran-donut-chart"), options);
            chart.render();
        });
    </script>
@endpush