<div>
    
    <div
        style="display: flex; justify-content: space-between; align-items: flex-start; gap: 24px; margin-bottom: 28px; flex-wrap: wrap;">
        <div>
            <h2 style="margin: 0; font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px;">
                Kegiatan Statistik Sektoral</h2>
        </div>
        <div style="display: flex; align-items: center; gap: 16px;">
            <a href="<?php echo e(route('monev.export.excel', ['tahun' => $tahun, 'dinas_id' => $dinas_id, 'status' => $status, 'search' => $search])); ?>"
                style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 6px; background: #2e7d32; color: #fff; font-size: 13px; font-weight: 600; text-decoration: none; letter-spacing: .2px; box-shadow: var(--shadow-sm); transition: background .15s;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Excel
            </a>
            <a href="<?php echo e(route('monev.export.pdf', ['tahun' => $tahun, 'dinas_id' => $dinas_id, 'status' => $status, 'search' => $search])); ?>"
                style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 6px; background: var(--red); color: #fff; font-size: 13px; font-weight: 600; text-decoration: none; letter-spacing: .2px; box-shadow: var(--shadow-sm); transition: background .15s;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10 9 9 9 8 9" />
                </svg>
                PDF
            </a>
        </div>
    </div>

    
    <div wire:key="stats-<?php echo e($tahun); ?>-<?php echo e($dinas_id); ?>-<?php echo e($status); ?>-<?php echo e(md5($search)); ?>"
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 20px;">
        <div
            style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div
                style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--muted);">
                Total Kegiatan</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--navy); margin-top: 6px;"
                x-data="countUp(<?php echo e($totalKegiatan); ?>)" x-text="count">0</div>
        </div>
        <div
            style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div
                style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #2e7d32;">
                Tepat Waktu</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: #2e7d32; margin-top: 6px;"
                x-data="countUp(<?php echo e($monevTepatWaktu); ?>)" x-text="count">0</div>
        </div>
        <div
            style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div
                style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--red);">
                Terlambat</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--red); margin-top: 6px;"
                x-data="countUp(<?php echo e($monevTerlambat); ?>)" x-text="count">0</div>
        </div>
        <div
            style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 18px; box-shadow: var(--shadow-sm);">
            <div
                style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--muted);">
                Keberhasilan</div>
            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--navy); margin-top: 6px;"
                x-data="countUp(<?php echo e($pctKeberhasilan); ?>)"><span x-text="count">0</span>%</div>
        </div>
    </div>

    
    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 20px;">
        
        <div style="display: flex; align-items: center; gap: 0;">
            <button type="button" wire:click="decrementTahun"
                style="padding: 8px 10px; border: 1px solid var(--line); border-right: none; border-radius: 6px 0 0 6px; background: #fff; cursor: pointer; color: var(--muted);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>
            <span class="mono"
                style="display: inline-flex; align-items: center; justify-content: center; width: 65px; height: 38px; border: 1px solid var(--line); background: #fff; font-size: 14px; font-weight: 700; color: var(--navy);"><?php echo e($tahun); ?></span>
            <button type="button" wire:click="incrementTahun"
                style="padding: 8px 10px; border: 1px solid var(--line); border-left: none; border-radius: 0 6px 6px 0; background: #fff; cursor: pointer; color: var(--muted);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
        </div>

        <select class="styled-select" wire:model.live="dinas_id"
            style="padding: 8px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; background: #fff; min-width: 180px; height: 38px; color: var(--ink);">
            <option value="">Semua OPD</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $dinasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d->id); ?>"><?php echo e($d->singkatan); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>

        <select class="styled-select" wire:model.live="status"
            style="padding: 8px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; background: #fff; min-width: 160px; height: 38px; color: var(--ink);">
            <option value="">Semua Status</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Enums\StatusMonev::options(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($val); ?>"><?php echo e($lbl); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>

        <select class="styled-select" wire:model.live="jenis_laporan"
            style="padding: 8px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; background: #fff; min-width: 140px; height: 38px; color: var(--ink);">
            <option value="kegiatan">Kalender Kegiatan</option>
            <option value="metadata">Kalender Metadata</option>
            <option value="romantik">Kalender Romantik</option>
        </select>

        <input type="text" wire:model.live.debounce.400ms="search" placeholder="Cari kegiatan..."
            style="padding: 8px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; background: #fff; width: 220px; height: 38px; color: var(--ink); outline: none;">
    </div>

    
    <div style="position: relative; background: #fff; border: 1px solid var(--line); border-radius: var(--radius); box-shadow: var(--shadow-sm);"
        x-data="{ perPage: 10, page: 1 }">
        <div
            style="padding: 16px 20px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 13.5px; color: var(--muted);">Tampilkan</span>
                <select class="styled-select" x-model.number="perPage"
                    style="padding: 6px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; outline: none;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span style="font-size: 13.5px; color: var(--muted);">entri</span>
            </div>
        </div>
        <div class="table-responsive desktop-only">
            <table
                style="width: 100%; border-collapse: collapse; font-size: 13px; min-width: 900px; table-layout: fixed;">
                <thead>
                    <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                        <th
                            style="padding: 14px 16px; text-align: left; font-weight: 700; color: var(--navy); position: sticky; left: 0; background: var(--navy-50); z-index: 2; width: 50px;">
                            No</th>
                        <th
                            style="padding: 14px 16px; text-align: left; font-weight: 700; color: var(--navy); position: sticky; left: 50px; background: var(--navy-50); z-index: 2; width: 35%;">
                            Kegiatan</th>
                        <th
                            style="padding: 14px 16px; text-align: left; font-weight: 700; color: var(--navy); width: 10%;">
                            OPD</th>
                        <th
                            style="padding: 14px 16px; text-align: center; font-weight: 700; color: var(--navy); width: 12%;">
                            Status</th>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = config('paseban.bulan'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m => $namaBulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th
                                style="padding: 14px 8px; text-align: center; font-weight: 600; color: var(--muted); font-size: 11px;">
                                <?php echo e($namaBulan); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $monevItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $monev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $statusEnum = $monev->status instanceof \App\Enums\StatusMonev ? $monev->status : \App\Enums\StatusMonev::tryFrom($monev->status);
                        ?>
                        <tr wire:key="desk-<?php echo e($monev->kegiatan_id); ?>" style="border-bottom: 1px solid var(--line);"
                            x-show="page === Math.ceil(<?php echo e($idx + 1); ?> / perPage)">
                            <td
                                style="padding: 14px 16px; color: var(--muted); position: sticky; left: 0; background: #fff; z-index: 1; vertical-align: middle;">
                                <?php echo e($idx + 1); ?></td>
                            <td
                                style="padding: 14px 16px; font-weight: 600; color: var(--navy); position: sticky; left: 50px; background: #fff; z-index: 1; vertical-align: middle;">
                                <?php echo e($monev->kegiatanStatistik->nama ?? '-'); ?></td>
                            <td style="padding: 14px 16px; color: var(--ink); vertical-align: middle;">
                                <?php echo e($monev->kegiatanStatistik->dinas->singkatan ?? '-'); ?></td>
                            <td style="padding: 14px 16px; text-align: center; vertical-align: middle;">
                                <span
                                    style="display: inline-block; width: 115px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 11px; font-weight: 600; color: <?php echo e($statusEnum?->cssColor() ?? 'var(--muted)'); ?>; background: <?php echo e($statusEnum?->cssBgColor() ?? '#f5f5f5'); ?>;">
                                    <?php echo e($statusEnum?->label() ?? ucfirst(str_replace('_', ' ', $monev->status))); ?>

                                </span>
                            </td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($m = 1; $m <= 12; $m++): ?>
                                <?php
                                    $b_renc_m = null;
                                    $b_renc_s = null;
                                    $b_real_m = null;
                                    $b_real_s = null;
                                    if ($jenis_laporan === 'kegiatan') {
                                        $b_renc_m = $monev->bulan_rencana_mulai;
                                        $b_renc_s = $monev->bulan_rencana_selesai;
                                        $b_real_m = $monev->bulan_realisasi_mulai;
                                        $b_real_s = $monev->bulan_realisasi_selesai;
                                    } elseif ($jenis_laporan === 'metadata') {
                                        $b_renc_m = $monev->metadata_bulan_rencana_mulai ?? null;
                                        $b_renc_s = $monev->metadata_bulan_rencana_selesai ?? null;
                                        $b_real_m = $monev->metadata_bulan_realisasi_mulai ?? null;
                                        $b_real_s = $monev->metadata_bulan_realisasi_selesai ?? null;
                                    } elseif ($jenis_laporan === 'romantik') {
                                        $b_renc_m = $monev->romantik_bulan_rencana_mulai ?? null;
                                        $b_renc_s = $monev->romantik_bulan_rencana_selesai ?? null;
                                        $b_real_m = $monev->romantik_bulan_realisasi_mulai ?? null;
                                        $b_real_s = $monev->romantik_bulan_realisasi_selesai ?? null;
                                    }

                                    $isRencana = $b_renc_m && $m >= $b_renc_m && $m <= $b_renc_s;
                                    $isRealisasi = $b_real_m && $b_real_s && $m >= $b_real_m && $m <= $b_real_s;
                                    $cellBg = $isRealisasi ? 'var(--orange)' : ($isRencana ? 'var(--navy)' : 'transparent');
                                    $opacity = $isRealisasi ? 1 : ($isRencana ? 0.25 : 0);
                                    $scale = ($isRealisasi || $isRencana) ? 1 : 0.4;
                                    $localIdx = $idx % 10;
                                    $delayMs = ($localIdx * 12 + $m) * 12;
                                ?>
                                <td style="padding: 6px; text-align: center; vertical-align: middle;">
                                    <div style="width: 24px; height: 24px; border-radius: 4px; background: <?php echo e($cellBg); ?>; opacity: <?php echo e($opacity); ?>; transform: scale(<?php echo e($scale); ?>); margin: auto; transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1) <?php echo e($delayMs); ?>ms;"
                                        title="<?php echo e($isRealisasi ? 'Realisasi' : ($isRencana ? 'Rencana' : '-')); ?>"></div>
                                </td>
                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="16" style="padding: 40px; text-align: center; color: var(--muted);">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    style="margin: 0 auto 12px; opacity: .4;">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                <div style="font-weight: 600;">Belum ada data Monev</div>
                                <div style="font-size: 13px; margin-top: 6px;">Tidak ditemukan kegiatan untuk filter yang
                                    dipilih.</div>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="mobile-only">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $monevItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $monev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $statusEnum = $monev->status instanceof \App\Enums\StatusMonev ? $monev->status : \App\Enums\StatusMonev::tryFrom($monev->status);
                ?>
                <div wire:key="mob-<?php echo e($monev->kegiatan_id); ?>"
                    style="border-bottom: 1px solid var(--line); padding: 16px 20px; display: flex; flex-direction: column; gap: 14px;"
                    x-show="page === Math.ceil(<?php echo e($idx + 1); ?> / perPage)">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px;">
                        <div>
                            <div
                                style="font-size: 11px; color: var(--muted); font-weight: 700; margin-bottom: 4px; display: flex; gap: 6px;">
                                <span>#<?php echo e($idx + 1); ?></span> &middot;
                                <span><?php echo e($monev->kegiatanStatistik->dinas->singkatan ?? '-'); ?></span>
                            </div>
                            <div style="font-size: 14.5px; font-weight: 700; color: var(--navy); line-height: 1.35;">
                                <?php echo e($monev->kegiatanStatistik->nama ?? '-'); ?></div>
                        </div>
                        <div
                            style="flex-shrink: 0; display: flex; flex-direction: column; gap: 4px; align-items: flex-end;">
                            <span
                                style="display: inline-block; padding: 4px 8px; border-radius: 6px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: <?php echo e($statusEnum?->cssColor() ?? 'var(--muted)'); ?>; background: <?php echo e($statusEnum?->cssBgColor() ?? '#f5f5f5'); ?>;">
                                <?php echo e($statusEnum?->label() ?? ucfirst(str_replace('_', ' ', $monev->status))); ?>

                            </span>
                        </div>
                    </div>

                    <div>
                        <div style="font-size: 11px; color: var(--muted); margin-bottom: 8px; font-weight: 600;">Jadwal
                            Rencana vs Realisasi:</div>
                        <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 2px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = config('paseban.bulan'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m => $namaBulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $b_renc_m = null;
                                    $b_renc_s = null;
                                    $b_real_m = null;
                                    $b_real_s = null;
                                    if ($jenis_laporan === 'kegiatan') {
                                        $b_renc_m = $monev->bulan_rencana_mulai;
                                        $b_renc_s = $monev->bulan_rencana_selesai;
                                        $b_real_m = $monev->bulan_realisasi_mulai;
                                        $b_real_s = $monev->bulan_realisasi_selesai;
                                    } elseif ($jenis_laporan === 'metadata') {
                                        $b_renc_m = $monev->metadata_bulan_rencana_mulai ?? null;
                                        $b_renc_s = $monev->metadata_bulan_rencana_selesai ?? null;
                                        $b_real_m = $monev->metadata_bulan_realisasi_mulai ?? null;
                                        $b_real_s = $monev->metadata_bulan_realisasi_selesai ?? null;
                                    } elseif ($jenis_laporan === 'romantik') {
                                        $b_renc_m = $monev->romantik_bulan_rencana_mulai ?? null;
                                        $b_renc_s = $monev->romantik_bulan_rencana_selesai ?? null;
                                        $b_real_m = $monev->romantik_bulan_realisasi_mulai ?? null;
                                        $b_real_s = $monev->romantik_bulan_realisasi_selesai ?? null;
                                    }

                                    $isRencana = $b_renc_m && $m >= $b_renc_m && $m <= $b_renc_s;
                                    $isRealisasi = $b_real_m && $b_real_s && $m >= $b_real_m && $m <= $b_real_s;
                                    $cellBg = $isRealisasi ? 'var(--orange)' : ($isRencana ? 'var(--navy)' : 'rgba(0,0,0,0.03)');
                                    $opacity = $isRealisasi ? 1 : ($isRencana ? 0.3 : 1);
                                    $border = (!$isRealisasi && !$isRencana) ? '1px solid rgba(0,0,0,0.06)' : 'none';
                                    $localIdx = $idx % 10;
                                    $delayMs = ($localIdx * 12 + $m) * 12;
                                ?>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;"
                                    title="<?php echo e($namaBulan); ?> - <?php echo e($isRealisasi ? 'Realisasi' : ($isRencana ? 'Rencana' : '-')); ?>">
                                    <div class="mono"
                                        style="font-size: 9px; color: var(--muted); font-weight: 600; letter-spacing: -0.5px; transition: color 0.3s ease <?php echo e($delayMs); ?>ms;">
                                        <?php echo e(substr($namaBulan, 0, 1)); ?></div>
                                    <div
                                        style="width: 100%; height: 24px; border-radius: 4px; background: <?php echo e($cellBg); ?>; opacity: <?php echo e($opacity); ?>; border: <?php echo e($border); ?>; transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1) <?php echo e($delayMs); ?>ms;">
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding: 40px; text-align: center; color: var(--muted);">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                    <div style="font-weight: 600;">Belum ada data Monev</div>
                    <div style="font-size: 13px; margin-top: 6px;">Tidak ditemukan kegiatan untuk filter yang dipilih.</div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div
            style="padding: 16px 20px; border-top: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; padding-bottom: 30px;">
            <div style="font-size: 13.5px; color: var(--muted);">
                Menampilkan entri dari total <?php echo e(count($monevItems)); ?>

            </div>
            <div style="display: flex; gap: 8px;">
                <button type="button" @click="if(page > 1) page--"
                    style="padding: 6px 12px; border: 1px solid var(--line); background: #fff; border-radius: 6px; font-size: 13px; cursor: pointer;"
                    :style="page === 1 ? 'opacity: 0.5; cursor: not-allowed;' : ''">Sebelumnya</button>
                <button type="button" @click="if(page < Math.ceil(<?php echo e(count($monevItems)); ?> / perPage)) page++"
                    style="padding: 6px 12px; border: 1px solid var(--line); background: #fff; border-radius: 6px; font-size: 13px; cursor: pointer;"
                    :style="page >= Math.ceil(<?php echo e(count($monevItems)); ?> / perPage) ? 'opacity: 0.5; cursor: not-allowed;' : ''">Selanjutnya</button>
            </div>
        </div>
    </div>

    
    <div style="display: flex; gap: 24px; margin-top: 16px; font-size: 12px; color: var(--muted); flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 18px; height: 18px; border-radius: 3px; background: var(--navy); opacity: .25;"></div>
            Rencana
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 18px; height: 18px; border-radius: 3px; background: var(--orange);"></div> Realisasi
        </div>
    </div>
</div><?php /**PATH D:\PASEBAN APP\resources\views/livewire/monev-calendar.blade.php ENDPATH**/ ?>