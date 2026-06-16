<!DOCTYPE html>
<html>
<head>
    <title>Export Identifikasi Kegiatan Statistik</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Identifikasi Kegiatan Statistik Sektoral - <?php echo e($tahun); ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Jenis Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kegiatanItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($kegiatan->nama); ?></td>
                <td><?php echo e($kegiatan->dinas->nama ?? '-'); ?></td>
                <td><?php echo e($kegiatan->jenis instanceof \App\Enums\JenisKegiatan ? $kegiatan->jenis->label() : ucfirst($kegiatan->jenis)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\PASEBAN APP\resources\views/exports/kegiatan_statistik_pdf.blade.php ENDPATH**/ ?>