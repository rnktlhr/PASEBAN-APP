<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px 0;">
    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 24px; margin-bottom: 8px;" class="cards-grid">
        
        <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                <div>
                    <h2 style="margin: 0; font-size: 22px; font-weight: 800; color: var(--navy);">Capaian Romantik Tahun <?php echo e($tahun); ?></h2>
                </div>
                <div style="padding: 6px 12px; background: #fff5eb; color: #EB891B; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: .5px;">
                    PER <?php echo e(strtoupper(date('d M Y'))); ?>

                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="summary-stats-grid">
                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 100ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Total Romantik <?php echo e($tahun); ?></div>
                        <div style="color: var(--muted); background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: var(--navy); line-height: 1;" x-data="countUp(<?php echo e($totalKegiatan); ?>)" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);">kegiatan</div>
                </div>

                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 200ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Sudah Diajukan</div>
                        <div style="color: #002B6A; background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: #002B6A; line-height: 1;" x-data="countUp(<?php echo e($diajukan); ?>)" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);"><?php echo e($pctDiajukan); ?>% dari total</div>
                </div>

                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 300ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Disetujui BPS</div>
                        <div style="color: #00B69B; background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: #00B69B; line-height: 1;" x-data="countUp(<?php echo e($disetujui); ?>)" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);"><?php echo e($pctDisetujui); ?>% dari total</div>
                </div>

                <div class="scroll-reveal" style="background: #f8f9fb; border: 1px solid var(--line); border-radius: 10px; padding: 16px; --delay: 400ms;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--muted);">Belum Diajukan</div>
                        <div style="color: #EB891B; background: #fff; border: 1px solid var(--line); width: 24px; height: 24px; border-radius: 6px; display: grid; place-items: center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                        </div>
                    </div>
                    <div class="mono" style="margin-top: 12px; font-size: 28px; font-weight: 800; color: #EB891B; line-height: 1;" x-data="countUp(<?php echo e($belumDiajukan); ?>)" x-text="count">0</div>
                    <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: var(--muted);"><?php echo e($pctBelum); ?>% dari total</div>
                </div>
            </div>
        </div>

        
        <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: var(--navy);">Status Romantik</h3>
                <span class="mono" style="font-size: 11px; font-weight: 600; color: var(--muted); letter-spacing: .5px;">TAHUN <?php echo e($tahun); ?></span>
            </div>

            <div style="flex: 1; display: flex; justify-content: center; align-items: center; width: 100%; min-height: 200px;">
                <div id="romantik-donut-chart" style="width: 100%; display: flex; justify-content: center;"></div>
            </div>

            <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 16px; font-size: 12px; color: var(--muted); margin-top: 8px;">
                <div style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A;"></span>Sudah diajukan</div>
                <div style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B;"></span>Belum diajukan</div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 900px) {
        .cards-grid { grid-template-columns: 1fr !important; }
        .summary-stats-grid { grid-template-columns: 1fr !important; }
    }
</style>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('public-romantik-table', ['tahun' => $tahun]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1055510329-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const options = {
            series: [<?php echo e($diajukan); ?>, <?php echo e($belumDiajukan); ?>],
            labels: ['Sudah diajukan', 'Belum diajukan'],
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
            colors: ['#002B6A', '#EB891B'],
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
                                color: '#EB891B',
                                offsetY: -10
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'SUDAH DIAJUKAN',
                                fontSize: '10px',
                                fontFamily: 'Inter, sans-serif',
                                fontWeight: 600,
                                color: '#6B6560',
                                formatter: function (w) {
                                    return "<?php echo e($pctDiajukan); ?>%";
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
                    formatter: function(value) {
                        return value + " Kegiatan";
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#romantik-donut-chart"), options);
        chart.render();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/romantik.blade.php ENDPATH**/ ?>