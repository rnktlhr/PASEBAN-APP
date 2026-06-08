<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'PASEBAN — Platform terpadu BPS Kabupaten Bantul untuk pemantauan, pembinaan, dan monitoring kegiatan statistik sektoral.')">
    <title>@yield('title', 'PASEBAN')</title>
    <!-- Memaksa browser menghapus cache favicon -->
    <link rel="icon" href="data:,">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="page-transition">
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @livewireScripts
    @stack('scripts')
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
    </script>
</body>
</html>
