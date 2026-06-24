<footer style="background: var(--navy); color: rgba(255,255,255,.78); padding-top: 56px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 40px; padding-bottom: 40px;">
            <div>
                <div style="font-size: 20px; font-weight: 800; color: #fff; letter-spacing: -0.5px;">PASEBAN</div>
                <div style="margin-top: 20px; font-size: 13.5px; line-height: 1.65; max-width: 320px;">
                    <div style="font-weight: 700; color: #fff; margin-bottom: 6px;"><?php echo e(config('paseban.organisasi.nama')); ?></div>
                    <div style="display: flex; gap: 10px;">
                        <span style="opacity: .78;"><?php echo e(config('paseban.organisasi.alamat')); ?><br/><?php echo e(config('paseban.organisasi.kota')); ?></span>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <span class="mono" style="opacity: .78;"><?php echo e(config('paseban.organisasi.telepon')); ?></span>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <span class="mono" style="opacity: .78;"><?php echo e(config('paseban.organisasi.email')); ?></span>
                    </div>
                </div>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 18px;">Tautan Cepat</div>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 13.5px;">
                    <li><a href="<?php echo e(route('home')); ?>" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Home</a></li>
                    <li><a href="<?php echo e(route('public.kegiatan')); ?>" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Identifikasi Kegiatan</a></li>
                    <li><a href="<?php echo e(route('public.romantik')); ?>" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Romantik</a></li>
                    <li><a href="<?php echo e(route('public.monev')); ?>" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Monitoring Evaluasi</a></li>
                    <li><a href="<?php echo e(route('kegiatan-pendampingan.index')); ?>" style="opacity: .78; transition: opacity .15s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">Kegiatan Pendampingan</a></li>
                </ul>
            </div>
            <div>
                <div style="font-size: 12px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 18px;">Platform</div>
                <div style="font-size: 13.5px; opacity: .78; line-height: 1.65; max-width: 280px;">
                    Pemantauan Statistik Sektoral Bantul — mendukung Satu Data Indonesia.
                </div>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,.1); padding: 22px 0; display: flex; justify-content: space-between; align-items: center; font-size: 12.5px; flex-wrap: wrap; gap: 12px;">
            <div style="opacity: .65; letter-spacing: .3px;">
                Copyright &copy; <?php echo e(date('Y')); ?> <?php echo e(config('paseban.organisasi.nama')); ?> &middot; PASEBAN
            </div>
            <div style="display: flex; gap: 20px; opacity: .78;">
                <a href="https://www.instagram.com/bpsbantul?igsh=dDF2Y2x2ZDVpNjdn" target="_blank" rel="noopener noreferrer" style="transition: opacity .15s; color: inherit; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    <span style="font-size: 13.5px;">Instagram</span>
                </a>
                <a href="#" style="transition: opacity .15s; color: inherit; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.78'">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                    <span style="font-size: 13.5px;">Twitter</span>
                </a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH D:\PASEBAN APP\resources\views/partials/footer.blade.php ENDPATH**/ ?>