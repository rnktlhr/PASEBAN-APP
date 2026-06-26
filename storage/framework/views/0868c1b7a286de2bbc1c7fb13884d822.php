

<?php $__env->startSection('title', 'Pembinaan Statistik Sektoral — Paseban'); ?>

<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">

    <!-- Header Section -->
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 32px; font-weight: 800; color: var(--navy); margin: 0 0 12px; letter-spacing: -0.5px;">Pembinaan Statistik Sektoral</h1>
        <p style="color: var(--muted); font-size: 16px; line-height: 1.6; max-width: 800px; margin: 0;">
            Materi dan dokumentasi pembinaan kegiatan statistik sektoral OPD Kabupaten Bantul — sosialisasi, panduan teknis, hingga forum evaluasi tahunan.
        </p>
    </div>

    <!-- Hero Banner -->
    <div style="background: var(--navy); border-radius: 12px; padding: 44px 48px; display: grid; grid-template-columns: 1.6fr 1fr; gap: 32px; align-items: center; position: relative; overflow: hidden; margin-bottom: 60px; box-shadow: var(--shadow-md);" class="cards-grid">
        <svg style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: .08;" aria-hidden="true">
            <defs>
                <pattern id="dots" width="22" height="22" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1.2" fill="#fff" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dots)" />
        </svg>
        <div style="position: absolute; right: -60px; top: -60px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(235,137,27,.35), transparent 65%); border-radius: 50%;">
        </div>

        <div style="position: relative; color: #fff;">

            <h2 style="margin: 0; font-size: 30px; font-weight: 800; letter-spacing: -.6px; line-height: 1.15;">
                Pembinaan Statistik Sektoral Kabupaten Bantul
            </h2>
            <p style="margin: 14px 0 24px; font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,.78); max-width: 540px;">
                Materi dan dokumentasi pembinaan kegiatan statistik sektoral — akses panduan teknis, regulasi, dan modul pelatihan untuk seluruh OPD se-Kabupaten Bantul.
            </p>
            <a href="https://bpsbantul.my.canva.site/pss2026" target="_blank" rel="noopener noreferrer" class="w-full-mobile" style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 13px 22px; border-radius: 6px; background: var(--orange); color: #fff; font-weight: 700; font-size: 14px; box-shadow: 0 6px 18px rgba(235,137,27,.4); text-decoration: none; transition: transform .15s ease;">
                Masuk Modul Pembinaan
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
            </a>
        </div>

        <div style="position: relative; display: flex; justify-content: center;" class="w-full-mobile">
            <div class="w-full-mobile" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 20px 50px rgba(0,0,0,.3); display: flex; flex-direction: column; width: 100%; max-width: 380px; box-sizing: border-box;">
                <div style="font-size: 13px; font-weight: 600; color: var(--muted); margin-bottom: 8px;">Tingkat Kehadiran OPD</div>
                <h3 style="font-size: 16px; font-weight: 800; color: var(--navy); margin: 0 0 24px;">Ringkasan <?php echo e($totalOPD); ?> OPD - <?php echo e($totalSesi); ?> Sesi</h3>
                
                <div style="display: flex; align-items: center; gap: 32px; flex: 1;">
                    <div style="position: relative; width: 120px; height: 120px;" x-data="{ pct: 0, count: 0 }" x-init="
                        setTimeout(() => { pct = <?php echo e($persentaseKehadiran); ?> }, 300);
                        let start = 0;
                        let end = <?php echo e($persentaseKehadiran); ?>;
                        let duration = 1500;
                        let startTimestamp = null;
                        const step = (timestamp) => {
                            if (!startTimestamp) startTimestamp = timestamp;
                            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                            const ease = 1 - Math.pow(1 - progress, 4);
                            count = Math.floor(ease * (end - start) + start);
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            }
                        };
                        setTimeout(() => window.requestAnimationFrame(step), 300);
                    ">
                        <svg viewBox="0 0 36 36" style="width: 100%; height: 100%;">
                            <!-- Background Circle -->
                            <path class="circle-bg"
                                d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="var(--bg)"
                                stroke-width="4"
                                stroke-dasharray="100, 100" />
                            <!-- Progress Circle -->
                            <path class="circle"
                                :stroke-dasharray="pct + ', 100'"
                                d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="var(--orange)"
                                stroke-width="4"
                                stroke-linecap="round"
                                style="transition: stroke-dasharray 1.5s cubic-bezier(0.165, 0.84, 0.44, 1);" />
                        </svg>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <div class="mono" style="font-size: 24px; font-weight: 800; color: var(--navy); line-height: 1;"><span x-text="count">0</span>%</div>
                            <div style="font-size: 10px; font-weight: 600; color: var(--muted);">HADIR</div>
                        </div>
                    </div>
                    
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--orange);"></div>
                                <span style="font-size: 13.5px; font-weight: 500; color: var(--ink);">Hadir</span>
                            </div>
                            <span class="mono" style="font-size: 14px; font-weight: 700; color: var(--navy);"><?php echo e($totalKehadiran); ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--bg);"></div>
                                <span style="font-size: 13.5px; font-weight: 500; color: var(--ink);">Tidak Hadir</span>
                            </div>
                            <span class="mono" style="font-size: 14px; font-weight: 700; color: var(--navy);"><?php echo e(($totalSesi * $totalOPD) - $totalKehadiran); ?></span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px dashed var(--line); font-size: 13px; color: var(--muted); line-height: 1.5;">
                    <strong style="color: var(--navy);">Tingkat Kehadiran OPD <?php echo e($persentaseKehadiran); ?>%</strong> — representasi partisipasi dinas pada sesi pembinaan yang tercatat.
                </div>
            </div>
        </div>
    </div>


    <!-- Kegiatan Pendampingan Section -->
    <div style="margin-bottom: 60px;">
        <div class="flex-col-mobile" style="margin-bottom: 24px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Kegiatan Pendampingan Terkini</h2>
                <p style="color: var(--muted); font-size: 15px; margin: 0;">Dokumentasi dan laporan hasil kegiatan pendampingan sektoral.</p>
            </div>
            <a href="<?php echo e(route('kegiatan-pendampingan.index')); ?>" class="align-end-mobile" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #fff; color: var(--orange); border: 1px solid var(--line); border-radius: 30px; font-size: 13px; font-weight: 700; text-decoration: none; box-shadow: var(--shadow-sm); transition: all 0.2s;">
                Lihat Semua
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $latestKegiatanPendampingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm); display: flex; flex-direction: column;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ba->gambar): ?>
                <div style="height: 200px; background-image: url('<?php echo e(asset('storage/'.$ba->gambar)); ?>'); background-size: cover; background-position: center; position: relative;">
                <?php else: ?>
                <div style="height: 200px; background: linear-gradient(135deg, var(--navy), var(--orange)); position: relative;">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div style="position: absolute; top: 16px; left: 16px; background: var(--orange); color: #fff; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px;"><?php echo e($ba->kategori); ?></div>
                </div>
                <div style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
                    <div style="font-size: 12px; font-family: monospace; color: var(--muted); margin-bottom: 8px;"><?php echo e($ba->tanggal->format('d M Y')); ?></div>
                    <h3 style="font-size: 16px; font-weight: 800; color: var(--navy); margin: 0 0 12px; line-height: 1.4;"><?php echo e($ba->judul); ?></h3>
                    <p style="font-size: 13.5px; color: var(--muted); line-height: 1.6; margin: 0 0 24px; flex: 1;"><?php echo e($ba->ringkasan); ?></p>
                    <a href="<?php echo e(route('kegiatan-pendampingan.show', $ba->id)); ?>" style="color: var(--orange); font-size: 13px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                        Lihat Detail
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Rekap Kehadiran -->
    <div style="margin-bottom: 60px;">
        <div class="flex-col-mobile" style="margin-bottom: 24px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Rekap Kehadiran Pembinaan</h2>
                <p style="color: var(--muted); font-size: 15px; margin: 0;">Data kehadiran OPD per sesi pembinaan tahun 2026.</p>
            </div>
            <div class="w-full-mobile" style="display: flex; gap: 12px;">
                <select class="w-full-mobile" style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 14px center; background-size: 14px; -webkit-appearance: none; appearance: none; cursor: pointer;">
                    <option>Semua Program</option>
                </select>
                <button class="w-full-mobile" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; background: #fff; border: 1px solid var(--line); color: var(--ink); border-radius: 8px; font-weight: 600; font-size: 13.5px; box-shadow: var(--shadow-sm); cursor: pointer;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Ekspor
                </button>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 24px;">
            <!-- Table -->
            <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm);" x-data="{ perPage: 10, page: 1 }">
                <div style="padding: 16px 20px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 13.5px; color: var(--muted);">Tampilkan</span>
                        <select class="styled-select" x-model.number="perPage" style="padding: 6px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; outline: none;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span style="font-size: 13.5px; color: var(--muted);">entri</span>
                    </div>
                </div>
                <div class="table-responsive desktop-only">
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                                <th style="padding: 16px 20px; text-align: left; font-weight: 700; color: var(--navy);">OPD</th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sesiPembinaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sesi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); white-space: nowrap;">Sesi <?php echo e($index + 1); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 90px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $rekapKehadiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $rekap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr style="border-bottom: 1px solid var(--line);" x-show="page === Math.ceil(<?php echo e($idx + 1); ?> / perPage)">
                                <td style="padding: 16px 20px; font-weight: 600; color: var(--ink);">
                                    <?php echo e($rekap['dinas']->nama); ?>

                                </td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sesiPembinaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sesi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td style="padding: 16px; text-align: center;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($rekap['kehadiran'][$sesi->id]) && $rekap['kehadiran'][$sesi->id]): ?>
                                        <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--orange-50); color: var(--orange); display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                    <?php else: ?>
                                        <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--bg); color: var(--muted); display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <td style="padding: 16px; text-align: center; font-weight: 700; color: var(--orange);"><?php echo e($rekap['total']); ?>/<?php echo e($totalSesi); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="<?php echo e(count($sesiPembinaan) + 2); ?>" style="padding: 40px; text-align: center; color: var(--muted);">
                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <div style="font-weight: 600;">Belum ada data rekap kehadiran</div>
                                    <div style="font-size: 13px; margin-top: 6px;">Kehadiran OPD akan muncul setelah sesi pembinaan berjalan.</div>
                                </td>
                            </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="mobile-only">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $rekapKehadiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $rekap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div style="border-bottom: 1px solid var(--line); padding: 16px 20px; display: flex; flex-direction: column; gap: 12px;" x-show="page === Math.ceil(<?php echo e($idx + 1); ?> / perPage)">
                        <div style="font-size: 14.5px; font-weight: 700; color: var(--navy); line-height: 1.35;"><?php echo e($rekap['dinas']->nama); ?></div>
                        
                        <div style="display: grid; grid-template-columns: 1fr; gap: 8px; margin-top: 4px; background: var(--navy-50); padding: 12px; border-radius: 8px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sesiPembinaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sesi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Sesi <?php echo e($index + 1); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($rekap['kehadiran'][$sesi->id]) && $rekap['kehadiran'][$sesi->id]): ?>
                                    <div style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: var(--orange); background: var(--orange-50);">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> Hadir
                                    </div>
                                <?php else: ?>
                                    <div style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: var(--muted); background: var(--bg);">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg> Belum
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed rgba(0,0,0,0.1); padding-top: 8px; margin-top: 4px;">
                                <span style="font-size: 12px; font-weight: 700; color: var(--navy);">Total Kehadiran</span>
                                <span style="font-size: 13px; font-weight: 800; color: var(--orange);"><?php echo e($rekap['total']); ?>/<?php echo e($totalSesi); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="padding: 40px; text-align: center; color: var(--muted);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <div style="font-weight: 600;">Belum ada data rekap kehadiran</div>
                        <div style="font-size: 13px; margin-top: 6px;">Kehadiran OPD akan muncul setelah sesi pembinaan berjalan.</div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($rekapKehadiran) > 0): ?>
            <div style="padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div style="font-size: 13.5px; color: var(--muted);">
                    Menampilkan entri dari total <?php echo e(count($rekapKehadiran)); ?>

                </div>
                <div style="display: flex; gap: 12px;">
                    <button @click="if(page > 1) page--" style="padding: 8px 16px; font-size: 14px; font-weight: 500; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); color: #475569; cursor: pointer; transition: all 0.2s;" :style="page === 1 ? 'color: #94a3b8; cursor: not-allowed;' : ''" onmouseover="if(page > 1) this.style.background='#f8fafc';" onmouseout="this.style.background='#fff';">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        Previous
                    </button>
                    <button @click="if(page < Math.ceil(<?php echo e(count($rekapKehadiran)); ?> / perPage)) page++" style="padding: 8px 16px; font-size: 14px; font-weight: 500; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); color: #0052CC; cursor: pointer; transition: all 0.2s;" :style="page >= Math.ceil(<?php echo e(count($rekapKehadiran)); ?> / perPage) ? 'color: #94a3b8; cursor: not-allowed;' : ''" onmouseover="if(page < Math.ceil(<?php echo e(count($rekapKehadiran)); ?> / perPage)) this.style.background='#f0f4ff';" onmouseout="this.style.background='#fff';">
                        Next
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Pustaka Section -->
    <div id="materi">
        <div class="flex-col-mobile" style="margin-bottom: 24px;">
            <div>
                <h2 style="font-size: 24px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Materi Pembinaan</h2>
                <p style="color: var(--muted); font-size: 15px; margin: 0;">Unduh modul, panduan, dan rekaman pembinaan statistik sektoral.</p>
            </div>
            <div class="w-full-mobile" style="position: relative; width: 100%;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" class="w-full-mobile" placeholder="Cari materi..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; width: 100%; max-width: 280px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm);">
            </div>
        </div>

        <div x-data="{ perPage: 10, page: 1 }">
            <div style="background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
                <div style="padding: 16px 20px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 13.5px; color: var(--muted);">Tampilkan</span>
                    <select class="styled-select" x-model.number="perPage" style="padding: 6px 12px; border: 1px solid var(--line); border-radius: 6px; font-size: 13px; outline: none;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span style="font-size: 13.5px; color: var(--muted);">entri</span>
                </div>
            </div>
            <div class="table-responsive desktop-only">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                            <th style="padding: 16px 20px; text-align: left; font-weight: 700; color: var(--navy);">Judul Materi</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 120px;">Jenis</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 160px;">Tanggal</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 160px;">Unduh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $materiPembinaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $materi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr style="border-bottom: 1px solid var(--line);" x-show="page === Math.ceil(<?php echo e($idx + 1); ?> / perPage)">
                            <td style="padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($materi->jenis == 'VIDEO'): ?>
                                <div style="width: 40px; height: 40px; background: rgba(235, 137, 27, 0.1); color: var(--orange); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                </div>
                                <?php elseif($materi->jenis == 'DOCX'): ?>
                                <div style="width: 40px; height: 40px; background: rgba(37, 99, 235, 0.1); color: #2563eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                <?php else: ?>
                                <div style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.1); color: #dc2626; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div>
                                    <div style="font-weight: 700; color: var(--navy); margin-bottom: 4px;"><?php echo e($materi->judul); ?></div>
                                    <div style="font-size: 12px; color: var(--muted);"><?php echo e($materi->ukuran_file ?? '-'); ?></div>
                                </div>
                            </td>
                            <td style="padding: 20px; text-align: center;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($materi->jenis == 'VIDEO'): ?>
                                <span style="font-size: 10px; font-weight: 800; color: var(--orange); background: rgba(235, 137, 27, 0.1); padding: 4px 8px; border-radius: 4px;">VIDEO</span>
                                <?php elseif($materi->jenis == 'DOCX'): ?>
                                <span style="font-size: 10px; font-weight: 800; color: #2563eb; background: rgba(37, 99, 235, 0.1); padding: 4px 8px; border-radius: 4px;">DOCX</span>
                                <?php else: ?>
                                <span style="font-size: 10px; font-weight: 800; color: #dc2626; background: rgba(220, 38, 38, 0.1); padding: 4px 8px; border-radius: 4px;">PDF</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td style="padding: 20px; text-align: center; color: var(--muted);"><?php echo e($materi->tanggal ? $materi->tanggal->format('M Y') : '-'); ?></td>
                            <td style="padding: 20px; text-align: center;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($materi->jenis == 'VIDEO' && $materi->link_url): ?>
                                <a href="<?php echo e($materi->link_url); ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border: 1px solid var(--ink); color: var(--ink); border-radius: 6px; font-weight: 600; font-size: 13px; text-decoration: none; background: transparent; transition: all 0.2s; cursor: pointer;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                    Putar Video
                                </a>
                                <?php elseif($materi->file_path || $materi->link_url): ?>
                                <a href="<?php echo e($materi->file_path ? asset('storage/' . $materi->file_path) : $materi->link_url); ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border: 1px solid var(--orange); color: var(--orange); border-radius: 6px; font-weight: 600; font-size: 13px; text-decoration: none; background: transparent; transition: all 0.2s; cursor: pointer;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    Unduh
                                </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" style="padding: 40px; text-align: center; color: var(--muted);">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <div style="font-weight: 600;">Belum ada materi pembinaan</div>
                                <div style="font-size: 13px; margin-top: 6px;">Materi akan muncul di sini setelah ditambahkan oleh admin.</div>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mobile-only">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $materiPembinaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $materi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="border-bottom: 1px solid var(--line); padding: 16px 20px; display: flex; flex-direction: column; gap: 12px;" x-show="page === Math.ceil(<?php echo e($idx + 1); ?> / perPage)">
                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($materi->jenis == 'VIDEO'): ?>
                        <div style="width: 40px; height: 40px; background: rgba(235, 137, 27, 0.1); color: var(--orange); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                        </div>
                        <?php elseif($materi->jenis == 'DOCX'): ?>
                        <div style="width: 40px; height: 40px; background: rgba(37, 99, 235, 0.1); color: #2563eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <?php else: ?>
                        <div style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.1); color: #dc2626; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: var(--navy); margin-bottom: 4px; font-size: 14.5px; line-height: 1.35;"><?php echo e($materi->judul); ?></div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($materi->jenis == 'VIDEO'): ?>
                                <span style="font-size: 10px; font-weight: 800; color: var(--orange); background: rgba(235, 137, 27, 0.1); padding: 2px 6px; border-radius: 4px;">VIDEO</span>
                                <?php elseif($materi->jenis == 'DOCX'): ?>
                                <span style="font-size: 10px; font-weight: 800; color: #2563eb; background: rgba(37, 99, 235, 0.1); padding: 2px 6px; border-radius: 4px;">DOCX</span>
                                <?php else: ?>
                                <span style="font-size: 10px; font-weight: 800; color: #dc2626; background: rgba(220, 38, 38, 0.1); padding: 2px 6px; border-radius: 4px;">PDF</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span style="font-size: 11px; color: var(--muted);"><?php echo e($materi->tanggal ? $materi->tanggal->format('d M Y') : '-'); ?> &middot; <?php echo e($materi->ukuran_file ?? 'Link'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 4px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($materi->jenis == 'VIDEO' && $materi->link_url): ?>
                        <a href="<?php echo e($materi->link_url); ?>" target="_blank" style="display: flex; justify-content: center; align-items: center; gap: 6px; padding: 10px 16px; border: 1px solid var(--line); color: var(--ink); border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none; background: #fff; box-shadow: var(--shadow-sm);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            Putar Video
                        </a>
                        <?php elseif($materi->file_path || $materi->link_url): ?>
                        <a href="<?php echo e($materi->file_path ? asset('storage/' . $materi->file_path) : $materi->link_url); ?>" target="_blank" style="display: flex; justify-content: center; align-items: center; gap: 6px; padding: 10px 16px; border: 1px solid var(--orange); color: #fff; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none; background: var(--orange); box-shadow: 0 4px 10px rgba(235,137,27,.25);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            Unduh Materi
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding: 40px; text-align: center; color: var(--muted);">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: .4;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <div style="font-weight: 600;">Belum ada materi pembinaan</div>
                    <div style="font-size: 13px; margin-top: 6px;">Materi akan muncul di sini setelah ditambahkan oleh admin.</div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($materiPembinaan) > 0): ?>
            <div style="padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div style="font-size: 13.5px; color: var(--muted);">
                    Menampilkan entri dari total <?php echo e(count($materiPembinaan)); ?>

                </div>
                <div style="display: flex; gap: 12px;">
                    <button @click="if(page > 1) page--" style="padding: 8px 16px; font-size: 14px; font-weight: 500; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); color: #475569; cursor: pointer; transition: all 0.2s;" :style="page === 1 ? 'color: #94a3b8; cursor: not-allowed;' : ''" onmouseover="if(page > 1) this.style.background='#f8fafc';" onmouseout="this.style.background='#fff';">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        Previous
                    </button>
                    <button @click="if(page < Math.ceil(<?php echo e(count($materiPembinaan)); ?> / perPage)) page++" style="padding: 8px 16px; font-size: 14px; font-weight: 500; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); color: #0052CC; cursor: pointer; transition: all 0.2s;" :style="page >= Math.ceil(<?php echo e(count($materiPembinaan)); ?> / perPage) ? 'color: #94a3b8; cursor: not-allowed;' : ''" onmouseover="if(page < Math.ceil(<?php echo e(count($materiPembinaan)); ?> / perPage)) this.style.background='#f0f4ff';" onmouseout="this.style.background='#fff';">
                        Next
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/pembinaan.blade.php ENDPATH**/ ?>