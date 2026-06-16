<div class="charts-grid" x-data="dashboardCharts()">
    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: var(--navy);">Identifikasi Kegiatan Statistik</h3>
            <span class="mono" style="font-size: 11px; font-weight: 600; color: var(--muted); letter-spacing: .5px;">TAHUN <?php echo e($tahun); ?></span>
        </div>
        <div id="pie-kegiatan" style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Enums\JenisKegiatan::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('kegiatan', '<?php echo e($jk->value); ?>', '<?php echo e($tahun); ?>')">
                <span style="width: 12px; height: 12px; border-radius: 3px; background: <?php echo e(match($jk) { \App\Enums\JenisKegiatan::SURVEI => '#002B6A', \App\Enums\JenisKegiatan::PENDATAAN_LENGKAP => '#00B69B', \App\Enums\JenisKegiatan::KOMPROMIN => '#EB891B' }); ?>;"></span><?php echo e($jk->label()); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-size: 14px; font-weight: 700; color: var(--navy); m-0">Rekomendasi Statistik (Romantik)</h3>
            <span class="mono" style="font-size: 11px; font-weight: 600; color: var(--muted); letter-spacing: .5px;">TAHUN <?php echo e($tahun); ?></span>
        </div>
        <div id="donut-romantik" style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('romantik', 'done', '<?php echo e($tahun); ?>')"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah diajukan</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('romantik', 'belum', '<?php echo e($tahun); ?>')"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum diajukan</div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-size: 14px; font-weight: 700; color: var(--navy); m-0">Metadata Statistik</h3>
            <span class="mono" style="font-size: 11px; font-weight: 600; color: var(--muted); letter-spacing: .5px;">TAHUN <?php echo e($tahun); ?></span>
        </div>
        <div id="donut-metadata" style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('metadata', 'done', '<?php echo e($tahun); ?>')"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah menyusun</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('metadata', 'draft', '<?php echo e($tahun); ?>')"><span style="width: 12px; height: 12px; border-radius: 3px; background: #94a3b8;"></span>Draft</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('metadata', 'belum', '<?php echo e($tahun); ?>')"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum menyusun</div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-size: 14px; font-weight: 700; color: var(--navy); m-0">Aliran Data (Sedata Sebantul)</h3>
            <span class="mono" style="font-size: 11px; font-weight: 600; color: var(--muted); letter-spacing: .5px;">TAHUN <?php echo e($tahun); ?></span>
        </div>
        <div id="donut-aliran" style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px; cursor: pointer;"></div>
        <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('aliran', 'done', '<?php echo e($tahun); ?>')"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah tayang</div>
            <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" @click="openModal('aliran', 'belum', '<?php echo e($tahun); ?>')"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum tayang</div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal2dfa94592e5c75e32ba7d4779b8ae6fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2dfa94592e5c75e32ba7d4779b8ae6fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.chart-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chart-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2dfa94592e5c75e32ba7d4779b8ae6fc)): ?>
<?php $attributes = $__attributesOriginal2dfa94592e5c75e32ba7d4779b8ae6fc; ?>
<?php unset($__attributesOriginal2dfa94592e5c75e32ba7d4779b8ae6fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2dfa94592e5c75e32ba7d4779b8ae6fc)): ?>
<?php $component = $__componentOriginal2dfa94592e5c75e32ba7d4779b8ae6fc; ?>
<?php unset($__componentOriginal2dfa94592e5c75e32ba7d4779b8ae6fc); ?>
<?php endif; ?>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('dashboardCharts', () => ({
        counts: {
            romantik: { done: <?php echo e($romantikDiajukan); ?>, belum: <?php echo e($romantikBelum); ?> },
            metadata: { done: <?php echo e($metaKegiatanDone); ?>, belum: <?php echo e($metaKegiatanTotal - $metaKegiatanDone - $metaKegiatanDraft); ?>, draft: <?php echo e($metaKegiatanDraft); ?> },
            aliran: { done: <?php echo e($aliranTayang); ?>, belum: <?php echo e($aliranBelum); ?> }
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

            // Kegiatan - Pie Chart per Jenis
            window.chartInstances.kegiatan = new ApexCharts(document.querySelector("#pie-kegiatan"), {
                series: <?php echo json_encode($jenisValues, 15, 512) ?>,
                labels: <?php echo json_encode($jenisLabels, 15, 512) ?>,
                colors: <?php echo json_encode($jenisColors, 15, 512) ?>,
                chart: { 
                    type: 'donut', 
                    height: 260,
                    animations: { enabled: true, dynamicAnimation: { speed: 800 } },
                    events: {
                        dataPointSelection: function(event, chartContext, config) {
                            const jenisValues = <?php echo json_encode(collect(\App\Enums\JenisKegiatan::cases())->pluck('value')->toArray(), 15, 512) ?>;
                            const selectedJenis = jenisValues[config.dataPointIndex];
                            self.openModal('kegiatan', selectedJenis, '<?php echo e($tahun); ?>');
                        }
                    }
                },
                plotOptions: { 
                    pie: { 
                        donut: { 
                            size: '75%', 
                            labels: { 
                                show: true, 
                                name: { show: true, color: '#6B6560', fontSize: '8.5px', fontWeight: 600, fontFamily: 'Inter', offsetY: 22 }, 
                                value: { show: true, color: '#002B6A', fontSize: '28px', fontWeight: 800, fontFamily: 'JetBrains Mono', offsetY: -10 },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'TOTAL KEGIATAN',
                                    fontSize: '10px',
                                    fontWeight: 600,
                                    color: '#6B6560',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
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
            window.chartInstances.kegiatan.render();

            window.chartPcts = window.chartPcts || {};
            window.chartPcts['romantik'] = <?php echo e($pctRomantik); ?>;
            window.chartPcts['metadata'] = <?php echo e($pctMetadata); ?>;
            window.chartPcts['aliran'] = <?php echo e($pctAliran); ?>;

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
<?php /**PATH D:\PASEBAN APP\resources\views/partials/dashboard-charts.blade.php ENDPATH**/ ?>