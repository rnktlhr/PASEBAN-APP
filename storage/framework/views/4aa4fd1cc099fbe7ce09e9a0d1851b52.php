
<section
    style="background: linear-gradient(135deg, var(--navy) 0%, var(--navy-900) 60%, #021a3d 100%); color: #fff; position: relative; overflow: hidden; margin-top: -74px; padding-top: 74px; min-height: 100vh; display: flex; flex-direction: column; justify-content: center;">

    
    <div
        style="position: absolute; right: -100px; top: -100px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(235,137,27,.25), transparent 70%); border-radius: 50%;">
    </div>

    <div class="container hero-grid" style="padding-top: 72px; padding-bottom: 88px; position: relative;">
        <div style="min-width: 0;">
            <div class="anim-fade-up delay-1"
                style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 12px; border-radius: 999px; background: rgba(235,137,27,.18); border: 1px solid rgba(235,137,27,.4); font-size: 12px; font-weight: 600; color: var(--orange); margin-bottom: 24px;">
                <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--orange);"></span>
                Periode Pelaporan &middot; Tahun <?php echo e($tahun); ?>

            </div>
            <style>
                @keyframes cursor-blink {

                    0%,
                    100% {
                        opacity: 1;
                    }

                    50% {
                        opacity: 0;
                    }
                }
            </style>
            <h1 class="hero-title anim-fade-up delay-2" style="margin: 0; min-height: 1.2em;"
                x-data="{ text1: '', text2: '', full1: 'Selamat Datang di ', full2: 'Paseban' }" x-init="
                    setTimeout(() => {
                        let typeLoop = () => {
                            let i = 0, j = 0;
                            text1 = '';
                            text2 = '';
                            
                            let typeChar = () => {
                                if (i < full1.length) {
                                    text1 += full1.charAt(i);
                                    i++;
                                    setTimeout(typeChar, Math.random() * 50 + 30);
                                } else if (j < full2.length) {
                                    text2 += full2.charAt(j);
                                    j++;
                                    // Make 'Paseban' type slightly slower for dramatic effect
                                    setTimeout(typeChar, Math.random() * 80 + 50);
                                } else {
                                    setTimeout(() => {
                                        let delChar = () => {
                                            if (text2.length > 0) {
                                                text2 = text2.slice(0, -1);
                                                setTimeout(delChar, 20);
                                            } else if (text1.length > 0) {
                                                text1 = text1.slice(0, -1);
                                                setTimeout(delChar, 20);
                                            } else {
                                                setTimeout(typeLoop, 800);
                                            }
                                        };
                                        delChar();
                                    }, 5000);
                                }
                            };
                            typeChar();
                        };
                        typeLoop();
                    }, 400);
                ">
                <span x-text="text1" style="color: #fff;"></span><span
                    style="background: linear-gradient(120deg, #fff 0%, var(--orange) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                    x-text="text2"></span>
            </h1>
            <p class="anim-fade-up delay-3"
                style="margin: 20px 0 0; max-width: 560px; font-size: 17px; line-height: 1.6; color: rgba(255,255,255,.78); font-weight: 400;">
                <strong style="color: #fff; font-weight: 600;">Pemantauan Statistik Sektoral Bantul</strong> — platform
                terpadu BPS Kabupaten Bantul untuk pembinaan, pendampingan, dan monitoring kegiatan statistik sektoral
                di lingkungan Pemerintah Kabupaten Bantul.
            </p>

            <div class="hero-stats">
                <div class="anim-fade-up" style="animation-delay: 400ms;">
                    <div class="mono" style="font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -.5px;"
                        x-data="{ 
                                 count: 0, target: <?php echo e($totalDinas); ?>,
                                 animate() {
                                     this.count = 0;
                                     let step = this.target / 40;
                                     let int = setInterval(() => { this.count += step; if(this.count >= this.target){ this.count = this.target; clearInterval(int); } }, 30);
                                 }
                             }" x-init="setTimeout(() => animate(), 600)" @slider-changed.window="animate()"
                        x-text="Math.floor(count)">0</div>
                    <div
                        style="font-size: 11.5px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 2px;">
                        OPD Terdaftar</div>
                </div>
                <div class="anim-fade-up" style="animation-delay: 550ms;">
                    <div class="mono" style="font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -.5px;"
                        x-data="{ 
                                 count: 0, target: <?php echo e($totalKegiatan); ?>,
                                 animate() {
                                     this.count = 0;
                                     let step = this.target / 40;
                                     let int = setInterval(() => { this.count += step; if(this.count >= this.target){ this.count = this.target; clearInterval(int); } }, 30);
                                 }
                             }" x-init="setTimeout(() => animate(), 750)"
                        @slider-changed.window="setTimeout(() => animate(), 150)" x-text="Math.floor(count)">0</div>
                    <div
                        style="font-size: 11.5px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 2px;">
                        Kegiatan <?php echo e($tahun); ?></div>
                </div>
                <div class="anim-fade-up" style="animation-delay: 700ms;">
                    <div class="mono" style="font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -.5px;"
                        x-data="{ 
                                 count: 0, target: <?php echo e($tingkatRespon); ?>,
                                 animate() {
                                     this.count = 0;
                                     let step = this.target / 40;
                                     let int = setInterval(() => { this.count += step; if(this.count >= this.target){ this.count = this.target; clearInterval(int); } }, 30);
                                 }
                             }" x-init="setTimeout(() => animate(), 900)"
                        @slider-changed.window="setTimeout(() => animate(), 300)"><span
                            x-text="Math.floor(count)">0</span>%</div>
                    <div
                        style="font-size: 11.5px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 2px;">
                        Tingkat Respon</div>
                </div>
            </div>
        </div>


    </div>
</section>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {


        });

        // Alpine.js component for hero slider
        document.addEventListener('alpine:init', () => {

            Alpine.data('heroSlider', () => ({
                active: 0,
                animValue: 0,
                animPct: 0,
                isChanging: false,
                chartInstance: null,
                slides: [
                    {
                        title: 'ROMANTIK',
                        cardTitle: 'Romantik Disetujui',
                        cardValue: <?php echo e($romantikDiajukan); ?>,
                        cardTotal: <?php echo e($totalKegiatan); ?>,
                        cardPct: <?php echo e($pctRomantik); ?>,
                        chartData: <?php echo json_encode($heroMonthlyRomantik, 15, 512) ?>
                    },
                    {
                        title: 'METADATA',
                        cardTitle: 'Metadata Terisi',
                        cardValue: <?php echo e($metaKegiatanDone); ?>,
                        cardTotal: <?php echo e($metaKegiatanTotal ?: 1); ?>,
                        cardPct: <?php echo e($pctMetadata); ?>,
                        chartData: <?php echo json_encode($heroMonthlyMetadata, 15, 512) ?>
                    },
                    {
                        title: 'ALIRAN DATA',
                        cardTitle: 'Data Sudah Tayang',
                        cardValue: <?php echo e($aliranTayang); ?>,
                        cardTotal: <?php echo e($aliranTotal ?: 1); ?>,
                        cardPct: <?php echo e($pctAliran); ?>,
                        chartData: <?php echo json_encode($heroMonthlyAliran, 15, 512) ?>
                    }
                ],
                start() {
                    this.animValue = this.slides[0].cardValue;
                    this.animPct = this.slides[0].cardPct;
                    this.initChart();
                    setInterval(() => {
                        this.isChanging = true;
                        setTimeout(() => {
                            this.active = (this.active + 1) % this.slides.length;
                            this.updateChart();
                            this.animateCardValues();
                            window.dispatchEvent(new CustomEvent('slider-changed'));
                            this.isChanging = false;
                        }, 300);
                    }, 10000); // changes every 10 seconds
                },
                animateCardValues() {
                    let targetValue = this.slides[this.active].cardValue;
                    let targetPct = this.slides[this.active].cardPct;
                    let startValue = this.animValue;
                    let startPct = this.animPct;
                    let duration = 800;
                    let startTime = null;

                    let step = (timestamp) => {
                        if (!startTime) startTime = timestamp;
                        let progress = Math.min((timestamp - startTime) / duration, 1);
                        // easeOut cubic
                        let ease = 1 - Math.pow(1 - progress, 3);

                        this.animValue = Math.round(startValue + (targetValue - startValue) * ease);
                        this.animPct = Math.round(startPct + (targetPct - startPct) * ease);

                        if (progress < 1) requestAnimationFrame(step);
                    };
                    requestAnimationFrame(step);
                },
                initChart() {
                    const options = {
                        series: [{ name: 'Total', data: this.slides[this.active].chartData }],
                        chart: {
                            type: 'bar',
                            height: 150,
                            toolbar: { show: false },
                            parentHeightOffset: 0,
                            animations: { enabled: true, dynamicAnimation: { speed: 800 } }
                        },
                        colors: ['#00B69B'],
                        plotOptions: {
                            bar: {
                                columnWidth: '55%',
                                borderRadius: 3,
                                colors: {
                                    backgroundBarColors: ['rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)', 'rgba(255,255,255,0.06)'],
                                    backgroundBarRadius: 3
                                },
                                dataLabels: { position: 'bottom' }
                            }
                        },
                        xaxis: {
                            categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                            labels: { style: { colors: 'rgba(255,255,255,0.5)', fontSize: '9px', fontFamily: 'JetBrains Mono', fontWeight: 600 } },
                            axisBorder: { show: false },
                            axisTicks: { show: false }
                        },
                        yaxis: { show: false, min: 0, max: this.slides[this.active].cardTotal },
                        grid: { show: false, padding: { top: 0, right: 0, bottom: 0, left: 10 } },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) { return val > 0 ? val : ''; },
                            style: { colors: ['#ffffff'], fontSize: '10px', fontFamily: 'JetBrains Mono', fontWeight: 700 },
                            offsetY: 0
                        },
                        tooltip: { enabled: false }
                    };
                    this.chartInstance = new ApexCharts(document.querySelector("#hero-mini-chart"), options);
                    this.chartInstance.render();
                },
                updateChart() {
                    if (this.chartInstance) {
                        this.chartInstance.updateOptions({
                            yaxis: { min: 0, max: this.slides[this.active].cardTotal, show: false }
                        }, false, false);
                        this.chartInstance.updateSeries([{
                            data: this.slides[this.active].chartData
                        }]);
                    }
                }
            }));
        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH D:\PASEBAN APP\resources\views/partials/home-hero.blade.php ENDPATH**/ ?>