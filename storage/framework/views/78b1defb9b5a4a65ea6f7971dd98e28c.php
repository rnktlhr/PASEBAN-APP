<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Status</th>
            <th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>Mei</th><th>Jun</th>
            <th>Jul</th><th>Agu</th><th>Sep</th><th>Okt</th><th>Nov</th><th>Des</th>
        </tr>
    </thead>
    <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $monevItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $monev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e($monev->kegiatanStatistik->nama ?? '-'); ?></td>
            <td><?php echo e($monev->kegiatanStatistik->dinas->nama ?? '-'); ?></td>
            <td><?php echo e($monev->status?->label() ?? '-'); ?></td>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($m = 1; $m <= 12; $m++): ?>
                <?php
                    $isRencana = $m >= $monev->bulan_rencana_mulai && $m <= $monev->bulan_rencana_selesai;
                    $isRealisasi = $monev->bulan_realisasi_mulai && $monev->bulan_realisasi_selesai && $m >= $monev->bulan_realisasi_mulai && $m <= $monev->bulan_realisasi_selesai;
                    
                    $symbol = '';
                    if ($isRealisasi) $symbol = 'V';
                    elseif ($isRencana) $symbol = 'O';
                ?>
                <td style="text-align: center; <?php echo e($isRealisasi ? 'color: green;' : ($isRencana ? 'color: blue;' : '')); ?>"><?php echo e($symbol); ?></td>
            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>
<?php /**PATH D:\PASEBAN APP\resources\views/exports/monev_excel.blade.php ENDPATH**/ ?>