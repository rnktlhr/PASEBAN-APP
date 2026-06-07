<header
    x-data="{ scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :style="`position: sticky; top: 0; z-index: 50; transition: box-shadow .3s ease; ${scrolled ? 'box-shadow: 0 4px 24px rgba(0,0,0,.3);' : 'box-shadow: none;'}`"
>
    {{-- Background with Gradient --}}
    <div :style="`position: absolute; inset: 0; z-index: -2; background: linear-gradient(135deg, var(--navy) 0%, var(--navy-900) 100%); transition: opacity .3s ease; opacity: ${scrolled ? '0.95' : '{{ request()->routeIs('home') ? '0' : '1' }}'};`"></div>
    
    {{-- Backdrop Blur --}}
    <div :style="`position: absolute; inset: 0; z-index: -3; ${scrolled ? 'backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);' : ''}`"></div>



    <div class="container" style="height: 74px; display: flex; align-items: center; gap: 32px;" x-data="{ mobileOpen: false }">
        <a href="{{ url('/') }}" style="font-size: 20px; font-weight: 800; color: #fff; letter-spacing: -0.5px; text-decoration: none;">PASEBAN</a>

        {{-- Mobile hamburger button --}}
        <button class="mobile-menu-btn" @click="mobileOpen = !mobileOpen" style="padding: 8px; color: rgba(255,255,255,.8); margin-left: auto;" aria-label="Toggle menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <g x-show="!mobileOpen"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></g>
                <g x-show="mobileOpen" style="display: none;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></g>
            </svg>
        </button>

        <nav class="nav-links" :class="{ 'open': mobileOpen }" style="justify-content: flex-end; margin-left: auto;">
            <a href="{{ route('home') }}" class="navbar-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('public.pembinaan') }}" class="navbar-link {{ request()->routeIs('public.pembinaan') ? 'active' : '' }}">Pembinaan</a>
            <div class="dropdown" x-data="{ dropOpen: false }">
                <a href="#" class="navbar-link {{ request()->routeIs(['public.kegiatan', 'public.romantik', 'public.metadata', 'public.aliran_data']) ? 'active' : '' }}" @click.prevent="dropOpen = !dropOpen">Pemantauan <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;"><path d="m6 9 6 6 6-6"/></svg></a>
                <div class="dropdown-menu" :class="{ 'open': dropOpen }" x-show="dropOpen || $el.closest('.dropdown').matches(':hover')" x-cloak>
                    <a href="{{ route('public.kegiatan') }}" class="dropdown-item {{ request()->routeIs('public.kegiatan') ? 'active' : '' }}">Identifikasi Kegiatan</a>
                    <a href="{{ route('public.romantik') }}" class="dropdown-item {{ request()->routeIs('public.romantik') ? 'active' : '' }}">Romantik</a>
                    <a href="{{ route('public.metadata') }}" class="dropdown-item {{ request()->routeIs('public.metadata') ? 'active' : '' }}">Metadata</a>
                    <a href="{{ route('public.aliran_data') }}" class="dropdown-item {{ request()->routeIs('public.aliran_data') ? 'active' : '' }}">Aliran Data</a>
                </div>
            </div>
            <a href="{{ route('public.monev') }}" class="navbar-link {{ request()->routeIs('public.monev') ? 'active' : '' }}">Monitoring Evaluasi</a>
        </nav>
    </div>
</header>
