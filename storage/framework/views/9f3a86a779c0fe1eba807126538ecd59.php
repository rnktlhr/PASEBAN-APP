<?php $__env->startSection('content'); ?>
<section style="background: linear-gradient(135deg, var(--navy) 0%, var(--navy-900) 60%, #021a3d 100%); color: #fff; padding: 60px 0 40px; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 10;">
        <a href="<?php echo e(route('home')); ?>" style="display: inline-flex; align-items: center; gap: 6px; color: rgba(255,255,255,.7); text-decoration: none; font-size: 14px; margin-bottom: 20px; transition: .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.7)'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Beranda
        </a>
        <h1 style="margin: 0 0 10px; font-size: 32px; font-weight: 800; letter-spacing: -.5px;">Semua Berita Acara</h1>
        <p style="margin: 0; color: rgba(255,255,255,.7); font-size: 15px; max-width: 600px;">Arsip seluruh berita acara, pendampingan, dan sesi pembinaan statistik sektoral.</p>
    </div>
</section>

<section style="padding: 60px 0; background: #f8fafc; min-height: 50vh;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $beritaAcara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('berita-acara.show', $berita)); ?>" style="text-decoration: none; color: inherit; border-radius: var(--radius); overflow: hidden; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-sm); cursor: pointer; display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--shadow-sm)';">
                <div style="height: 180px; background: linear-gradient(135deg, var(--navy), var(--teal)); position: relative;">
                    <?php
                        $coverImage = $berita->gambar ? asset('storage/' . $berita->gambar) : null;
                        if (!$coverImage && $berita->narasi) {
                            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $berita->narasi, $image);
                            $coverImage = $image['src'] ?? null;
                        }
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($coverImage): ?>
                        <img src="<?php echo e($coverImage); ?>" alt="<?php echo e($berita->judul); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div style="position: absolute; top: 14px; left: 14px; padding: 5px 10px; border-radius: 4px; background: var(--teal); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: .3px; z-index: 10;"><?php echo e(ucfirst($berita->kategori)); ?></div>
                </div>
                <div style="padding: 22px; flex: 1; display: flex; flex-direction: column;">
                    <div class="mono" style="font-size: 11px; color: var(--muted); letter-spacing: .8px; margin-bottom: 10px;"><?php echo e($berita->tanggal->format('d M Y')); ?></div>
                    <h3 style="margin: 0; font-size: 16.5px; line-height: 1.35; font-weight: 700; color: var(--navy); letter-spacing: -.2px;"><?php echo e($berita->judul); ?></h3>
                    <p style="margin: 10px 0 16px; font-size: 13.5px; color: var(--muted); line-height: 1.55; flex: 1;"><?php echo e(Str::limit($berita->ringkasan, 150)); ?></p>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: var(--orange-600); margin-top: auto;">
                        Lihat Detail
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div style="margin-top: 40px; display: flex; justify-content: center;">
            <?php echo e($beritaAcara->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/berita-acara.blade.php ENDPATH**/ ?>