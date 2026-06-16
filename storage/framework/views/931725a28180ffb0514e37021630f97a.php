<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Status Dinas</th>
            <th>Status Kominfo</th>
            <th>Status BPS</th>
            <th>Tanggal Pengajuan</th>
            <th>Tanggal Persetujuan</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $romantikItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $romantik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e($romantik->kegiatanStatistik->nama ?? '-'); ?></td>
            <td><?php echo e($romantik->kegiatanStatistik->dinas->nama ?? '-'); ?></td>
            <td><?php echo e($romantik->status_dinas instanceof \App\Enums\StatusDinas ? $romantik->status_dinas->label() : ucwords(str_replace('_', ' ', $romantik->status_dinas))); ?></td>
            <td><?php echo e($romantik->status_kominfo instanceof \App\Enums\StatusKominfo ? $romantik->status_kominfo->label() : ucwords(str_replace('_', ' ', $romantik->status_kominfo))); ?></td>
            <td><?php echo e($romantik->status_bps instanceof \App\Enums\StatusBps ? $romantik->status_bps->label() : ucwords(str_replace('_', ' ', $romantik->status_bps))); ?></td>
            <td><?php echo e($romantik->tanggal_pengajuan ? $romantik->tanggal_pengajuan->format('d/m/Y') : '-'); ?></td>
            <td><?php echo e($romantik->tanggal_persetujuan ? $romantik->tanggal_persetujuan->format('d/m/Y') : '-'); ?></td>
            <td><?php echo e($romantik->catatan ?? '-'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>
<?php /**PATH D:\PASEBAN APP\resources\views/exports/romantik_excel.blade.php ENDPATH**/ ?>