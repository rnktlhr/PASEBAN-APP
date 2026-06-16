<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'PASEBAN — Platform terpadu BPS Kabupaten Bantul untuk pemantauan, pembinaan, dan monitoring kegiatan statistik sektoral.'); ?>">
    <title><?php echo $__env->yieldContent('title', 'PASEBAN'); ?></title>
    <!-- Memaksa browser menghapus cache favicon -->
    <link rel="icon" href="data:,">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>?v=<?php echo e(filemtime(public_path('css/style.css'))); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="page-transition">
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sienna-accessibility/dist/sienna-accessibility.umd.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const body = document.body;
            
            // Slight delay ensures the browser paints the initial opacity:0 state first
            setTimeout(() => {
                body.classList.add("page-entered");
            }, 50);

            document.querySelectorAll("a").forEach(link => {
                link.addEventListener("click", e => {
                    const target = link.getAttribute("href");
                    if (!target || target.startsWith("#") || target.startsWith("javascript:") || link.target === "_blank" || e.ctrlKey || e.metaKey) return;
                    if (target.startsWith("http") && !target.includes(window.location.host)) return;
                    if (target.includes('/export') || target.includes('export')) return;
                    
                    e.preventDefault();
                    body.classList.remove("page-entered");
                    body.classList.add("page-leaving");
                    
                    // Wait exactly the CSS duration (300ms) before navigating
                    setTimeout(() => {
                        window.location.href = link.href;
                    }, 300); 
                });
            });

            // Scroll Reveal Animation
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                        observer.unobserve(entry.target); // Animate only once
                    }
                });
            }, observerOptions);
            document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
        });

        // Global Alpine.js Components
        document.addEventListener('alpine:init', () => {
            Alpine.data('countUp', (target, duration = 1200) => ({
                count: 0,
                target: target,
                duration: duration,
                started: false,
                init() {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting && !this.started) {
                                this.started = true;
                                setTimeout(() => {
                                    this.animate();
                                }, 300); // Wait for page transition to finish
                            }
                        });
                    }, { threshold: 0.1 });
                    observer.observe(this.$el);
                },
                animate() {
                    let startTime = null;
                    const step = (timestamp) => {
                        if (!startTime) startTime = timestamp;
                        const progress = Math.min((timestamp - startTime) / this.duration, 1);
                        const ease = 1 - Math.pow(1 - progress, 3); // cubic ease out
                        this.count = Math.floor(ease * this.target);
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            this.count = this.target;
                        }
                    };
                    window.requestAnimationFrame(step);
                }
            }));
        });
        // Make Accessibility Widget Draggable on Mobile
        document.addEventListener('DOMContentLoaded', () => {
            setInterval(() => {
                const els = document.querySelectorAll('body > div, body > button, body > sienna-wrapper, body > sienna-accessibility');
                let siennaWrapper = null;
                els.forEach(el => {
                    const id = el.id || '';
                    const cls = (typeof el.className === 'string') ? el.className : '';
                    const tag = el.tagName || '';
                    if (id.toLowerCase().includes('sienna') || cls.toLowerCase().includes('sienna') || tag.toLowerCase().includes('SIENNA')) {
                        siennaWrapper = el;
                    }
                });

                if (siennaWrapper && !siennaWrapper.dataset.dragBinded) {
                    siennaWrapper.dataset.dragBinded = 'true';
                    
                    let isDragging = false;
                    let hasDragged = false;
                    let startX, startY, initialLeft, initialTop;

                    // Support Shadow DOM by listening to document if necessary, 
                    // but usually attaching to the wrapper works because events bubble up.
                    siennaWrapper.addEventListener('touchstart', (e) => {
                        if (window.innerWidth > 768) return;
                        isDragging = true;
                        hasDragged = false;
                        const rect = siennaWrapper.getBoundingClientRect();
                        initialLeft = rect.left;
                        initialTop = rect.top;
                        startX = e.touches[0].clientX;
                        startY = e.touches[0].clientY;
                    }, { passive: true });

                    siennaWrapper.addEventListener('touchmove', (e) => {
                        if (!isDragging) return;
                        const dx = e.touches[0].clientX - startX;
                        const dy = e.touches[0].clientY - startY;
                        
                        if (Math.abs(dx) > 8 || Math.abs(dy) > 8) {
                            hasDragged = true;
                            siennaWrapper.style.setProperty('position', 'fixed', 'important');
                            siennaWrapper.style.setProperty('margin', '0', 'important');
                            siennaWrapper.style.setProperty('bottom', 'auto', 'important');
                            siennaWrapper.style.setProperty('right', 'auto', 'important');
                            siennaWrapper.style.setProperty('left', (initialLeft + dx) + 'px', 'important');
                            siennaWrapper.style.setProperty('top', (initialTop + dy) + 'px', 'important');
                            siennaWrapper.style.setProperty('transform', 'none', 'important');
                            siennaWrapper.style.setProperty('z-index', '999999', 'important');
                            if(e.cancelable) e.preventDefault(); 
                        }
                    }, { passive: false });

                    siennaWrapper.addEventListener('touchend', (e) => {
                        isDragging = false;
                    });
                    
                    // Prevent click if we were dragging
                    siennaWrapper.addEventListener('click', (e) => {
                        if (hasDragged) {
                            e.preventDefault();
                            e.stopPropagation();
                            hasDragged = false;
                        }
                    }, true);
                }
            }, 1500);
        });
    </script>
</body>
</html>
<?php /**PATH D:\PASEBAN APP\resources\views/layouts/app.blade.php ENDPATH**/ ?>