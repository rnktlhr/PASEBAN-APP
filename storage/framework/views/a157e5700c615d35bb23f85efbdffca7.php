<!DOCTYPE html>
<html>
<head>
    <title>Export Aliran Data (Sedata Sebantul)</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Aliran Data (Sedata Sebantul) - <?php echo e($tahun); ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Frekuensi</th>
                <th>Status Tayang</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $aliranDataItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $aliran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($aliran->kegiatanStatistik->nama ?? '-'); ?></td>
                <td><?php echo e($aliran->kegiatanStatistik->dinas->nama ?? '-'); ?></td>
                <td><?php echo e($aliran->frekuensi instanceof \App\Enums\FrekuensiData ? $aliran->frekuensi->label() : ucfirst($aliran->frekuensi)); ?></td>
                <td><?php echo e($aliran->sudah_tayang ? 'Sudah Tayang' : 'Belum Tayang'); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\PASEBAN APP\resources\views\exports\aliran_data_pdf.blade.php ENDPATH**/ ?>