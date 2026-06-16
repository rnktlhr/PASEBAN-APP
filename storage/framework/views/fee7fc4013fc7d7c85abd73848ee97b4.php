<!DOCTYPE html>
<html>
<head>
    <title>Export Rekomendasi Statistik (Romantik)</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Rekomendasi Statistik Sektoral (Romantik) - <?php echo e($tahun); ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Status Dinas</th>
                <th>Status BPS</th>
                <th>Tgl Disetujui</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $romantikItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $romantik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($romantik->kegiatanStatistik->nama ?? '-'); ?></td>
                <td><?php echo e($romantik->kegiatanStatistik->dinas->nama ?? '-'); ?></td>
                <td><?php echo e($romantik->status_dinas instanceof \App\Enums\StatusDinas ? $romantik->status_dinas->label() : ucwords(str_replace('_', ' ', $romantik->status_dinas))); ?></td>
                <td><?php echo e($romantik->status_bps instanceof \App\Enums\StatusBps ? $romantik->status_bps->label() : ucwords(str_replace('_', ' ', $romantik->status_bps))); ?></td>
                <td><?php echo e($romantik->tanggal_persetujuan ? $romantik->tanggal_persetujuan->format('d/m/Y') : '-'); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\PASEBAN APP\resources\views/exports/romantik_pdf.blade.php ENDPATH**/ ?>