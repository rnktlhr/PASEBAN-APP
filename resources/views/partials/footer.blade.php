<footer style="background: var(--navy); color: rgba(255,255,255,.78); padding-top: 56px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 40px; padding-bottom: 40px;">
            <div>
                <div style="font-size: 20px; font-weight: 800; color: #fff; letter-spacing: -0.5px;">PASEBAN</div>
                <div style="margin-top: 20px; font-size: 13.5px; line-height: 1.65; max-width: 320px;">
                    <div style="font-weight: 700; color: #fff; margin-bottom: 6px;">{{ config('paseban.organisasi.nama') }}</div>
                    <div style="display: flex; gap: 10px;">
                        <span style="opacity: .78;">{{ config('paseban.organisasi.alamat') }}<br/>{{ config('paseban.organisasi.kota') }}</span>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <span class="mono" style="opacity: .78;">{{ config('paseban.organisasi.telepon') }}</span>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <span class="mono" style="opacity: .78;">{{ config('paseban.organisasi.email') }}</span>
                    </div>
                </div>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 18px;">Tautan Cepat</div>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 13.5px;">
                    <li><a href="{{ route('home') }}" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Home</a></li>
                    <li><a href="{{ route('public.kegiatan') }}" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Identifikasi Kegiatan</a></li>
                    <li><a href="{{ route('public.romantik') }}" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Romantik</a></li>
                    <li><a href="{{ route('public.monev') }}" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Monitoring Evaluasi</a></li>
                    <li><a href="{{ route('berita-acara.index') }}" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Berita Acara</a></li>
                </ul>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 18px;">Platform</div>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 13.5px;">
                    <li><a href="{{ url('/dinas/login') }}" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Login Panel Dinas</a></li>
                    <li><a href="{{ url('/admin/login') }}" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Login Admin BPS</a></li>
                </ul>
                <div style="margin-top: 28px; font-size: 13.5px; opacity: .78; line-height: 1.65; max-width: 280px;">
                    Pemantauan Statistik Sektoral Bantul — mendukung Satu Data Indonesia.
                </div>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,.1); padding: 22px 0; display: flex; justify-content: space-between; align-items: center; font-size: 12.5px; flex-wrap: wrap; gap: 12px;">
            <div style="opacity: .65; letter-spacing: .3px;">
                Copyright &copy; {{ date('Y') }} {{ config('paseban.organisasi.nama') }} &middot; PASEBAN
            </div>
            <div style="display: flex; gap: 20px; opacity: .78;">
                <a href="{{ route('home') }}">Peta Situs</a>
            </div>
        </div>
    </div>
</footer>
