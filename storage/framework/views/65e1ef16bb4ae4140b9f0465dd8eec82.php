<!DOCTYPE html>
<html>
<head>
    <title>Pengingat Keterlambatan Kegiatan Statistik</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.6;">
    <p>Yth. Bapak/Ibu dari <strong><?php echo e($dinas->nama); ?></strong>,</p>
    
    <p>Sistem Pemantauan Statistik Sektoral Bantul (Paseban) mendeteksi bahwa ada beberapa Kegiatan Statistik dari instansi Anda yang mengalami keterlambatan dalam jadwal Monitoring & Evaluasi:</p>
    
    <ul>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kegiatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><strong><?php echo e($kegiatan->nama); ?></strong> (Jenis: <?php echo e($kegiatan->jenis instanceof \App\Enums\JenisKegiatan ? $kegiatan->jenis->label() : ucfirst(str_replace('_', ' ', $kegiatan->jenis))); ?>)</li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </ul>
    
    <p>Mohon agar segera melengkapi dokumen ROMANTIK atau Metadata terkait melalui aplikasi Paseban.</p>
    
    <p>Terima kasih atas kerja samanya dalam mewujudkan Satu Data Indonesia.</p>
    
    <p>Salam,<br>Admin Paseban - BPS Kabupaten Bantul</p>
</body>
</html>
<?php /**PATH D:\PASEBAN APP\resources\views\emails\monev_reminder.blade.php ENDPATH**/ ?>