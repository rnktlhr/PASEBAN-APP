<?php
    // Capaian keseluruhan = rata-rata tahapan yang punya target
    $tahapan = [
        ['label' => 'Romantik diajukan', 'done' => $romantikDiajukan, 'total' => $totalKegiatan, 'pct' => $pctRomantik, 'url' => route('public.romantik')],
        ['label' => 'Metadata tersusun', 'done' => $metaKegiatanDone, 'total' => $metaKegiatanTotal, 'pct' => $pctMetadata, 'url' => route('public.metadata')],
        ['label' => 'Aliran data tayang', 'done' => $aliranTayang, 'total' => $aliranTotal, 'pct' => $pctAliran, 'url' => route('public.aliran_data')],
    ];
    $tahapanAktif = array_filter($tahapan, fn ($t) => $t['total'] > 0);
    $capaian = count($tahapanAktif) ? (int) round(array_sum(array_column($tahapanAktif, 'pct')) / count($tahapanAktif)) : 0;
?>

<section class="hero">
    <div class="container hero-grid">
        
        <div style="min-width: 0;">
            <p class="hero-eyebrow">BPS Kabupaten Bantul &middot; Tahun <?php echo e($tahun); ?></p>
            <h1 class="hero-title">Pemantauan Statistik Sektoral Kabupaten Bantul</h1>
            <p class="hero-lead">
                Pantau capaian Romantik, metadata, dan aliran data setiap OPD di lingkungan Pemerintah Kabupaten
                Bantul, di satu tempat.
            </p>

            <div class="opd-lookup" x-data="opdLookup(<?php echo \Illuminate\Support\Js::from($opdProgress)->toHtml() ?>)" @click.outside="open = false"
                @keydown.escape="open = false">
                <label for="opd-search" class="opd-lookup__label">Cek status OPD Anda</label>
                <div class="opd-lookup__field">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input id="opd-search" type="text" autocomplete="off" placeholder="Ketik nama dinas, mis. Dinas Kesehatan"
                        x-model="q" @focus="open = true" @input="open = true; cursor = 0"
                        @keydown.arrow-down.prevent="move(1)" @keydown.arrow-up.prevent="move(-1)"
                        @keydown.enter.prevent="pick(results[cursor])" role="combobox" aria-controls="opd-results"
                        :aria-expanded="open && results.length > 0">
                    <button type="button" x-show="selected" x-cloak @click="clear()" class="opd-lookup__clear"
                        aria-label="Hapus pilihan">&times;</button>
                </div>

                <ul id="opd-results" class="opd-lookup__list" role="listbox" x-show="open && results.length" x-cloak>
                    <template x-for="(o, i) in results" :key="o.id">
                        <li role="option" :aria-selected="i === cursor" :class="{ 'is-active': i === cursor }"
                            @mouseenter="cursor = i" @click="pick(o)">
                            <span x-text="o.nama"></span>
                            <span class="mono" x-text="o.kegiatan ? o.pct + '%' : '—'"></span>
                        </li>
                    </template>
                </ul>

                <div class="opd-result" x-show="selected" x-cloak>
                    <template x-if="selected">
                        <div>
                            <div class="opd-result__head">
                                <strong x-text="selected.nama"></strong>
                                <span class="opd-badge" :class="badge(selected).cls" x-text="badge(selected).text"></span>
                            </div>
                            <p class="opd-result__meta" x-show="!selected.kegiatan">Belum ada kegiatan statistik
                                terdaftar untuk tahun <?php echo e($tahun); ?>.</p>
                            <div x-show="selected.kegiatan" class="opd-result__rows">
                                <div>
                                    <span>Romantik</span>
                                    <span class="mono" x-text="selected.romantik + ' / ' + selected.kegiatan"></span>
                                </div>
                                <div class="bar"><i :style="`width:${selected.pctRomantik}%`"></i></div>
                                <div>
                                    <span>Metadata</span>
                                    <span class="mono" x-text="selected.metadata + ' / ' + selected.metadataTarget"></span>
                                </div>
                                <div class="bar"><i :style="`width:${selected.pctMetadata}%`"></i></div>
                            </div>
                            <a :href="`<?php echo e(route('public.kegiatan')); ?>?dinasFilter=${selected.id}`" class="opd-result__link">
                                Lihat rincian kegiatan &rarr;
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        
        <aside class="hero-score" aria-label="Capaian keseluruhan">
            <div class="hero-score__top">
                <span>Capaian keseluruhan <?php echo e($tahun); ?></span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lastUpdated): ?>
                    <time datetime="<?php echo e($lastUpdated->toIso8601String()); ?>">
                        Diperbarui <?php echo e($lastUpdated->locale('id')->translatedFormat('j M Y, H:i')); ?> WIB
                    </time>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="hero-score__value mono"><?php echo e($capaian); ?><small>%</small></div>

            <ul class="hero-score__list">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tahapan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($t['url']); ?>">
                            <span class="hero-score__label"><?php echo e($t['label']); ?></span>
                            <span class="mono">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($t['total'] > 0): ?>
                                    <?php echo e(number_format($t['done'], 0, ',', '.')); ?> / <?php echo e(number_format($t['total'], 0, ',', '.')); ?>

                                <?php else: ?>
                                    belum ada data
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                        </a>
                        <div class="bar"><i style="width: <?php echo e($t['pct']); ?>%"></i></div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>

            <dl class="hero-score__stats">
                <div><dt>OPD terdaftar</dt><dd class="mono"><?php echo e($totalDinas); ?></dd></div>
                <div><dt>Kegiatan</dt><dd class="mono"><?php echo e($totalKegiatan); ?></dd></div>
                <div><dt>Tingkat respon</dt><dd class="mono"><?php echo e($tingkatRespon); ?>%</dd></div>
            </dl>
        </aside>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('opdLookup', (items) => ({
                items,
                q: '',
                open: false,
                cursor: 0,
                selected: null,
                get results() {
                    const q = this.q.trim().toLowerCase();
                    if (!q) return this.items.slice(0, 8);
                    return this.items
                        .filter(o => o.nama.toLowerCase().includes(q) || (o.singkatan || '').toLowerCase().includes(q))
                        .slice(0, 8);
                },
                move(d) {
                    if (!this.results.length) return;
                    this.open = true;
                    this.cursor = (this.cursor + d + this.results.length) % this.results.length;
                },
                pick(o) {
                    if (!o) return;
                    this.selected = o;
                    this.q = o.nama;
                    this.open = false;
                },
                clear() {
                    this.selected = null;
                    this.q = '';
                    this.$nextTick(() => document.getElementById('opd-search').focus());
                },
                badge(o) {
                    if (!o.kegiatan) return { text: 'Belum ada kegiatan', cls: 'is-muted' };
                    if (o.pct >= 80) return { text: 'Baik', cls: 'is-good' };
                    if (o.pct >= 40) return { text: 'Berjalan', cls: 'is-mid' };
                    return { text: 'Perlu perhatian', cls: 'is-low' };
                },
            }));
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\PASEBAN APP\resources\views\partials\home-hero.blade.php ENDPATH**/ ?>