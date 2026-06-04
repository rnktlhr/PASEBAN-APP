<?php $__env->startSection('title', 'Monitoring & Evaluasi — Paseban'); ?>

<?php $__env->startSection('content'); ?>
<section style="padding: 72px 0; background: #fff; border-bottom: 1px solid var(--line); min-height: 80vh;">
    <div class="container">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('monev-calendar', ['tahunAwal' => $tahun]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3650512985-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/public/monev.blade.php ENDPATH**/ ?>