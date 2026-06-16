<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">
    <div class="flex-col-mobile" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Metadata Statistik <?php echo e($tahun); ?></h1>
            <p style="color: var(--muted); font-size: 15px; margin: 0;">Status pelaporan Metadata (Kegiatan, Variabel, dan Indikator).</p>
        </div>

        <form method="GET" action="<?php echo e(route('public.metadata')); ?>" class="w-full-mobile" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <input type="hidden" name="tahun" value="<?php echo e(request('tahun', $tahun)); ?>">
            
            <div style="position: relative;" x-data="{ open: false }">
                <button type="button" @click="open = !open" style="padding: 10px 16px; background: #fff; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; font-weight: 600; color: var(--navy); cursor: pointer; display: flex; align-items: center; gap: 8px; box-shadow: var(--shadow-sm);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Export
                </button>
                <div x-show="open" @click.away="open = false" style="position: absolute; top: 100%; right: 0; margin-top: 8px; background: #fff; border: 1px solid var(--line); border-radius: 8px; box-shadow: var(--shadow-md); z-index: 50; width: 140px; overflow: hidden; display: none;" :style="{ display: open ? 'block' : 'none' }">
                    <a href="<?php echo e(route('metadata.export', array_merge(request()->query(), ['format' => 'excel']))); ?>" style="display: block; padding: 10px 16px; color: var(--navy); text-decoration: none; font-size: 13px; border-bottom: 1px solid var(--line); transition: background 0.2s;" onmouseover="this.style.background='var(--navy-50)'" onmouseout="this.style.background='transparent'">Excel (.xlsx)</a>
                    <a href="<?php echo e(route('metadata.export', array_merge(request()->query(), ['format' => 'pdf']))); ?>" style="display: block; padding: 10px 16px; color: var(--navy); text-decoration: none; font-size: 13px; transition: background 0.2s;" onmouseover="this.style.background='var(--navy-50)'" onmouseout="this.style.background='transparent'">PDF (.pdf)</a>
                </div>
            </div>

            <select name="jenis" class="w-full-mobile" style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 14px center; background-size: 14px; -webkit-appearance: none; appearance: none; box-shadow: var(--shadow-sm); cursor: pointer;" onchange="this.form.submit()">
                <option value="">Semua Jenis</option>
                <option value="kegiatan" <?php echo e(request('jenis') == 'kegiatan' ? 'selected' : ''); ?>>Kegiatan</option>
                <option value="variabel" <?php echo e(request('jenis') == 'variabel' ? 'selected' : ''); ?>>Variabel</option>
                <option value="indikator" <?php echo e(request('jenis') == 'indikator' ? 'selected' : ''); ?>>Indikator</option>
            </select>

            <select name="dinasFilter" class="w-full-mobile" style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 14px center; background-size: 14px; -webkit-appearance: none; appearance: none; box-shadow: var(--shadow-sm); max-width: 200px; cursor: pointer;" onchange="this.form.submit()">
                <option value="">Semua OPD / Dinas</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $dinasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($d->id); ?>" <?php echo e(request('dinasFilter') == $d->id ? 'selected' : ''); ?>><?php echo e($d->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <div class="w-full-mobile" style="position: relative; display: flex;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="w-full-mobile" placeholder="Cari kegiatan atau OPD..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px 0 0 8px; font-size: 13.5px; width: 220px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm);">
                <button type="submit" style="padding: 10px 16px; background: var(--navy); border: 1px solid var(--navy); border-radius: 0 8px 8px 0; color: #fff; font-weight: 600; font-size: 13.5px; cursor: pointer;">Cari</button>
            </div>
        </form>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive desktop-only">
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
                    <td colspan="4" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada pelaporan Metadata untuk tahun ini.</td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
        </div>

        
        <div class="mobile-only">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $metadata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $stKominfo = $item->status_kominfo instanceof \App\Enums\StatusKominfo ? $item->status_kominfo : \App\Enums\StatusKominfo::tryFrom($item->status_kominfo);
                    $stBps = $item->status_bps instanceof \App\Enums\StatusBps ? $item->status_bps : \App\Enums\StatusBps::tryFrom($item->status_bps);
                ?>
                <div style="border-bottom: 1px solid var(--line); padding: 16px 20px; display: flex; flex-direction: column; gap: 12px;">
                    <div>
                        <div style="font-size: 11px; color: var(--muted); font-weight: 700; margin-bottom: 4px; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center;">
                            <span><?php echo e($item->kegiatanStatistik->dinas->singkatan ?? '-'); ?></span>
                            <span style="display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; background: var(--navy-50); color: var(--navy);">
                                <?php echo e($item->jenis instanceof \App\Enums\JenisMetadata ? $item->jenis->label() : ucfirst($item->jenis)); ?>

                            </span>
                        </div>
                        <div style="font-size: 14.5px; font-weight: 700; color: var(--navy); line-height: 1.35;"><?php echo e($item->kegiatanStatistik->nama); ?></div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr; gap: 8px; margin-top: 4px; background: var(--navy-50); padding: 12px; border-radius: 8px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Status Kominfo</span>
                            <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: <?php echo e($stKominfo?->cssColor() ?? '#EB891B'); ?>; background: <?php echo e($stKominfo?->cssBgColor() ?? 'rgba(235,137,27,.1)'); ?>;">
                                <?php echo e($stKominfo?->label() ?? ucwords(str_replace('_', ' ', $item->status_kominfo))); ?>

                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Status BPS</span>
                            <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: <?php echo e($stBps?->cssColor() ?? '#EB891B'); ?>; background: <?php echo e($stBps?->cssBgColor() ?? 'rgba(235,137,27,.1)'); ?>;">
                                <?php echo e($stBps?->label() ?? ucwords(str_replace('_', ' ', $item->status_bps))); ?>

                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding: 32px; text-align: center; color: var(--muted);">Belum ada pelaporan Metadata untuk tahun ini.</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($metadata->hasPages()): ?>
        <div style="padding: 20px;">
            <?php echo e($metadata->links()); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/metadata.blade.php ENDPATH**/ ?>