<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <x-filament::section>
            <x-slot name="heading">
                Pilih Instansi/Dinas
            </x-slot>
            <x-slot name="description">
                Pilih dinas terlebih dahulu untuk melihat data indikator langsung dari Sedata Sebantul.
            </x-slot>

            <div class="max-w-md">
                <x-filament::input.wrapper>
                    <x-filament::input.select wire:model.live="dinasId">
                        <option value="">-- Pilih Dinas --</option>
                        @foreach($this->dinasOptions as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>
        </x-filament::section>

        <div wire:loading wire:target="dinasId" class="w-full flex justify-center py-8">
            <x-filament::loading-indicator class="h-8 w-8 text-primary-500" />
        </div>

        <div wire:loading.remove wire:target="dinasId">
            @if($dinasId)
                <x-filament::section>
                    <x-slot name="heading">
                        Data Indikator API
                    </x-slot>
                    
                    <div class="fi-ta-content divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl">
                        <table class="fi-ta-table w-full text-left divide-y divide-gray-200 dark:divide-white/5">
                            <thead class="bg-gray-50 dark:bg-white/5">
                                <tr>
                                    <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6"><span class="text-sm font-semibold text-gray-950 dark:text-white">ID Data</span></th>
                                    <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6"><span class="text-sm font-semibold text-gray-950 dark:text-white">Nama Data</span></th>
                                    <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6"><span class="text-sm font-semibold text-gray-950 dark:text-white">Cakupan</span></th>
                                    <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6"><span class="text-sm font-semibold text-gray-950 dark:text-white">Pemutakhiran</span></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                @forelse($indikatorData as $item)
                                <tr class="fi-ta-row [@media(hover:hover)]:hover:bg-gray-50 dark:[@media(hover:hover)]:hover:bg-white/5">
                                    <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                        <div class="fi-ta-col-wrp px-3 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $item['id_data'] ?? '-' }}</div>
                                    </td>
                                    <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                        <div class="fi-ta-col-wrp px-3 py-4 text-sm font-medium text-gray-950 dark:text-white">{{ $item['nama_data'] ?? '-' }}</div>
                                    </td>
                                    <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                        <div class="fi-ta-col-wrp px-3 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $item['cakupan'] ?? '-' }}</div>
                                    </td>
                                    <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                        <div class="fi-ta-col-wrp px-3 py-4">
                                            <x-filament::badge color="info">{{ $item['pemutahiran'] ?? '-' }}</x-filament::badge>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-8 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada data yang ditemukan untuk instansi ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-filament::section>
            @endif
        </div>
    </div>
</x-filament-panels::page>
