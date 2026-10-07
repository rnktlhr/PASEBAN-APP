<!DOCTYPE html>
<html>
<head>
    <title>Export Metadata Statistik</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Metadata Statistik Sektoral - <?php echo e($tahun); ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Jenis Metadata</th>
                <th>Status Dinas</th>
                <th>Status BPS</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $metadataItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $metadata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($metadata->kegiatanStatistik->nama ?? '-'); ?></td>
                <td><?php echo e($metadata->kegiatanStatistik->dinas->nama ?? '-'); ?></td>
                <td><?php echo e($metadata->jenis instanceof \App\Enums\JenisMetadata ? $metadata->jenis->label() : ucfirst($metadata->jenis)); ?></td>
                <td><?php echo e($metadata->status_dinas instanceof \App\Enums\StatusDinas ? $metadata->status_dinas->label() : ucwords(str_replace('_', ' ', $metadata->status_dinas))); ?></td>
                <td><?php echo e($metadata->status_bps instanceof \App\Enums\StatusBps ? $metadata->status_bps->label() : ucwords(str_replace('_', ' ', $metadata->status_bps))); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\PASEBAN APP\resources\views\exports\metadata_pdf.blade.php ENDPATH**/ ?>