@extends('layouts.app')

@section('title', 'Identifikasi Kegiatan Statistik — Paseban')

@section('content')
<div class="container" style="padding: 40px 32px 0;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Identifikasi Kegiatan Statistik</h1>
        <p style="color: var(--muted); font-size: 15px; margin: 0;">Daftar seluruh rancangan kegiatan statistik sektoral yang diidentifikasi dari OPD Kabupaten Bantul.</p>
    </div>

    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 24px; margin-bottom: 8px;" class="cards-grid">
        {{-- Card Kiri: Ringkasan Status --}}
        <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                <div>
                    <h2 style="margin: 0; font-size: 22px; font-weight: 800; color: var(--navy);">Capaian Identifikasi Kegiatan</h2>
                </div>
                <div style="padding: 6px 12px; background: #fff5eb; color: #EB891B; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: .5px;">
                    PER {{ strtoupper(date('d M Y')) }}
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="summary-stats-grid">
                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 100ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Total Kegiatan {{ $tahun }}</div>
                        <div style="color: var(--muted); background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: var(--navy); line-height: 1;" x-data="countUp({{ $totalKegiatan }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">kegiatan</div>
                </div>

                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 200ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Survei</div>
                        <div style="color: #002B6A; background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: #002B6A; line-height: 1;" x-data="countUp({{ $survei }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">{{ $pctSurvei }}% dari total</div>
                </div>

                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 300ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Pendataan Lengkap</div>
                        <div style="color: #00B69B; background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: #00B69B; line-height: 1;" x-data="countUp({{ $pendataanLengkap }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">{{ $pctPendataanLengkap }}% dari total</div>
                </div>

                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 400ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Kompilasi Admin</div>
                        <div style="color: #EB891B; background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: #EB891B; line-height: 1;" x-data="countUp({{ $kompromin }})" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">{{ $pctKompromin }}% dari total</div>
                </div>
            </div>
        </div>

        {{-- Card Kanan: Distribusi --}}
        <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: var(--navy);">Jenis Kegiatan</h3>
                <span class="mono" style="font-size: 11px; font-weight: 600; color: var(--muted); letter-spacing: .5px;">TAHUN {{ $tahun }}</span>
            </div>

            <div style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px;">
                <div id="kegiatan-donut-chart" style="width: 100%; display: flex; justify-content: center;"></div>
            </div>

            <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 16px; font-size: 12px; color: var(--muted); margin-top: 8px;">
                <div style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Survei</div>
                <div style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; border-radius: 3px; background: #00B69B;"></span>Pendataan Lengkap</div>
                <div style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Kompilasi Admin</div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 900px) {
        .cards-grid {
            grid-template-columns: 1fr !important;
        }

        .summary-stats-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<livewire:public-kegiatan-table :tahun="$tahun" />
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const options = {
            series: [{{ $survei }}, {{ $pendataanLengkap }}, {{ $kompromin }}],
            labels: ['Survei', 'Pendataan Lengkap', 'Kompilasi Admin'],
            chart: {
                type: 'donut',
                height: 260,
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: { enabled: true, delay: 150 },
                    dynamicAnimation: { enabled: true, speed: 350 }
                }
            },
            colors: ['#002B6A', '#00B69B', '#EB891B'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '8.5px',
                                fontFamily: 'Inter, sans-serif',
                                fontWeight: 600,
                                color: '#6B6560',
                                offsetY: 22
                            },
                            value: {
                                show: true,
                                fontSize: '28px',
                                fontFamily: 'JetBrains Mono',
                                fontWeight: 800,
                                color: '#002B6A',
                                offsetY: -10
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'TOTAL KEGIATAN',
                                fontSize: '10px',
                                fontFamily: 'Inter, sans-serif',
                                fontWeight: 600,
                                color: '#6B6560',
                                formatter: function (w) {
                                    return "{{ $totalKegiatan }}";
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            stroke: { show: true, colors: ['#fff'], width: 4 },
            legend: { show: false },
            tooltip: {
                enabled: true,
                theme: 'light',
                style: { fontSize: '12px', fontFamily: 'Inter, sans-serif' },
                y: {
                    formatter: function (value) {
                        return value + " Kegiatan";
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#kegiatan-donut-chart"), options);
        chart.render();
    });
</script>
@endpush
