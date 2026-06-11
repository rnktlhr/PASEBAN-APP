<div class="charts-grid" x-data="dashboardCharts()">
    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: var(--navy);">Identifikasi Kegiatan Statistik</h3>
            <select class="styled-select" x-model="years.kegiatan" @change="updateChart('kegiatan')" style="padding: 4px 8px; border: 1px solid var(--line); border-radius: 6px; font-size: 11px; font-weight: 600; color: var(--muted); background: #fff; cursor: pointer; outline: none;">
                @for($y = date('Y') - 4; $y <= date('Y') + 2; $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div id="bar-chart" style="flex: 1; width: 100%; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <div style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Jumlah kegiatan</div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-size: 14px; font-weight: 700; color: var(--navy); m-0">Rekomendasi Statistik (Romantik)</h3>
            <select class="styled-select" x-model="years.romantik" @change="updateChart('romantik')" style="padding: 4px 8px; border: 1px solid var(--line); border-radius: 4px; font-size: 12px; color: var(--muted); background: #f8fafc; outline: none; cursor: pointer;">
                @for ($y = date('Y') + 2; $y >= 2022; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div id="donut-romantik" style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('romantik', 'done', years.romantik)"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah diajukan</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('romantik', 'belum', years.romantik)"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum diajukan</div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-size: 14px; font-weight: 700; color: var(--navy); m-0">Metadata Statistik</h3>
            <select class="styled-select" x-model="years.metadata" @change="updateChart('metadata')" style="padding: 4px 8px; border: 1px solid var(--line); border-radius: 4px; font-size: 12px; color: var(--muted); background: #f8fafc; outline: none; cursor: pointer;">
                @for ($y = date('Y') + 2; $y >= 2022; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div id="donut-metadata" style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('metadata', 'done', years.metadata)"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah menyusun</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('metadata', 'draft', years.metadata)"><span style="width: 12px; height: 12px; border-radius: 3px; background: #94a3b8;"></span>Draft</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('metadata', 'belum', years.metadata)"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum menyusun</div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-size: 14px; font-weight: 700; color: var(--navy); m-0">Aliran Data (Sedata Sebantul)</h3>
            <select class="styled-select" x-model="years.aliran" @change="updateChart('aliran')" style="padding: 4px 8px; border: 1px solid var(--line); border-radius: 4px; font-size: 12px; color: var(--muted); background: #f8fafc; outline: none; cursor: pointer;">
                @for ($y = date('Y') + 2; $y >= 2022; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div id="donut-aliran" style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('aliran', 'done', years.aliran)"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah tayang</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('aliran', 'belum', years.aliran)"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum tayang</div>
        </div>
    </div>

    <x-chart-modal />
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('dashboardCharts', () => ({
        years: {
            kegiatan: '{{ $tahun }}',
            romantik: '{{ $tahun }}',
            metadata: '{{ $tahun }}',
            aliran: '{{ $tahun }}'
        },
        counts: {
            romantik: { done: {{ $romantikDiajukan }}, belum: {{ $romantikBelum }} },
            metadata: { done: {{ $metaKegiatanDone }}, belum: {{ $metaKegiatanTotal - $metaKegiatanDone - $metaKegiatanDraft }}, draft: {{ $metaKegiatanDraft }} },
            aliran: { done: {{ $aliranTayang }}, belum: {{ $aliranBelum }} }
        },
        modalOpen: false,
        modalLoading: false,
        modalTitle: '',
        modalItems: [],
        initialized: false,

        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !this.initialized) {
                        this.initialized = true;
                        this.initCharts();
                    }
                });
            }, { threshold: 0.1 });
            observer.observe(this.$el);
        },

        initCharts() {
            window.chartInstances = {};
            const self = this;

                window.chartInstances.kegiatan = new ApexCharts(document.querySelector("#bar-chart"), {
                series: [{ name: 'Jumlah Kegiatan', data: @json($chartValues) }],
                chart: { 
                    type: 'bar', height: 220, toolbar: { show: false },
                    animations: { enabled: true, dynamicAnimation: { speed: 800 } },
                    events: {
                        dataPointSelection: function(event, chartContext, config) {
                            const year = chartContext.w.globals.labels[config.dataPointIndex];
                            self.openModal('kegiatan', year, year);
                        }
                    }
                },
                colors: ['#002B6A'],
                plotOptions: { bar: { horizontal: false, columnWidth: '50%', borderRadius: 4 } },
                dataLabels: { enabled: true, style: { fontFamily: 'JetBrains Mono', fontSize: '11px', colors: ['#fff'] } },
                xaxis: { categories: @json($chartYears), axisBorder: { show: false }, axisTicks: { show: false }, labels: { style: { fontFamily: 'JetBrains Mono', colors: '#6B6560' } } },
                yaxis: { show: false },
                grid: { show: false },
                legend: { show: false }
            });
            window.chartInstances.kegiatan.render();

            window.chartPcts = window.chartPcts || {};
            window.chartPcts['romantik'] = {{ $pctRomantik }};
            window.chartPcts['metadata'] = {{ $pctMetadata }};
            window.chartPcts['aliran'] = {{ $pctAliran }};

            function initDonutChart(el, type, series, labels, colors, centerLabel) {
                window.chartInstances[type] = new ApexCharts(document.querySelector(el), {
                    series: series,
                    labels: labels,
                    colors: colors,
                    chart: { 
                        type: 'donut', 
                        height: 260,
                        animations: { enabled: true, dynamicAnimation: { speed: 800 } }
                    },
                    plotOptions: { 
                        pie: { 
                            donut: { 
                                size: '75%', 
                                labels: { 
                                    show: true, 
                                    name: { show: true, color: '#6B6560', fontSize: '8.5px', fontWeight: 600, fontFamily: 'Inter', offsetY: 22 }, 
                                    value: { show: true, color: '#EB891B', fontSize: '28px', fontWeight: 800, fontFamily: 'JetBrains Mono', offsetY: -10 },
                                    total: {
                                        show: true,
                                        showAlways: true,
                                        label: centerLabel,
                                        fontSize: '10px',
                                        fontWeight: 600,
                                        color: '#6B6560',
                                        formatter: function (w) {
                                            return window.chartPcts[type] + "%"
                                        }
                                    }
                                } 
                            } 
                        } 
                    },
                    dataLabels: { enabled: false },
                    stroke: { width: 3, colors: ['#fff'] },
                    legend: { show: false },
                    tooltip: { enabled: true, theme: 'dark', fillSeriesColor: false }
                });
                
                window.chartInstances[type].render();
            }

            initDonutChart('#donut-romantik', 'romantik', [this.counts.romantik.done, this.counts.romantik.belum], ['Sudah diajukan', 'Belum diajukan'], ['#002B6A', '#EB891B'], 'SUDAH DIAJUKAN');
            initDonutChart('#donut-metadata', 'metadata', [this.counts.metadata.done, this.counts.metadata.draft, this.counts.metadata.belum], ['Sudah menyusun', 'Draft', 'Belum menyusun'], ['#002B6A', '#94a3b8', '#EB891B'], 'SUDAH MENYUSUN');
            initDonutChart('#donut-aliran', 'aliran', [this.counts.aliran.done, this.counts.aliran.belum], ['Sudah tayang', 'Belum tayang'], ['#002B6A', '#EB891B'], 'SUDAH TAYANG');
        },

        async updateChart(type) {
            const y = this.years[type];
            try {
                const res = await fetch(`/api/dashboard/chart-data?type=${type}&year=${y}`);
                const data = await res.json();
                
                if (type === 'kegiatan') {
                    window.chartInstances.kegiatan.updateSeries([{ data: data.data }]);
                } else {
                    let currentTotal = 0;
                    if (type === 'metadata') {
                        currentTotal = this.counts[type].done + (this.counts[type].draft || 0) + this.counts[type].belum;
                    } else {
                        currentTotal = this.counts[type].done + this.counts[type].belum;
                    }

                    this.counts[type].done = data.done;
                    this.counts[type].belum = data.belum;
                    if (data.draft !== undefined) this.counts[type].draft = data.draft;
                    
                    let newSeries = [];
                    if (type === 'metadata') {
                        newSeries = [data.done, data.draft, data.belum];
                    } else {
                        newSeries = [data.done, data.belum];
                    }
                    
                    // Update global pct before series update so the formatter uses the new value
                    window.chartPcts[type] = data.pct;
                    
                    if (currentTotal === 0) {
                        // If chart was empty, use updateOptions to trigger the initial load animation
                        window.chartInstances[type].updateOptions({ series: newSeries });
                    } else {
                        // Smoothly animate the chart slices
                        window.chartInstances[type].updateSeries(newSeries);
                    }
                }
            } catch (e) { console.error(e); }
        },

        async openModal(type, status, year) {
            this.modalTitle = 'Memuat...';
            this.modalItems = [];
            this.modalLoading = true;
            this.modalOpen = true;
            try {
                const res = await fetch(`/api/dashboard/chart-details?type=${type}&status=${status}&year=${year}`);
                const data = await res.json();
                this.modalTitle = data.title;
                this.modalItems = data.items;
            } catch (e) {
                this.modalTitle = 'Terjadi Kesalahan';
            } finally {
                this.modalLoading = false;
            }
        }
    }));
});
</script>
