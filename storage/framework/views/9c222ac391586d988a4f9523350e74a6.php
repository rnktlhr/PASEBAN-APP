<?php $__env->startSection('content'); ?>
<?php
$cards = [
    [
        'id' => 'kegiatan',
        'title' => 'Metadata Kegiatan',
        'sudah' => $metaKegiatanDone,
        'draft' => $metaKegiatanDraft,
        'belum' => $metaKegiatanBelum,
        'pct' => $pctKegiatan,
    ],
    [
        'id' => 'variabel',
        'title' => 'Metadata Variabel',
        'sudah' => $metaVariabelDone,
        'draft' => $metaVariabelDraft,
        'belum' => $metaVariabelBelum,
        'pct' => $pctVariabel,
    ],
    [
        'id' => 'indikator',
        'title' => 'Metadata Indikator',
        'sudah' => $metaIndikatorDone,
        'draft' => $metaIndikatorDraft,
        'belum' => $metaIndikatorBelum,
        'pct' => $pctIndikator,
    ]
];
?>

<div class="container" style="padding: 40px 32px 0;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Pelaporan Metadata <?php echo e($tahun); ?></h1>
        <p style="color: var(--muted); font-size: 15px; margin: 0;">Status pelaporan Metadata Statistik (Kegiatan, Indikator, dan Variabel) oleh OPD.</p>
    </div>

    <div style="margin-bottom: 24px;">
        <h2 style="margin: 0; font-size: 22px; font-weight: 800; color: var(--navy);">Capaian Metadata Tahun <?php echo e($tahun); ?></h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 32px;" class="metadata-cards-grid">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="scroll-reveal" style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; --delay: <?php echo e($index * 100); ?>ms;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: var(--navy);"><?php echo e($card['title']); ?></h3>
                <span class="mono" style="font-size: 11px; font-weight: 600; color: var(--muted); letter-spacing: .5px;">TAHUN <?php echo e($tahun); ?></span>
            </div>

            <div style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px;">
                <div id="chart-<?php echo e($card['id']); ?>" style="width: 100%; display: flex; justify-content: center; cursor: pointer;" onclick="document.querySelector('[name=jenis]').value = '<?php echo e($card['id']); ?>'; document.getElementById('filter-form').submit();"></div>
            </div>

            <div style="display: flex; justify-content: center; gap: 18px; font-size: 12px; color: var(--muted); margin-top: 8px;">
                <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" onclick="document.querySelector('[name=jenis]').value = '<?php echo e($card['id']); ?>'; document.getElementById('filter-form').submit();">
                    <span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah menyusun
                </div>
                <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" onclick="document.querySelector('[name=jenis]').value = '<?php echo e($card['id']); ?>'; document.getElementById('filter-form').submit();">
                    <span style="width: 12px; height: 12px; border-radius: 3px; background: #94a3b8;"></span>Draft
                </div>
                <div style="display: flex; align-items: center; gap: 6px; cursor: pointer;" onclick="document.querySelector('[name=jenis]').value = '<?php echo e($card['id']); ?>'; document.getElementById('filter-form').submit();">
                    <span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum menyusun
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('public-metadata-table', ['tahun' => $tahun]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3829572500-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

<style>
    @media (max-width: 1024px) {
        .metadata-cards-grid { grid-template-columns: 1fr !important; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = [
            { id: 'kegiatan', sudah: <?php echo e($metaKegiatanDone); ?>, draft: <?php echo e($metaKegiatanDraft); ?>, belum: <?php echo e($metaKegiatanBelum); ?>, pct: <?php echo e($pctKegiatan); ?> },
            { id: 'variabel', sudah: <?php echo e($metaVariabelDone); ?>, draft: <?php echo e($metaVariabelDraft); ?>, belum: <?php echo e($metaVariabelBelum); ?>, pct: <?php echo e($pctVariabel); ?> },
            { id: 'indikator', sudah: <?php echo e($metaIndikatorDone); ?>, draft: <?php echo e($metaIndikatorDraft); ?>, belum: <?php echo e($metaIndikatorBelum); ?>, pct: <?php echo e($pctIndikator); ?> }
        ];

        cards.forEach(card => {
            const options = {
                series: [card.sudah, card.draft, card.belum],
                labels: ['Sudah menyusun', 'Draft', 'Belum menyusun'],
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
                colors: ['#002B6A', '#94a3b8', '#EB891B'],
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
                                    label: 'SUDAH MENYUSUN',
                                    fontSize: '10px',
                                    fontWeight: 600,
                                    color: '#6B6560',
                                    formatter: function (w) {
                                        return card.pct + "%";
                                    }
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
                    theme: 'dark',
                    fillSeriesColor: false,
                    y: { formatter: function(val) { return val + " Kegiatan" } }
                }
            };

            const chart = new ApexCharts(document.querySelector("#chart-" + card.id), options);
            chart.render();
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/metadata.blade.php ENDPATH**/ ?>