<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Jenis Kegiatan</th>
            <th>Tahun</th>
        </tr>
    </thead>
    <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kegiatanItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e($kegiatan->nama); ?></td>
            <td><?php echo e($kegiatan->dinas->nama ?? '-'); ?></td>
            <td><?php echo e($kegiatan->jenis instanceof \App\Enums\JenisKegiatan ? $kegiatan->jenis->label() : ucfirst($kegiatan->jenis)); ?></td>
            <td><?php echo e($kegiatan->tahun); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>
<?php /**PATH D:\PASEBAN APP\resources\views/exports/kegiatan_statistik_excel.blade.php ENDPATH**/ ?>