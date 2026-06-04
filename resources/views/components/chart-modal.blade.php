<div x-show="modalOpen" style="display: none; position: fixed; inset: 0; z-index: 9999;" x-transition.opacity>
    <!-- Backdrop -->
    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" @click="modalOpen = false"></div>
    
    <!-- Modal Dialog -->
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; border-radius: 12px; width: 90%; max-width: 600px; max-height: 85vh; display: flex; flex-direction: column; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        
        <!-- Header -->
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: var(--navy);" x-text="modalTitle">Rincian Data</h3>
            <button @click="modalOpen = false" style="background: none; border: none; cursor: pointer; color: var(--muted); padding: 4px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        
        <!-- Content/List -->
        <div style="padding: 20px 24px; overflow-y: auto; flex: 1; background: #f8fafc;">
            <div x-show="modalLoading" style="text-align: center; padding: 40px 0; color: var(--muted);">
                <div style="width: 30px; height: 30px; border: 3px solid #e2e8f0; border-top-color: var(--orange); border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 10px;"></div>
                Memuat data...
            </div>
            
            <div x-show="!modalLoading && modalItems.length === 0" style="text-align: center; padding: 40px 0; color: var(--muted); font-style: italic; display: none;">
                Tidak ada data.
            </div>

            <!-- Table Header -->
            <div x-show="!modalLoading && modalItems.length > 0" style="display: flex; justify-content: space-between; padding: 0 16px 12px; border-bottom: 2px solid var(--line); margin-bottom: 12px; display: none;">
                <div style="font-size: 13.5px; font-weight: 700; color: var(--navy);">OPD / Kegiatan</div>
                <div style="font-size: 13.5px; font-weight: 700; color: var(--navy);">Status</div>
            </div>

            <!-- Table Body / List -->
            <div x-show="!modalLoading && modalItems.length > 0" style="display: flex; flex-direction: column; gap: 8px; display: none;">
                <template x-for="(item, index) in modalItems" :key="index">
                    <div class="modal-list-item" style="background: #fff; padding: 16px; border-radius: 8px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; transition: all 0.2s ease; cursor: default;">
                        <div style="padding-right: 16px;">
                            <div style="font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;" x-text="item.dinas"></div>
                            <div style="font-weight: 600; color: #05529F; font-size: 14.5px; line-height: 1.4;" x-text="item.kegiatan"></div>
                        </div>
                        <div>
                            <span :style="`background: ${item.status_bg}; color: ${item.status_color}; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; white-space: nowrap; display: inline-block;`" x-text="item.status_label"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        
    </div>
</div>

<style>
    @keyframes spin { 100% { transform: rotate(360deg); } }
    .modal-list-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -4px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
</style>
