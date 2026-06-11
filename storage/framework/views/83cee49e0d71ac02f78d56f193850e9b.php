<?php $__env->startSection('content'); ?>
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);" x-data="{ search: '', dinasFilter: '' }">
    <div class="flex-col-mobile" style="margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Aliran Data <?php echo e($tahun); ?></h1>
            <p style="color: var(--muted); font-size: 15px; margin: 0;">Status publikasi data hasil kegiatan statistik pada portal Sedata Sebantul.</p>
        </div>

        <div style="display: flex; gap: 12px; align-items: center;">
            <select x-model="dinasFilter" style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 14px center; background-size: 14px; -webkit-appearance: none; appearance: none; box-shadow: var(--shadow-sm); transition: border-color 0.2s, box-shadow 0.2s; max-width: 200px; cursor: pointer;" onfocus="this.style.borderColor='var(--orange)'; this.style.boxShadow='0 0 0 3px rgba(235, 137, 27, 0.1)';" onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='var(--shadow-sm)';">
                <option value="">Semua OPD / Dinas</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $dinasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($d->id); ?>"><?php echo e($d->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <div style="position: relative;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" x-model="search" placeholder="Cari kegiatan, data, atau OPD..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; width: 280px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm); transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='var(--orange)'; this.style.boxShadow='0 0 0 3px rgba(235, 137, 27, 0.1)';" onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='var(--shadow-sm)';">
            </div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive desktop-only">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                    <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 35%;">Kegiatan / OPD</th>
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 30%;">Nama Data</th>
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 15%;">Frekuensi</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 10%;">Status Tayang</th>
                        <th style="padding: 16px; text-align: right; font-weight: 700; color: var(--navy); width: 10%;">Tgl Tayang</th>
                    </tr>
                </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $aliranData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid var(--line);" x-show="(dinasFilter === '' || '<?php echo e($item->kegiatanStatistik->dinas_id); ?>' === dinasFilter) && (search === '' || $el.dataset.search.toLowerCase().includes(search.toLowerCase()))" data-search="<?php echo e(addslashes(strtolower($item->kegiatanStatistik->dinas->singkatan ?? ''))); ?> <?php echo e(addslashes(strtolower($item->kegiatanStatistik->nama))); ?> <?php echo e(addslashes(strtolower($item->nama_data))); ?>">
                    <td style="padding: 16px;">
                        <div style="font-weight: 600; color: var(--navy); margin-bottom: 4px;"><?php echo e($item->kegiatanStatistik->nama); ?></div>
                        <div style="font-size: 12px; color: var(--muted);"><?php echo e($item->kegiatanStatistik->dinas->singkatan ?? '-'); ?></div>
                    </td>
                    <td style="padding: 16px; color: var(--ink);"><?php echo e($item->nama_data); ?></td>
                    <td style="padding: 16px; color: var(--muted);"><?php echo e(ucfirst($item->frekuensi)); ?></td>
                    <td style="padding: 16px; text-align: center;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->sudah_tayang): ?>
                            <span style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; width: 100px; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: var(--green); background: #e6f4ea;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Sudah
                            </span>
                        <?php else: ?>
                            <span style="display: inline-block; width: 100px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: var(--red); background: rgba(220,53,69,.1);">
                                Belum
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td style="padding: 16px; text-align: right; color: var(--muted); font-size: 13px;">
                        <?php echo e($item->tanggal_tayang ? \Carbon\Carbon::parse($item->tanggal_tayang)->format('d M Y') : '-'); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada catatan aliran data untuk tahun ini.</td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
        </div>

        
        <div class="mobile-only">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $aliranData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="border-bottom: 1px solid var(--line); padding: 16px 20px; display: flex; flex-direction: column; gap: 12px;" x-show="(dinasFilter === '' || '<?php echo e($item->kegiatanStatistik->dinas_id); ?>' === dinasFilter) && (search === '' || $el.dataset.search.toLowerCase().includes(search.toLowerCase()))" data-search="<?php echo e(addslashes(strtolower($item->kegiatanStatistik->dinas->singkatan ?? ''))); ?> <?php echo e(addslashes(strtolower($item->kegiatanStatistik->nama))); ?> <?php echo e(addslashes(strtolower($item->nama_data))); ?>">
                    <div>
                        <div style="font-size: 11px; color: var(--muted); font-weight: 700; margin-bottom: 4px; text-transform: uppercase;"><?php echo e($item->kegiatanStatistik->dinas->singkatan ?? '-'); ?></div>
                        <div style="font-size: 14.5px; font-weight: 700; color: var(--navy); line-height: 1.35;"><?php echo e($item->kegiatanStatistik->nama); ?></div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 4px; background: var(--navy-50); padding: 12px; border-radius: 8px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Nama Data</span>
                            <span style="font-size: 12px; color: var(--ink); text-align: right; font-weight: 500;"><?php echo e($item->nama_data); ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Frekuensi</span>
                            <span style="font-size: 12px; color: var(--muted); font-weight: 500;"><?php echo e(ucfirst($item->frekuensi)); ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Status Tayang</span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->sudah_tayang): ?>
                                <span style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: var(--green); background: #e6f4ea;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Sudah
                                </span>
                            <?php else: ?>
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: var(--red); background: rgba(220,53,69,.1);">
                                    Belum
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->sudah_tayang): ?>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Tgl Tayang</span>
                            <span style="font-size: 11px; color: var(--muted); font-weight: 600;"><?php echo e($item->tanggal_tayang ? \Carbon\Carbon::parse($item->tanggal_tayang)->format('d M Y') : '-'); ?></span>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding: 32px; text-align: center; color: var(--muted);">Belum ada catatan aliran data untuk tahun ini.</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/aliran_data.blade.php ENDPATH**/ ?>