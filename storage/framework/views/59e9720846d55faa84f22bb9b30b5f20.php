<header style="position: sticky; top: 0; z-index: 50; background: #fff; border-bottom: 1px solid var(--line);">
    <div class="container" style="height: 74px; display: flex; align-items: center; gap: 32px;" x-data="{ mobileOpen: false }">
        <a href="<?php echo e(url('/')); ?>" style="font-size: 20px; font-weight: 800; color: var(--navy); letter-spacing: -0.5px; text-decoration: none;">PASEBAN</a>

        
        <button class="mobile-menu-btn" @click="mobileOpen = !mobileOpen" style="padding: 8px; color: var(--muted); margin-left: auto;" aria-label="Toggle menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <g x-show="!mobileOpen"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></g>
                <g x-show="mobileOpen" style="display: none;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></g>
            </svg>
        </button>

        <nav class="nav-links" :class="{ 'open': mobileOpen }" style="justify-content: flex-end; margin-left: auto;">
            <a href="<?php echo e(route('home')); ?>" class="navbar-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Home</a>
            <div class="dropdown" x-data="{ dropOpen: false }">
                <a href="#" class="navbar-link <?php echo e(request()->routeIs(['public.kegiatan', 'public.romantik', 'public.metadata', 'public.aliran_data']) ? 'active' : ''); ?>" @click.prevent="dropOpen = !dropOpen">Pemantauan <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;"><path d="m6 9 6 6 6-6"/></svg></a>
                <div class="dropdown-menu" :class="{ 'open': dropOpen }" x-show="dropOpen || $el.closest('.dropdown').matches(':hover')" x-cloak>
                    <a href="<?php echo e(route('public.kegiatan')); ?>" class="dropdown-item <?php echo e(request()->routeIs('public.kegiatan') ? 'active' : ''); ?>">Identifikasi Kegiatan</a>
                    <a href="<?php echo e(route('public.romantik')); ?>" class="dropdown-item <?php echo e(request()->routeIs('public.romantik') ? 'active' : ''); ?>">Romantik</a>
                    <a href="<?php echo e(route('public.metadata')); ?>" class="dropdown-item <?php echo e(request()->routeIs('public.metadata') ? 'active' : ''); ?>">Metadata</a>
                    <a href="<?php echo e(route('public.aliran_data')); ?>" class="dropdown-item <?php echo e(request()->routeIs('public.aliran_data') ? 'active' : ''); ?>">Aliran Data</a>
                </div>
            </div>
            <a href="<?php echo e(route('public.monev')); ?>" class="navbar-link <?php echo e(request()->routeIs('public.monev') ? 'active' : ''); ?>">Monitoring Evaluasi</a>
            <a href="<?php echo e(route('berita-acara.index')); ?>" class="navbar-link <?php echo e(request()->routeIs('berita-acara.*') ? 'active' : ''); ?>">Berita Acara</a>
        </nav>
    </div>
</header>
<?php /**PATH D:\PASEBAN APP\resources\views/partials/navbar.blade.php ENDPATH**/ ?>