<?php $__env->startSection('title', $beritaAcara->judul . ' — Berita Acara Paseban'); ?>

<?php $__env->startSection('content'); ?>
<section style="background: linear-gradient(135deg, var(--navy) 0%, var(--navy-900) 60%, #021a3d 100%); color: #fff; padding: 60px 0 40px; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 10;">
        <a href="<?php echo e(route('berita-acara.index')); ?>" style="display: inline-flex; align-items: center; gap: 6px; color: rgba(255,255,255,.7); text-decoration: none; font-size: 14px; margin-bottom: 20px; transition: .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.7)'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Daftar Berita Acara
        </a>
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <div style="padding: 5px 12px; border-radius: 4px; background: var(--orange); color: #fff; font-size: 12px; font-weight: 700; letter-spacing: .5px;"><?php echo e(ucfirst($beritaAcara->kategori)); ?></div>
            <div class="mono" style="font-size: 13px; color: rgba(255,255,255,.8); letter-spacing: .5px;"><?php echo e($beritaAcara->tanggal->format('d F Y')); ?></div>
        </div>
        <h1 style="margin: 0; font-size: 36px; font-weight: 800; letter-spacing: -.5px; line-height: 1.3;"><?php echo e($beritaAcara->judul); ?></h1>
    </div>
</section>

<section style="padding: 60px 0; background: #f8fafc; min-height: 50vh;">
    <div class="container">
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 40px; box-shadow: var(--shadow-sm);">
            <style>
                .prose figcaption.attachment__caption { display: none !important; }
                .prose figure.attachment { margin: 24px 0; text-align: center; }
                .prose figure.attachment img { max-width: 100%; height: auto; border-radius: 8px; }
            </style>

            <div style="font-size: 16px; line-height: 1.8; color: var(--ink);">
                <?php echo nl2br(e($beritaAcara->ringkasan)); ?>

            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($beritaAcara->narasi): ?>
                <div class="prose" style="font-size: 16px; line-height: 1.8; color: var(--ink); margin-top: 32px; padding-top: 32px; border-top: 1px solid var(--line);">
                    <?php echo \App\Helpers\HtmlSanitizer::clean($beritaAcara->narasi); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/berita-acara/show.blade.php ENDPATH**/ ?>