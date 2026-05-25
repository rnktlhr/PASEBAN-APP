<div>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; gap: 16px;">
        <div>
            <div style="font-size: 12px; letter-spacing: 1.5px; color: var(--teal-600); text-transform: uppercase; font-weight: 700; margin-bottom: 6px;">◆ Monitoring & Evaluasi</div>
            <h2 style="margin: 0; font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px;">Kalender Monitoring & Evaluasi</h2>
            <p style="margin: 8px 0 0; color: var(--muted); font-size: 14.5px;">Rencana vs realisasi kegiatan statistik sektoral sepanjang tahun {{ $tahun }}.</p>
        </div>
        <div style="display: flex; gap: 8px; align-items: center; justify-content: flex-end; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; border: 1px solid var(--line); border-radius: 6px; background: #fff; overflow: hidden; padding: 0 2px; box-shadow: var(--shadow-sm); height: 36px;">
                <button type="button" wire:click="decrementTahun" style="padding: 6px 8px; color: var(--muted); cursor: pointer;" aria-label="Tahun sebelumnya"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg></button>
                <div class="mono" style="padding: 0 10px; font-size: 13px; font-weight: 700; color: var(--navy); min-width: 40px; text-align: center;">{{ $tahun }}</div>
                <button type="button" wire:click="incrementTahun" style="padding: 6px 8px; color: var(--muted); cursor: pointer;" aria-label="Tahun berikutnya"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></button>
            </div>
            
            <select wire:model.live="dinas_id" style="padding: 0 10px; height: 36px; border: 1px solid var(--line); border-radius: 6px; font-size: 12.5px; color: var(--navy); font-weight: 500; background: #fff; outline: none; width: 140px; box-shadow: var(--shadow-sm); cursor: pointer;">
                <option value="">Semua OPD</option>
                @foreach(\App\Models\Dinas::orderBy('singkatan')->get() as $dinas)
                    <option value="{{ $dinas->id }}">{{ $dinas->singkatan }}</option>
                @endforeach
            </select>

            <select wire:model.live="status" style="padding: 0 10px; height: 36px; border: 1px solid var(--line); border-radius: 6px; font-size: 12.5px; color: var(--navy); font-weight: 500; background: #fff; outline: none; width: 120px; box-shadow: var(--shadow-sm); cursor: pointer;">
                <option value="">Semua Status</option>
                <option value="tepat_waktu">Tepat Waktu</option>
                <option value="terlambat">Terlambat</option>
            </select>

            <div style="display: flex; align-items: center;">
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari kegiatan..." style="padding: 0 10px; height: 36px; border: 1px solid var(--line); border-radius: 6px; font-size: 12.5px; color: var(--navy); font-weight: 500; background: #fff; outline: none; width: 140px; box-shadow: var(--shadow-sm);">
            </div>

            <div style="display: flex; gap: 8px; align-items: center;">
                <a href="{{ route('monev.export.excel', ['tahun' => $tahun, 'dinas_id' => $dinas_id, 'status' => $status, 'search' => $search]) }}" style="padding: 0 12px; height: 36px; background: #00B3B3; color: #fff; border-radius: 6px; font-size: 12.5px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 6px; box-shadow: var(--shadow-sm); transition: .2s;" onmouseover="this.style.background='#009999'" onmouseout="this.style.background='#00B3B3'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Excel
                </a>
                <a href="{{ route('monev.export.pdf', ['tahun' => $tahun, 'dinas_id' => $dinas_id, 'status' => $status, 'search' => $search]) }}" style="padding: 0 12px; height: 36px; background: #F58220; color: #fff; border-radius: 6px; font-size: 12.5px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 6px; box-shadow: var(--shadow-sm); transition: .2s;" onmouseover="this.style.background='#d66a15'" onmouseout="this.style.background='#F58220'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    PDF
                </a>
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 20px; margin-bottom: 14px; padding-left: 4px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 8px; font-size: 12.5px; color: var(--ink); font-weight: 500;"><span style="width: 18px; height: 8px; border-radius: 2px; background: var(--light-blue);"></span>Rencana</div>
        <div style="display: flex; align-items: center; gap: 8px; font-size: 12.5px; color: var(--ink); font-weight: 500;"><span style="width: 18px; height: 8px; border-radius: 2px; background: var(--navy);"></span>Realisasi Tepat Waktu</div>
        <div style="display: flex; align-items: center; gap: 8px; font-size: 12.5px; color: var(--ink); font-weight: 500;"><span style="width: 18px; height: 8px; border-radius: 2px; background: var(--red);"></span>Terlambat</div>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; position: relative;">
        <!-- Loading overlay -->
        <div wire:loading class="absolute inset-0 z-10" style="background: rgba(255,255,255,0.7); backdrop-filter: blur(2px);">
            <div class="flex items-center justify-center h-full">
                <svg class="animate-spin h-8 w-8 text-[var(--navy)]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
        
        <div style="overflow-x: auto;">
            <div style="min-width: 1100px;">
                <div style="display: grid; grid-template-columns: minmax(220px, 1.4fr) repeat(12, 1fr); background: var(--navy-50); border-bottom: 1px solid var(--line);">
                    <div style="padding: 12px 16px; font-size: 12px; font-weight: 700; color: var(--navy); text-transform: uppercase; letter-spacing: .5px;">Kegiatan Statistik</div>
                    @foreach(['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'] as $bln)
                    <div style="padding: 12px 4px; text-align: center; font-size: 11.5px; font-weight: 700; color: var(--navy); border-left: 1px solid rgba(5,82,159,.08);">{{ $bln }}</div>
                    @endforeach
                </div>

                @forelse($monevItems as $monev)
                <div style="display: grid; grid-template-columns: minmax(220px, 1.4fr) repeat(12, 1fr); border-bottom: 1px solid var(--line); min-height: 60px; align-items: stretch;">
                    <div style="padding: 14px 16px; display: flex; flex-direction: column; justify-content: center; gap: 6px;">
                        <div style="font-size: 13.5px; font-weight: 700; color: var(--ink);">{{ $monev->kegiatanStatistik->nama }}</div>
                        <div style="font-size: 11.5px; color: var(--muted);">{{ $monev->kegiatanStatistik->dinas->singkatan ?? '' }}</div>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span style="font-size: 10.5px; font-weight: 700; color: var(--navy); background: var(--navy-50); padding: 2px 8px; border-radius: 999px;">{{ ucfirst(str_replace('_', ' ', $monev->kegiatanStatistik->jenis)) }}</span>
                        </div>
                    </div>
                    @for($m = 1; $m <= 12; $m++)
                    @php
                        $isRencana = $m >= $monev->bulan_rencana_mulai && $m <= $monev->bulan_rencana_selesai;
                        $isRealisasi = $monev->bulan_realisasi_mulai && $monev->bulan_realisasi_selesai && $m >= $monev->bulan_realisasi_mulai && $m <= $monev->bulan_realisasi_selesai;
                        $realisasiColor = $monev->status === 'terlambat' ? 'var(--red)' : 'var(--navy)';
                    @endphp
                    <div style="padding: 10px 6px; border-left: 1px solid var(--line); display: flex; flex-direction: column; justify-content: center; gap: 4px;">
                        <div style="height: 8px; border-radius: 2px; {{ $isRencana ? 'background: var(--light-blue);' : '' }}"></div>
                        <div style="height: 8px; border-radius: 2px; {{ $isRealisasi ? 'background: '.$realisasiColor.';' : '' }}"></div>
                    </div>
                    @endfor
                </div>
                @empty
                <div style="padding: 32px; text-align: center; color: var(--muted);">Data tidak ditemukan untuk filter ini.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- stats row -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 20px;">
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 20px 22px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 12.5px; color: var(--muted); font-weight: 500; margin-bottom: 6px;">Total Kegiatan</div>
            <div style="font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px; line-height: 1;">{{ $totalKegiatan }}</div>
        </div>
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 20px 22px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 12.5px; color: var(--muted); font-weight: 500; margin-bottom: 6px;">Tepat Waktu</div>
            <div style="font-size: 30px; font-weight: 800; color: var(--teal-600); letter-spacing: -.6px; line-height: 1;">{{ $monevTepatWaktu }}</div>
        </div>
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 20px 22px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 12.5px; color: var(--muted); font-weight: 500; margin-bottom: 6px;">Terlambat</div>
            <div style="font-size: 30px; font-weight: 800; color: var(--red); letter-spacing: -.6px; line-height: 1;">{{ $monevTerlambat }}</div>
        </div>
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 20px 22px; box-shadow: var(--shadow-sm);">
            <div style="font-size: 12.5px; color: var(--muted); font-weight: 500; margin-bottom: 6px;">Tingkat Keberhasilan</div>
            <div style="font-size: 30px; font-weight: 800; color: var(--navy); letter-spacing: -.6px; line-height: 1;">{{ $pctKeberhasilan }}%</div>
        </div>
    </div>
</div>
