<?php $__env->startSection('title', 'Kesalahan Server - PASEBAN'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center px-4">
    <h1 class="text-6xl font-bold text-red mb-4 font-['JetBrains_Mono']">500</h1>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Terjadi Kesalahan pada Server</h2>
    <p class="text-gray-600 max-w-md mb-8">
        Maaf, sistem kami sedang mengalami gangguan internal. Tim teknis kami telah diberitahu dan sedang berusaha memperbaikinya.
    </p>
    <a href="<?php echo e(url('/')); ?>" class="bg-navy text-white px-6 py-3 rounded-lg hover:bg-navy-900 transition duration-300 font-medium">
        Kembali ke Beranda
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PASEBAN APP\resources\views/errors/500.blade.php ENDPATH**/ ?>