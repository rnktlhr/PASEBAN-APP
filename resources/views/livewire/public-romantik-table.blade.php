<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">
    <div class="flex-col-mobile" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Rekomendasi Statistik (Romantik) {{ $tahun }}</h1>
            <p style="color: var(--muted); font-size: 15px; margin: 0;">Status pengajuan dan persetujuan Romantik (Rekomendasi Kegiatan Statistik).</p>
        </div>

        <div class="w-full-mobile" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <div style="position: relative;" x-data="{ open: false }">
                <button type="button" @click="open = !open" style="padding: 10px 16px; background: #fff; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; font-weight: 600; color: var(--navy); cursor: pointer; display: flex; align-items: center; gap: 8px; box-shadow: var(--shadow-sm);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Export
                </button>
                <div x-show="open" @click.away="open = false" style="position: absolute; top: 100%; right: 0; margin-top: 8px; background: #fff; border: 1px solid var(--line); border-radius: 8px; box-shadow: var(--shadow-md); z-index: 50; width: 140px; overflow: hidden; display: none;" :style="{ display: open ? 'block' : 'none' }">
                    <a href="{{ route('romantik.export', array_merge(request()->query(), ['format' => 'excel'])) }}" style="display: block; padding: 10px 16px; color: var(--navy); text-decoration: none; font-size: 13px; border-bottom: 1px solid var(--line); transition: background 0.2s;" onmouseover="this.style.background='var(--navy-50)'" onmouseout="this.style.background='transparent'">Excel (.xlsx)</a>
                    <a href="{{ route('romantik.export', array_merge(request()->query(), ['format' => 'pdf'])) }}" style="display: block; padding: 10px 16px; color: var(--navy); text-decoration: none; font-size: 13px; transition: background 0.2s;" onmouseover="this.style.background='var(--navy-50)'" onmouseout="this.style.background='transparent'">PDF (.pdf)</a>
                </div>
            </div>

            <select wire:model.live="status" class="w-full-mobile styled-select" style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; box-shadow: var(--shadow-sm); cursor: pointer;">
                <option value="">Semua Status</option>
                <option value="done">Sudah Diajukan</option>
                <option value="belum">Belum Diajukan</option>
            </select>

            <select wire:model.live="dinasFilter" class="w-full-mobile styled-select" style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; box-shadow: var(--shadow-sm); max-width: 200px; cursor: pointer;">
                <option value="">Semua OPD / Dinas</option>
                @foreach($dinasList as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
            <div class="w-full-mobile" style="position: relative; display: flex;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" wire:model.live.debounce.400ms="search" class="w-full-mobile" placeholder="Cari kegiatan atau OPD..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px 0 0 8px; font-size: 13.5px; width: 220px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm);">
            </div>
        </div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive desktop-only">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                    <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 40%;">OPD / Kegiatan</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status Dinas</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status Kominfo</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status BPS</th>
                    </tr>
                </thead>
            <tbody>
                @forelse($romantik as $item)
                <tr style="border-bottom: 1px solid var(--line);">
                    <td style="padding: 16px;">
                        <div style="font-size: 11.5px; font-weight: 700; color: var(--muted); text-transform: uppercase; margin-bottom: 4px;">{{ $item->kegiatanStatistik->dinas->singkatan ?? '-' }}</div>
                        <div style="font-weight: 600; color: var(--navy);">{{ $item->kegiatanStatistik->nama }}</div>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        @php
                            $stDinas = $item->status_dinas instanceof \App\Enums\StatusDinas ? $item->status_dinas : \App\Enums\StatusDinas::tryFrom($item->status_dinas);
                        @endphp
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: {{ $stDinas?->cssColor() ?? 'var(--muted)' }}; background: {{ $stDinas?->cssBgColor() ?? 'var(--line)' }};">
                            {{ $stDinas?->label() ?? ucwords(str_replace('_', ' ', $item->status_dinas)) }}
                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        @php
                            $stKominfo = $item->status_kominfo instanceof \App\Enums\StatusKominfo ? $item->status_kominfo : \App\Enums\StatusKominfo::tryFrom($item->status_kominfo);
                        @endphp
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: {{ $stKominfo?->cssColor() ?? '#EB891B' }}; background: {{ $stKominfo?->cssBgColor() ?? 'rgba(235,137,27,.1)' }};">
                            {{ $stKominfo?->label() ?? ucwords(str_replace('_', ' ', $item->status_kominfo)) }}
                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        @php
                            $stBps = $item->status_bps instanceof \App\Enums\StatusBps ? $item->status_bps : \App\Enums\StatusBps::tryFrom($item->status_bps);
                        @endphp
                        <span style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: {{ $stBps?->cssColor() ?? '#EB891B' }}; background: {{ $stBps?->cssBgColor() ?? 'rgba(235,137,27,.1)' }};">
                            {{ $stBps?->label() ?? ucwords(str_replace('_', ' ', $item->status_bps)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada pengajuan Romantik untuk filter yang dipilih.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        {{-- Mobile Cards View --}}
        <div class="mobile-only">
            @forelse($romantik as $item)
                @php
                    $stDinas = $item->status_dinas instanceof \App\Enums\StatusDinas ? $item->status_dinas : \App\Enums\StatusDinas::tryFrom($item->status_dinas);
                    $stKominfo = $item->status_kominfo instanceof \App\Enums\StatusKominfo ? $item->status_kominfo : \App\Enums\StatusKominfo::tryFrom($item->status_kominfo);
                    $stBps = $item->status_bps instanceof \App\Enums\StatusBps ? $item->status_bps : \App\Enums\StatusBps::tryFrom($item->status_bps);
                @endphp
                <div style="border-bottom: 1px solid var(--line); padding: 16px 20px; display: flex; flex-direction: column; gap: 12px;">
                    <div>
                        <div style="font-size: 11px; color: var(--muted); font-weight: 700; margin-bottom: 4px; text-transform: uppercase;">{{ $item->kegiatanStatistik->dinas->singkatan ?? '-' }}</div>
                        <div style="font-size: 14.5px; font-weight: 700; color: var(--navy); line-height: 1.35;">{{ $item->kegiatanStatistik->nama }}</div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr; gap: 8px; margin-top: 4px; background: var(--navy-50); padding: 12px; border-radius: 8px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Status Dinas</span>
                            <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: {{ $stDinas?->cssColor() ?? 'var(--muted)' }}; background: {{ $stDinas?->cssBgColor() ?? 'var(--line)' }};">
                                {{ $stDinas?->label() ?? ucwords(str_replace('_', ' ', $item->status_dinas)) }}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Status Kominfo</span>
                            <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: {{ $stKominfo?->cssColor() ?? '#EB891B' }}; background: {{ $stKominfo?->cssBgColor() ?? 'rgba(235,137,27,.1)' }};">
                                {{ $stKominfo?->label() ?? ucwords(str_replace('_', ' ', $item->status_kominfo)) }}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 11px; font-weight: 600; color: var(--navy);">Status BPS</span>
                            <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: {{ $stBps?->cssColor() ?? '#EB891B' }}; background: {{ $stBps?->cssBgColor() ?? 'rgba(235,137,27,.1)' }};">
                                {{ $stBps?->label() ?? ucwords(str_replace('_', ' ', $item->status_bps)) }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div style="padding: 32px; text-align: center; color: var(--muted);">Belum ada pengajuan Romantik untuk filter yang dipilih.</div>
            @endforelse
        </div>
        @if($romantik->hasPages())
        <div style="padding: 20px;">
            {{ $romantik->links() }}
        </div>
        @endif
    </div>
</div>
