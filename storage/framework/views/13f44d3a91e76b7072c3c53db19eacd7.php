<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Jenis Metadata</th>
            <th>Status Dinas</th>
            <th>Status Kominfo</th>
            <th>Status BPS</th>
            <th>Catatan</th>
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
            <td><?php echo e($metadata->status_kominfo instanceof \App\Enums\StatusKominfo ? $metadata->status_kominfo->label() : ucwords(str_replace('_', ' ', $metadata->status_kominfo))); ?></td>
            <td><?php echo e($metadata->status_bps instanceof \App\Enums\StatusBps ? $metadata->status_bps->label() : ucwords(str_replace('_', ' ', $metadata->status_bps))); ?></td>
            <td><?php echo e($metadata->catatan ?? '-'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>
<?php /**PATH D:\PASEBAN APP\resources\views\exports\metadata_excel.blade.php ENDPATH**/ ?>