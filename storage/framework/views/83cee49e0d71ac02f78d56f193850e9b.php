<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px 0;">
    
    <div class="scroll-reveal" style="background: #f0f4f8; border: 1px solid #dce4ec; border-radius: 12px; padding: 24px; display: flex; align-items: center; justify-content: space-between; gap: 24px; margin-bottom: 24px;">
        <div style="display: flex; gap: 16px; align-items: flex-start;">
            <div style="background: #fff; width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm); flex-shrink: 0; color: #002B6A;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </div>
            <div>
                <div style="font-size: 11px; font-weight: 800; color: #002B6A; letter-spacing: 1px; text-transform: uppercase;">Tentang Pemantauan Aliran Data</div>
                <div style="font-size: 14px; color: var(--muted); margin-top: 4px; line-height: 1.5;">
                    Aliran data memantau apakah <strong><?php echo e($totalData); ?> data yang disepakati</strong> sudah dipublikasikan di Sedata Sebantul. Data diupload oleh dinas langsung ke Sedata Sebantul, BPS memantau status tayangnya.
                </div>
            </div>
        </div>
        <a href="https://data.bantulkab.go.id/" target="_blank" style="background: #EB891B; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; flex-shrink: 0; transition: background 0.2s;" onmouseover="this.style.background='#d27814'" onmouseout="this.style.background='#EB891B'">
            Buka Sedata Sebantul <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>
    </div>

    
    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 24px; margin-bottom: 32px;" class="cards-grid">
        
        <div class="scroll-reveal" style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; --delay: 100ms; height: 100%;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                <div>
                    <div style="font-size: 11px; font-weight: 700; color: var(--muted); letter-spacing: 1px; text-transform: uppercase;">Distribusi</div>
                    <h3 style="margin: 4px 0 0; font-size: 18px; font-weight: 800; color: var(--navy);">Status Publikasi Data (<?php echo e($totalData); ?> Data)</h3>
                </div>
                <div style="border: 1px solid var(--line); border-radius: 6px; padding: 6px 12px; font-size: 12px; font-weight: 700; color: var(--navy); display: inline-block;">
                    Tahun <?php echo e(date('Y')); ?>

                </div>
            </div>

            <div style="flex: 1; display: flex; align-items: center; gap: 32px; width: 100%;">
                <div style="flex-shrink: 0; width: 220px; display: flex; justify-content: center; position: relative;">
                    <div id="aliran-donut-chart"></div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 16px; flex: 1;">
                    <div style="border: 1px solid var(--line); border-radius: 8px; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; background: #f8f9fb;">
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <span style="width: 12px; height: 12px; border-radius: 3px; background: #002B6A; flex-shrink: 0;"></span>
                            <div>
                                <div style="font-size: 14px; font-weight: 700; color: var(--navy);">Sudah Tayang</div>
                                <div style="font-size: 12px; color: var(--muted); margin-top: 4px;"><?php echo e($pctTayang); ?>% &middot; <?php echo e($sudahTayang); ?> data</div>
                            </div>
                        </div>
                        <div style="font-size: 24px; font-weight: 800; color: #002B6A; font-family: 'JetBrains Mono', monospace;" x-data="countUp(<?php echo e($sudahTayang); ?>)" x-text="count">0</div>
                    </div>

                    <div style="border: 1px solid var(--line); border-radius: 8px; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; background: #f8f9fb;">
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <span style="width: 12px; height: 12px; border-radius: 3px; background: #EB891B; flex-shrink: 0;"></span>
                            <div>
                                <div style="font-size: 14px; font-weight: 700; color: var(--navy);">Belum Tayang</div>
                                <div style="font-size: 12px; color: var(--muted); margin-top: 4px;"><?php echo e($pctBelum); ?>% &middot; <?php echo e($belumTayang); ?> data</div>
                            </div>
                        </div>
                        <div style="font-size: 24px; font-weight: 800; color: var(--muted); font-family: 'JetBrains Mono', monospace;" x-data="countUp(<?php echo e($belumTayang); ?>)" x-text="count">0</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
            <div class="scroll-reveal" style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm); display: flex; gap: 16px; align-items: center; --delay: 200ms;">
                <div style="background: rgba(0, 43, 106, 0.05); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #002B6A;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                </div>
                <div>
                    <div style="font-size: 13px; font-weight: 700; color: var(--muted); margin-bottom: 2px;">Total Data Dipantau</div>
                    <div style="display: flex; align-items: baseline; gap: 8px;">
                        <span style="font-size: 32px; font-weight: 800; color: var(--navy); font-family: 'JetBrains Mono', monospace; line-height: 1;" x-data="countUp(<?php echo e($totalData); ?>)" x-text="count">0</span>
                        <span style="font-size: 11px; font-weight: 600; color: var(--muted); font-family: 'JetBrains Mono', monospace;">data disepakati <?php echo e($tahun); ?></span>
                    </div>
                </div>
            </div>

            <div class="scroll-reveal" style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm); display: flex; gap: 16px; align-items: center; --delay: 300ms;">
                <div style="background: rgba(0, 43, 106, 0.05); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #002B6A;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div>
                    <div style="font-size: 13px; font-weight: 700; color: var(--muted); margin-bottom: 2px;">Sudah Tayang</div>
                    <div style="display: flex; align-items: baseline; gap: 8px;">
                        <span style="font-size: 32px; font-weight: 800; color: #002B6A; font-family: 'JetBrains Mono', monospace; line-height: 1;" x-data="countUp(<?php echo e($sudahTayang); ?>)" x-text="count">0</span>
                        <span style="font-size: 11px; font-weight: 600; color: var(--muted); font-family: 'JetBrains Mono', monospace;"><?php echo e($pctTayang); ?>% terpublikasi</span>
                    </div>
                </div>
            </div>

            <div class="scroll-reveal" style="background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm); display: flex; gap: 16px; align-items: center; --delay: 400ms;">
                <div style="background: rgba(235, 137, 27, 0.05); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #EB891B;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div>
                    <div style="font-size: 13px; font-weight: 700; color: var(--muted); margin-bottom: 2px;">Belum Tayang</div>
                    <div style="display: flex; align-items: baseline; gap: 8px;">
                        <span style="font-size: 32px; font-weight: 800; color: #EB891B; font-family: 'JetBrains Mono', monospace; line-height: 1;" x-data="countUp(<?php echo e($belumTayang); ?>)" x-text="count">0</span>
                        <span style="font-size: 11px; font-weight: 600; color: var(--muted); font-family: 'JetBrains Mono', monospace;"><?php echo e($pctBelum); ?>% belum tayang</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
    
<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('public-aliran-data-table', ['tahun' => $tahun]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2125516662-0', $__key);

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
    @media (max-width: 900px) {
        .cards-grid { grid-template-columns: 1fr !important; }
        .cards-grid > div:first-child > div:last-child { grid-template-columns: 1fr !important; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sudahTayang = <?php echo e($sudahTayang); ?>;
        const belumTayang = <?php echo e($belumTayang); ?>;
        const isEmpty = (sudahTayang + belumTayang) === 0;

        const options = {
            series: isEmpty ? [1] : [sudahTayang, belumTayang],
            labels: isEmpty ? ['Belum ada data'] : ['Sudah Tayang', 'Belum Tayang'],
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
            colors: isEmpty ? ['#f1f5f9'] : ['#002B6A', '#EB891B'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: { show: true, color: '#6B6560', fontSize: '10px', fontWeight: 700, fontFamily: 'Inter', offsetY: 24 },
                            value: { show: true, color: isEmpty ? '#94a3b8' : '#002B6A', fontSize: '32px', fontWeight: 800, fontFamily: 'JetBrains Mono', offsetY: -8 },
                            total: {
                                show: true,
                                showAlways: true,
                                label: isEmpty ? 'BELUM ADA DATA' : 'SUDAH TAYANG',
                                fontSize: '10px',
                                fontWeight: 700,
                                color: '#6B6560',
                                formatter: function (w) { return isEmpty ? "0" : "<?php echo e($pctTayang); ?>%"; }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            stroke: { width: isEmpty ? 0 : 3, colors: ['#fff'] },
            legend: { show: false },
            tooltip: {
                enabled: !isEmpty,
                theme: 'dark',
                fillSeriesColor: false,
                y: { formatter: function(val) { return val + " data" } }
            }
        };

        const chart = new ApexCharts(document.querySelector("#aliran-donut-chart"), options);
        chart.render();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/aliran_data.blade.php ENDPATH**/ ?>