<div class="container" style="padding: 16px 32px 40px; min-height: calc(100vh - 74px);">
    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-bottom: 24px;">
        <select wire:model.live="dinasFilter" class="w-full-mobile styled-select"
            style="padding: 10px 36px 10px 14px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; outline: none; color: var(--ink); background-color: #fff; box-shadow: var(--shadow-sm); max-width: 250px; cursor: pointer;">
            <option value="">Semua OPD / Dinas</option>
            @foreach($dinasList as $id => $nama)
                <option value="{{ $id }}">{{ $nama }}</option>
            @endforeach
        </select>

        <div wire:loading wire:target="dinasFilter"
            style="display: flex; align-items: center; gap: 8px; color: var(--muted); font-size: 13px; font-weight: 600;">
            <svg class="animate-spin" width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" style="animation: spin 1s linear infinite;">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <style>
                @keyframes spin {
                    100% {
                        transform: rotate(360deg);
                    }
                }
            </style>
            Memuat data...
        </div>
    </div>

    @if(!$dinasFilter)
        <div
            style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 40px; text-align: center; box-shadow: var(--shadow-sm);">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" style="color: var(--muted); margin: 0 auto 16px;">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <h3 style="margin: 0 0 8px; font-size: 16px; font-weight: 700; color: var(--navy);">Pilih OPD / Dinas</h3>
            <p style="margin: 0; font-size: 14px; color: var(--muted);">Pilih dinas pada menu filter di atas untuk melihat
                data indikator langsung dari API Sedata Sebantul.</p>
        </div>
    @else
        <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);"
            wire:loading.remove wire:target="dinasFilter">
            <div class="table-responsive desktop-only">
                <table
                    style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                    <thead>
                        <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                            <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 15%;">
                                ID Data</th>
                            <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 42%;">
                                Nama Data</th>
                            <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 23%;">
                                Cakupan</th>
                            <th
                                style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">
                                Pemutakhiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($indikatorData as $item)
                            <tr style="border-bottom: 1px solid var(--line);">
                                <td style="padding: 16px; font-weight: 600; color: var(--muted);">
                                    {{ $item['id_data'] ?? '-' }}
                                </td>
                                <td style="padding: 16px; font-weight: 500; color: var(--ink);">
                                    {{ $item['nama_data'] ?? '-' }}
                                </td>
                                <td style="padding: 16px; color: var(--muted);">
                                    {{ $item['cakupan'] ?? '-' }}
                                </td>
                                <td style="padding: 16px; text-align: center;">
                                    <span
                                        style="display: inline-block; width: 140px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: #00B69B; background: rgba(0, 182, 155, 0.1);">
                                        {{ $item['pemutahiran'] ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 40px; text-align: center;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                        style="color: var(--muted); margin: 0 auto 12px;">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="9" y1="3" x2="9" y2="21"></line>
                                    </svg>
                                    <div style="font-weight: 700; color: var(--navy); margin-bottom: 4px;">Tidak ada data</div>
                                    <div style="color: var(--muted); font-size: 13.5px;">Belum ada indikator yang ditarik dari
                                        API Sedata Sebantul untuk instansi ini.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards View --}}
            <div class="mobile-only">
                @forelse($indikatorData as $item)
                    <div
                        style="border-bottom: 1px solid var(--line); padding: 16px 20px; display: flex; flex-direction: column; gap: 12px;">
                        <div>
                            <div
                                style="font-size: 11px; color: var(--muted); font-weight: 700; margin-bottom: 4px; display: flex; justify-content: space-between;">
                                <span>ID: {{ $item['id_data'] ?? '-' }}</span>
                                <span
                                    style="display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; color: #00B69B; background: rgba(0, 182, 155, 0.1);">
                                    {{ $item['pemutahiran'] ?? '-' }}
                                </span>
                            </div>
                            <div style="font-size: 14.5px; font-weight: 700; color: var(--navy); line-height: 1.35;">
                                {{ $item['nama_data'] ?? '-' }}</div>
                        </div>
                        <div style="font-size: 12px; color: var(--muted); font-weight: 500;">
                            Cakupan: {{ $item['cakupan'] ?? '-' }}
                        </div>
                    </div>
                @empty
                    <div style="padding: 32px; text-align: center;">
                        <div style="font-weight: 700; color: var(--navy); margin-bottom: 4px;">Tidak ada data</div>
                        <div style="color: var(--muted); font-size: 13.5px;">Belum ada indikator yang ditarik dari API Sedata
                            Sebantul untuk instansi ini.</div>
                    </div>
                @endforelse
            </div>
        </div>
    @endif
</div>