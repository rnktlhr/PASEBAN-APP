<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">
    <div style="margin-bottom: 24px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Metadata Statistik <?php echo e($tahun); ?></h1>
        <p style="color: var(--muted); font-size: 15px; margin: 0;">Status pelaporan Metadata (Kegiatan, Variabel, dan Indikator).</p>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                    <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 40%;">Kegiatan / OPD</th>
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 20%;">Jenis Metadata</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status Kominfo</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status BPS</th>
                    </tr>
                </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $metadata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid var(--line);">
                    <td style="padding: 16px;">
                        <div style="font-weight: 600; color: var(--navy); margin-bottom: 4px;"><?php echo e($item->kegiatanStatistik->nama); ?></div>
                        <div style="font-size: 12px; color: var(--muted);"><?php echo e($item->kegiatanStatistik->dinas->singkatan ?? '-'); ?></div>
                    </td>
                    <td style="padding: 16px; font-weight: 500; color: var(--ink);">
                        <?php echo e($item->jenis instanceof \App\Enums\JenisMetadata ? $item->jenis->label() : ucfirst($item->jenis)); ?>

                    </td>
                    <td style="padding: 16px; text-align: center;">
                        <?php
                            $stKominfo = $item->status_kominfo instanceof \App\Enums\StatusKominfo ? $item->status_kominfo : \App\Enums\StatusKominfo::tryFrom($item->status_kominfo);
                        ?>
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: <?php echo e($stKominfo?->cssColor() ?? '#F58220'); ?>; background: <?php echo e($stKominfo?->cssBgColor() ?? 'rgba(245,130,32,.1)'); ?>;">
                            <?php echo e($stKominfo?->label() ?? ucwords(str_replace('_', ' ', $item->status_kominfo))); ?>

                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        <?php
                            $stBps = $item->status_bps instanceof \App\Enums\StatusBps ? $item->status_bps : \App\Enums\StatusBps::tryFrom($item->status_bps);
                        ?>
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: <?php echo e($stBps?->cssColor() ?? '#F58220'); ?>; background: <?php echo e($stBps?->cssBgColor() ?? 'rgba(245,130,32,.1)'); ?>;">
                            <?php echo e($stBps?->label() ?? ucwords(str_replace('_', ' ', $item->status_bps))); ?>

                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada pelaporan Metadata untuk tahun ini.</td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/metadata.blade.php ENDPATH**/ ?>