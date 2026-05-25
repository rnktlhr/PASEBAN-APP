<header style="position: sticky; top: 0; z-index: 50; background: #fff; border-bottom: 1px solid var(--line);">
    <div class="container" style="height: 74px; display: flex; align-items: center; gap: 32px;">
        <a href="{{ url('/') }}" style="font-size: 20px; font-weight: 800; color: var(--navy); letter-spacing: -0.5px; text-decoration: none;">PASEBAN</a>
        <nav style="display: flex; gap: 4px; flex: 1; margin-left: 32px;">
            <a href="{{ route('home') }}" class="navbar-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <div class="dropdown">
                <a href="#" class="navbar-link {{ request()->routeIs(['public.kegiatan', 'public.romantik', 'public.metadata', 'public.aliran_data']) ? 'active' : '' }}">Pemantauan <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;"><path d="m6 9 6 6 6-6"/></svg></a>
                <div class="dropdown-menu">
                    <a href="{{ route('public.kegiatan') }}" class="dropdown-item {{ request()->routeIs('public.kegiatan') ? 'active' : '' }}">Identifikasi Kegiatan</a>
                    <a href="{{ route('public.romantik') }}" class="dropdown-item {{ request()->routeIs('public.romantik') ? 'active' : '' }}">Romantik</a>
                    <a href="{{ route('public.metadata') }}" class="dropdown-item {{ request()->routeIs('public.metadata') ? 'active' : '' }}">Metadata</a>
                    <a href="{{ route('public.aliran_data') }}" class="dropdown-item {{ request()->routeIs('public.aliran_data') ? 'active' : '' }}">Aliran Data</a>
                </div>
            </div>
            <a href="{{ route('public.monev') }}" class="navbar-link {{ request()->routeIs('public.monev') ? 'active' : '' }}">Monitoring Evaluasi</a>
            <a href="{{ route('berita-acara.index') }}" class="navbar-link {{ request()->routeIs('berita-acara.*') ? 'active' : '' }}">Berita Acara</a>
        </nav>

        <!-- Aksesibilitas -->
        <div x-data="{ fontSize: 100 }" style="display: flex; align-items: center; gap: 6px; margin-right: 8px;">
            <button @click="fontSize = Math.max(80, fontSize - 10); document.documentElement.style.fontSize = fontSize + '%'" style="padding: 4px 8px; border: 1px solid var(--line); border-radius: 4px; font-size: 12px; font-weight: 700; color: var(--muted); background: #fff; cursor: pointer;" aria-label="Perkecil teks">A-</button>
            <button @click="fontSize = Math.min(130, fontSize + 10); document.documentElement.style.fontSize = fontSize + '%'" style="padding: 4px 8px; border: 1px solid var(--line); border-radius: 4px; font-size: 14px; font-weight: 700; color: var(--muted); background: #fff; cursor: pointer;" aria-label="Perbesar teks">A+</button>
        </div>
    </div>
</header>
