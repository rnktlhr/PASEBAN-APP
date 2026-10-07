<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation"
        style="display: flex; justify-content: flex-end; align-items: center; gap: 12px;">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
            <span
                style="padding: 10px 16px; font-size: 13.5px; font-weight: 600; color: var(--muted); background-color: #f9fafb; border: 1px solid var(--line); border-radius: 8px; cursor: not-allowed; display: flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Previous
            </span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"
                style="padding: 10px 16px; font-size: 13.5px; font-weight: 600; color: var(--navy); background-color: #ffffff; border: 1px solid var(--line); border-radius: 8px; text-decoration: none; box-shadow: var(--shadow-sm); transition: all 0.2s; display: flex; align-items: center; gap: 6px;"
                onmouseover="this.style.borderColor='var(--navy)'; this.style.color='var(--navy)';"
                onmouseout="this.style.borderColor='var(--line)'; this.style.color='var(--navy)';">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Previous
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"
                style="padding: 10px 16px; font-size: 13.5px; font-weight: 600; color: var(--navy); background-color: #ffffff; border: 1px solid var(--line); border-radius: 8px; text-decoration: none; box-shadow: var(--shadow-sm); transition: all 0.2s; display: flex; align-items: center; gap: 6px;"
                onmouseover="this.style.borderColor='var(--navy)'; this.style.color='var(--navy)';"
                onmouseout="this.style.borderColor='var(--line)'; this.style.color='var(--navy)';">
                Next
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        <?php else: ?>
            <span
                style="padding: 10px 16px; font-size: 13.5px; font-weight: 600; color: var(--muted); background-color: #f9fafb; border: 1px solid var(--line); border-radius: 8px; cursor: not-allowed; display: flex; align-items: center; gap: 6px;">
                Next
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </nav>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH D:\PASEBAN APP\resources\views\partials\pagination.blade.php ENDPATH**/ ?>