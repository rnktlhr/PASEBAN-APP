<?php $__env->startSection('title', $kegiatanPendampingan->judul . ' — Kegiatan Pendampingan Paseban'); ?>

<?php $__env->startSection('content'); ?>
<section style="background: var(--bg); padding: 40px 0; min-height: 80vh;">
    <div class="container" style="max-width: 800px;">
        <a href="<?php echo e(route('kegiatan-pendampingan.index')); ?>" style="display: inline-flex; align-items: center; gap: 6px; color: var(--navy); text-decoration: none; font-size: 14px; margin-bottom: 24px; font-weight: 600; transition: .2s;" onmouseover="this.style.color='var(--orange)'" onmouseout="this.style.color='var(--navy)'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Daftar Kegiatan Pendampingan
        </a>

        <div style="background: #fff; border: 1px solid var(--line); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-sm);">
            
            
            <div style="padding: 40px 40px 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="padding: 5px 12px; border-radius: 4px; background: var(--teal); color: #fff; font-size: 12px; font-weight: 700; letter-spacing: .5px;"><?php echo e(ucfirst($kegiatanPendampingan->kategori)); ?></div>
                    <div class="mono" style="font-size: 13px; color: var(--muted); letter-spacing: .5px;"><?php echo e($kegiatanPendampingan->tanggal->format('d F Y')); ?></div>
                </div>
                <h1 style="margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -.5px; line-height: 1.3; color: var(--navy);"><?php echo e($kegiatanPendampingan->judul); ?></h1>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatanPendampingan->gambar): ?>
                <div style="width: 100%; max-height: 400px; overflow: hidden;">
                    <img src="<?php echo e(asset('storage/' . $kegiatanPendampingan->gambar)); ?>" alt="<?php echo e($kegiatanPendampingan->judul); ?>" style="width: 100%; height: auto; object-fit: cover;">
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div style="padding: 32px 40px 40px;">
                <style>
                    .prose figcaption.attachment__caption { display: none !important; }
                    .prose figure.attachment { margin: 24px 0; text-align: center; }
                    .prose figure.attachment img { max-width: 100%; height: auto; border-radius: 8px; }
                </style>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatanPendampingan->ringkasan): ?>
                <div style="font-size: 17px; line-height: 1.8; color: var(--ink); font-weight: 500; margin-bottom: 24px;">
                    <?php echo nl2br(e($kegiatanPendampingan->ringkasan)); ?>

                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatanPendampingan->narasi): ?>
                <div class="prose" style="font-size: 16px; line-height: 1.8; color: var(--ink); border-top: 1px solid var(--line); padding-top: 24px;">
                    <?php echo \App\Helpers\HtmlSanitizer::clean($kegiatanPendampingan->narasi); ?>

                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views\kegiatan-pendampingan\show.blade.php ENDPATH**/ ?>