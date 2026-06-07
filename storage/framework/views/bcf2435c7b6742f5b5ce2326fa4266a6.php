<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);" x-data="{ search: '' }">
    <div class="flex-col-mobile" style="margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Rekomendasi Statistik (Romantik) <?php echo e($tahun); ?></h1>
            <p style="color: var(--muted); font-size: 15px; margin: 0;">Status pengajuan dan persetujuan Romantik (Rekomendasi Kegiatan Statistik).</p>
        </div>

        <div style="position: relative;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" x-model="search" placeholder="Cari kegiatan atau OPD..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; width: 280px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm); transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='var(--orange)'; this.style.boxShadow='0 0 0 3px rgba(235, 137, 27, 0.1)';" onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='var(--shadow-sm)';">
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                    <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 40%;">OPD / Kegiatan</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status Dinas</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status Kominfo</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status BPS</th>
                    </tr>
                </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $romantik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid var(--line);" x-show="search === '' || $el.dataset.search.toLowerCase().includes(search.toLowerCase())" data-search="<?php echo e(addslashes(strtolower($item->kegiatanStatistik->dinas->singkatan ?? ''))); ?> <?php echo e(addslashes(strtolower($item->kegiatanStatistik->nama))); ?>">
                    <td style="padding: 16px;">
                        <div style="font-size: 11.5px; font-weight: 700; color: var(--muted); text-transform: uppercase; margin-bottom: 4px;"><?php echo e($item->kegiatanStatistik->dinas->singkatan ?? '-'); ?></div>
                        <div style="font-weight: 600; color: var(--navy);"><?php echo e($item->kegiatanStatistik->nama); ?></div>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        <?php
                            $stDinas = $item->status_dinas instanceof \App\Enums\StatusDinas ? $item->status_dinas : \App\Enums\StatusDinas::tryFrom($item->status_dinas);
                        ?>
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: <?php echo e($stDinas?->cssColor() ?? 'var(--muted)'); ?>; background: <?php echo e($stDinas?->cssBgColor() ?? 'var(--line)'); ?>;">
                            <?php echo e($stDinas?->label() ?? ucwords(str_replace('_', ' ', $item->status_dinas))); ?>

                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        <?php
                            $stKominfo = $item->status_kominfo instanceof \App\Enums\StatusKominfo ? $item->status_kominfo : \App\Enums\StatusKominfo::tryFrom($item->status_kominfo);
                        ?>
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: <?php echo e($stKominfo?->cssColor() ?? '#EB891B'); ?>; background: <?php echo e($stKominfo?->cssBgColor() ?? 'rgba(235,137,27,.1)'); ?>;">
                            <?php echo e($stKominfo?->label() ?? ucwords(str_replace('_', ' ', $item->status_kominfo))); ?>

                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        <?php
                            $stBps = $item->status_bps instanceof \App\Enums\StatusBps ? $item->status_bps : \App\Enums\StatusBps::tryFrom($item->status_bps);
                        ?>
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: <?php echo e($stBps?->cssColor() ?? '#EB891B'); ?>; background: <?php echo e($stBps?->cssBgColor() ?? 'rgba(235,137,27,.1)'); ?>;">
                            <?php echo e($stBps?->label() ?? ucwords(str_replace('_', ' ', $item->status_bps))); ?>

                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada pengajuan Romantik untuk tahun ini.</td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/romantik.blade.php ENDPATH**/ ?>