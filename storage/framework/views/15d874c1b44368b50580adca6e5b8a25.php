<div>
    
    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 24px; margin-bottom: 28px; flex-wrap: wrap;">
        <div>
            <div style="font-size: 12px; letter-spacing: 1.5px; color: var(--orange-600); text-transform: uppercase; font-weight: 700; margin-bottom: 6px;">◆ Monitoring & Evaluasi</div>
            <h2 style="margin: 0; font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px;">Kegiatan Statistik Sektoral</h2>
        </div>
        <div style="display: flex; align-items: center; gap: 16px;">
            <a href="<?php echo e(route('monev.export.excel', ['tahun' => $tahun, 'dinas_id' => $dinas_id, 'status' => $status, 'search' => $search])); ?>" style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 6px; background: #2e7d32; color: #fff; font-size: 13px; font-weight: 600; text-decoration: none; letter-spacing: .2px; box-shadow: var(--shadow-sm); transition: background .15s;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Excel
            </a>
            <a href="<?php echo e(route('monev.export.pdf', ['tahun' => $tahun, 'dinas_id' => $dinas_id, 'status' => $status, 'search' => $search])); ?>" style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 6px; background: var(--red); color: #fff; font-size: 13px; font-weight: 600; text-decoration: none; letter-spacing: .2px; box-shadow: var(--shadow-sm); transition: background .15s;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                PDF
            </a>
        </div>
    </div>

    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 20px;">
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--muted);">Total Kegiatan</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--navy); margin-top: 6px;" x-data="countUp(<?php echo e($totalKegiatan); ?>)" x-text="count">0</div>
        </div>
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #2e7d32;">Tepat Waktu</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: #2e7d32; margin-top: 6px;" x-data="countUp(<?php echo e($monevTepatWaktu); ?>)" x-text="count">0</div>
        </div>
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--red);">Terlambat</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--red); margin-top: 6px;" x-data="countUp(<?php echo e($monevTerlambat); ?>)" x-text="count">0</div>
        </div>
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--muted);">Keberhasilan</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--navy); margin-top: 6px;" x-data="countUp(<?php echo e($pctKeberhasilan); ?>)"><span x-text="count">0</span>%</div>
        </div>
    </div>

    
    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 20px;">
        
        <div style="display: flex; align-items: center; gap: 0;">
            <button type="button" wire:click="decrementTahun" style="padding: 8px 10px; border: 1px solid var(--line); border-right: none; border-radius: 6px 0 0 6px; background: #fff; cursor: pointer; color: var(--muted);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <span class="mono" style="display: inline-flex; align-items: center; justify-content: center; width: 65px; height: 38px; border: 1px solid var(--line); background: #fff; font-size: 14px; font-weight: 700; color: var(--navy);"><?php echo e($tahun); ?></span>
            <button type="button" wire:click="incrementTahun" style="padding: 8px 10px; border: 1px solid var(--line); border-left: none; border-radius: 0 6px 6px 0; background: #fff; cursor: pointer; color: var(--muted);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>

        <select wire:model.live="dinas_id" style="padding: 8px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; background: #fff; min-width: 180px; height: 38px; color: var(--ink);">
            <option value="">Semua OPD</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $dinasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d->id); ?>"><?php echo e($d->singkatan); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>

        <select wire:model.live="status" style="padding: 8px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; background: #fff; min-width: 160px; height: 38px; color: var(--ink);">
            <option value="">Semua Status</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Enums\StatusMonev::options(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($val); ?>"><?php echo e($lbl); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>

        <input type="text" wire:model.live.debounce.400ms="search" placeholder="Cari kegiatan..." style="padding: 8px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; background: #fff; width: 220px; height: 38px; color: var(--ink); outline: none;">
    </div>

    
    <div class="table-responsive" style="position: relative; background: #fff; border: 1px solid var(--line); border-radius: var(--radius); box-shadow: var(--shadow-sm);">
        
        <div wire:loading class="loading-overlay">
            <div class="spinner"></div>
        </div>

        <table style="width: 100%; border-collapse: collapse; font-size: 13px; min-width: 900px;">
            <thead>
                <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                    <th style="padding: 14px 16px; text-align: left; font-weight: 700; color: var(--navy); position: sticky; left: 0; background: var(--navy-50); z-index: 2; min-width: 50px;">No</th>
                    <th style="padding: 14px 16px; text-align: left; font-weight: 700; color: var(--navy); position: sticky; left: 50px; background: var(--navy-50); z-index: 2; min-width: 250px;">Kegiatan</th>
                    <th style="padding: 14px 16px; text-align: left; font-weight: 700; color: var(--navy); min-width: 100px;">OPD</th>
                    <th style="padding: 14px 16px; text-align: center; font-weight: 700; color: var(--navy); min-width: 80px;">Status</th>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = config('paseban.bulan'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m => $namaBulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th style="padding: 14px 8px; text-align: center; font-weight: 600; color: var(--muted); font-size: 11px; min-width: 36px;"><?php echo e($namaBulan); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $monevItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $monev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $statusEnum = $monev->status instanceof \App\Enums\StatusMonev ? $monev->status : \App\Enums\StatusMonev::tryFrom($monev->status);
                ?>
                <tr style="border-bottom: 1px solid var(--line);">
                    <td style="padding: 14px 16px; color: var(--muted); position: sticky; left: 0; background: #fff; z-index: 1;"><?php echo e($idx + 1); ?></td>
                    <td style="padding: 14px 16px; font-weight: 600; color: var(--navy); position: sticky; left: 50px; background: #fff; z-index: 1;"><?php echo e($monev->kegiatanStatistik->nama ?? '-'); ?></td>
                    <td style="padding: 14px 16px; color: var(--ink);"><?php echo e($monev->kegiatanStatistik->dinas->singkatan ?? '-'); ?></td>
                    <td style="padding: 14px 16px; text-align: center;">
                        <span style="display: inline-block; width: 115px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 11px; font-weight: 600; color: <?php echo e($statusEnum?->cssColor() ?? 'var(--muted)'); ?>; background: <?php echo e($statusEnum?->cssBgColor() ?? '#f5f5f5'); ?>;">
                            <?php echo e($statusEnum?->label() ?? ucfirst(str_replace('_', ' ', $monev->status))); ?>

                        </span>
                    </td>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($m = 1; $m <= 12; $m++): ?>
                        <?php
                            $isRencana = $m >= $monev->bulan_rencana_mulai && $m <= $monev->bulan_rencana_selesai;
                            $isRealisasi = $monev->bulan_realisasi_mulai && $monev->bulan_realisasi_selesai && $m >= $monev->bulan_realisasi_mulai && $m <= $monev->bulan_realisasi_selesai;
                            $cellBg = $isRealisasi ? 'var(--orange)' : ($isRencana ? 'var(--navy)' : 'transparent');
                        ?>
                        <td style="padding: 6px; text-align: center;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isRealisasi || $isRencana): ?>
                            <div class="scroll-reveal anim-fill-down" style="width: 24px; height: 24px; border-radius: 4px; background: <?php echo e($cellBg); ?>; opacity: <?php echo e($isRealisasi ? 1 : 0.25); ?>; margin: auto; --delay: <?php echo e(($idx * 100) + ($m * 500)); ?>ms;" title="<?php echo e($isRealisasi ? 'Realisasi' : 'Rencana'); ?>"></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="16" style="padding: 40px; text-align: center; color: var(--muted);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        <div style="font-weight: 600;">Belum ada data Monev</div>
                        <div style="font-size: 13px; margin-top: 6px;">Tidak ditemukan kegiatan untuk filter yang dipilih.</div>
                    </td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div style="display: flex; gap: 24px; margin-top: 16px; font-size: 12px; color: var(--muted); flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 8px;"><div style="width: 18px; height: 18px; border-radius: 3px; background: var(--navy); opacity: .25;"></div> Rencana</div>
        <div style="display: flex; align-items: center; gap: 8px;"><div style="width: 18px; height: 18px; border-radius: 3px; background: var(--orange);"></div> Realisasi</div>
    </div>
</div>
<?php /**PATH D:\PASEBAN APP\resources\views/livewire/monev-calendar.blade.php ENDPATH**/ ?>