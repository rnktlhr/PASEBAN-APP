<?php $__env->startSection('title', 'Identifikasi Kegiatan Statistik — Paseban'); ?>

<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">
    <div style="margin-bottom: 24px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Identifikasi Kegiatan Statistik <?php echo e($tahun); ?></h1>
        <p style="color: var(--muted); font-size: 15px; margin: 0;">Daftar seluruh rancangan kegiatan statistik sektoral yang diidentifikasi dari OPD Kabupaten Bantul.</p>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                    <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 60px;">No</th>
                    <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 220px;">OPD</th>
                    <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy);">Nama Kegiatan</th>
                    <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 360px;">Jenis</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $keg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid var(--line);">
                    <td style="padding: 16px; text-align: center; color: var(--muted);"><?php echo e($idx + 1); ?></td>
                    <td style="padding: 16px; font-weight: 600; color: var(--navy);"><?php echo e($keg->dinas->singkatan ?? '-'); ?></td>
                    <td style="padding: 16px; color: var(--ink);"><?php echo e($keg->nama); ?></td>
                    <td style="padding: 16px; text-align: center;">
                        <?php
                            $jenisEnum = $keg->jenis instanceof \App\Enums\JenisKegiatan ? $keg->jenis : \App\Enums\JenisKegiatan::tryFrom($keg->jenis);
                        ?>
                        <span style="display: inline-block; width: 310px; text-align: center; padding: 6px 0; border-radius: 999px; font-size: 11.5px; font-weight: 600; color: <?php echo e($jenisEnum?->cssColor() ?? 'var(--muted)'); ?>; background: <?php echo e($jenisEnum?->cssBgColor() ?? '#f5f5f5'); ?>;">
                            <?php echo e($jenisEnum?->label() ?? ucfirst(str_replace('_', ' ', $keg->jenis))); ?>

                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada data kegiatan untuk tahun ini.</td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/kegiatan.blade.php ENDPATH**/ ?>