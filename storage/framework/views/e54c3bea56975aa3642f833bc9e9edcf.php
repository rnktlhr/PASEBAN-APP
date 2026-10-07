<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Format Data</th>
            <th>Frekuensi</th>
            <th>Status Tayang</th>
            <th>Link Dataset</th>
        </tr>
    </thead>
    <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $aliranDataItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $aliran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e($aliran->kegiatanStatistik->nama ?? '-'); ?></td>
            <td><?php echo e($aliran->kegiatanStatistik->dinas->nama ?? '-'); ?></td>
            <td><?php echo e($aliran->format_data ?? '-'); ?></td>
            <td><?php echo e($aliran->frekuensi instanceof \App\Enums\FrekuensiData ? $aliran->frekuensi->label() : ucfirst($aliran->frekuensi)); ?></td>
            <td><?php echo e($aliran->sudah_tayang ? 'Sudah Tayang' : 'Belum Tayang'); ?></td>
            <td><?php echo e($aliran->link_dataset ?? '-'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>
<?php /**PATH D:\PASEBAN APP\resources\views\exports\aliran_data_excel.blade.php ENDPATH**/ ?>