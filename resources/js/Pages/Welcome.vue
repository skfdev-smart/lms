<script setup>
import { Head, Link } from '@inertiajs/vue3';
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { ref, onMounted, onUnmounted } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    qrCode: {
        type: String,
        default: null,
    },
    qrCodeUrl: {
        type: String,
        default: null,
    },
});

// Mouse Parallax Logic
const mouseX = ref(0);
const mouseY = ref(0);

const handleMouseMove = (event) => {
    // Normalize mouse position (-1 to 1)
    mouseX.value = (event.clientX / window.innerWidth) * 2 - 1;
    mouseY.value = (event.clientY / window.innerHeight) * 2 - 1;
};
</script>

<template>
    <Head title="Welcome to Future Learning" />
    
    <EducationalLayout>
        <!-- Hero Section -->
        <section 
            class="relative min-h-screen flex items-center justify-center overflow-hidden bg-white dark:bg-[#0a0a0a] transition-colors duration-300"
            @mousemove="handleMouseMove"
        >
            
            <!-- Cyber Grid Background (Dark Mode Only) -->
            <div class="absolute inset-0 overflow-hidden perspective-grid opacity-0 dark:opacity-100 transition-opacity duration-1000">
                <div class="grid-plane"></div>
                <div class="grid-plane-overlay"></div>
            </div>

            <!-- Light Mode Interactive Background -->
            <div class="absolute inset-0 z-0 opacity-100 dark:opacity-0 transition-opacity duration-500 pointer-events-none overflow-hidden">
                <!-- Abstract Geometric Shapes with Parallax -->
                <!-- Big Hexagon Top Right -->
                <div 
                    class="absolute top-10 right-0 w-[500px] h-[500px] bg-gradient-to-br from-gray-200 to-gray-100 rounded-full blur-3xl opacity-60 transition-transform duration-100 ease-out"
                    :style="{ transform: `translate(${mouseX * -60}px, ${mouseY * -60}px)` }"
                ></div>
                
                <!-- Circuit Pattern Overlay -->
                <div class="absolute inset-0 opacity-[0.05]" 
                     style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 40px 40px;">
                </div>

                <!-- Interactive Shapes -->
                <div 
                    class="absolute top-1/4 left-10 w-64 h-64 border-2 border-gray-200 rounded-full opacity-60"
                    :style="{ transform: `translate(${mouseX * 50}px, ${mouseY * 50}px)` }"
                ></div>
                 <div 
                    class="absolute bottom-1/3 right-20 w-96 h-96 border-2 border-gray-200 rounded-full opacity-50"
                    :style="{ transform: `translate(${mouseX * 80}px, ${mouseY * 80}px)` }"
                ></div>
                
                <!-- Floating Tech Hexagons (SVG) -->
                <div class="absolute top-0 right-0 w-full h-full">
                     <!-- Hex 1 -->
                    <svg class="absolute top-[15%] right-[10%] w-24 h-24 text-gray-300 opacity-100" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2"
                        :style="{ transform: `translate(${mouseX * -80}px, ${mouseY * -80}px) rotate(15deg)` }">
                        <path d="M50 0 L93.3 25 L93.3 75 L50 100 L6.7 75 L6.7 25 Z" vector-effect="non-scaling-stroke"/>
                    </svg>
                    <!-- Hex 2 -->
                     <svg class="absolute bottom-[20%] left-[5%] w-32 h-32 text-gray-300 opacity-90" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2"
                        :style="{ transform: `translate(${mouseX * -40}px, ${mouseY * -40}px) rotate(-10deg)` }">
                        <path d="M50 0 L93.3 25 L93.3 75 L50 100 L6.7 75 L6.7 25 Z" vector-effect="non-scaling-stroke"/>
                    </svg>
                     <!-- Connection Lines -->
                     <svg class="absolute inset-0 w-full h-full pointer-events-none" style="opacity: 0.3">
                        <path d="M100,200 Q400,100 800,300" stroke="#DA251D" stroke-width="1" fill="none" class="animate-pulse" />
                     </svg>
                </div>

                <!-- Dynamic Spotlight (Follows Mouse) -->
                 <div 
                    class="absolute w-[600px] h-[600px] bg-gradient-to-r from-primary/10 to-transparent rounded-full blur-[80px] transition-transform duration-75 ease-out -z-10"
                     :style="{ 
                        top: '50%', 
                        left: '50%', 
                        transform: `translate(calc(-50% + ${mouseX * 300}px), calc(-50% + ${mouseY * 300}px))` 
                    }"
                ></div>
            </div>

            <!-- Floating Particles (Dark Mode Only) -->
            <div class="absolute inset-0 pointer-events-none opacity-0 dark:opacity-100 transition-opacity duration-300">
                <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-primary rounded-full animate-float opacity-70"></div>
                <div class="absolute top-3/4 right-1/3 w-3 h-3 bg-white rounded-full animate-float animation-delay-2000 opacity-50"></div>
                <div class="absolute bottom-1/4 left-2/3 w-1 h-1 bg-red-500 rounded-full animate-float animation-delay-4000 opacity-80"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 container mx-auto px-4 text-center">
                <!-- Glitch Badge -->
                <div class="inline-block mb-6 px-4 py-1 rounded-full border border-primary/30 bg-primary/10 backdrop-blur-sm dark:animate-pulse-glow">
                    <span class="text-primary text-xs font-bold tracking-[0.2em] uppercase">System Online v2.0</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-black text-gray-900 dark:text-white font-raleway mb-8 leading-tight tracking-tight transition-colors duration-300">
                    EMPOWERING <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-red-500 to-primary animate-text-shimmer bg-[200%_auto]">SPINDO</span><br>
                    <span class="text-gray-500 dark:text-gray-500 text-3xl md:text-5xl font-light">EXCELLENCE TOGETHER</span>
                </h1>
                
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto font-sans leading-relaxed border-l-2 border-primary pl-6 text-left md:text-center md:border-l-0 md:pl-0 transition-colors duration-300">
                    Advanced Learning Management System. <br class="hidden md:block">
                    Accelerating workforce capability through digital transformation.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <Link 
                        v-if="!$page.props.auth.user"
                        :href="route('register')" 
                        class="group relative px-8 py-4 bg-primary text-white font-bold text-lg tracking-wider overflow-hidden clip-path-slant transition-transform hover:scale-105 shadow-lg dark:shadow-none"
                    >
                        <div class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full transition-transform duration-500 group-hover:translate-x-full"></div>
                        <span class="relative">INITIALIZE ACCESS</span>
                    </Link>
                    <Link 
                        v-else
                        :href="route('dashboard')" 
                        class="group relative px-8 py-4 bg-transparent border border-gray-300 dark:border-white/20 text-gray-800 dark:text-white font-bold text-lg tracking-wider overflow-hidden clip-path-slant hover:bg-gray-50 dark:hover:bg-white/5 transition-all hover:border-primary/50"
                    >
                        <span class="relative flex items-center gap-2">
                            CONTINUE LEARNING
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </span>
                    </Link>
                </div>

                <!-- QR Code Section -->
                <div v-if="qrCode" class="mt-12 flex flex-col items-center animate-fade-in-up" style="animation-delay: 0.5s;">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary to-red-600 rounded-xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                        <div class="relative bg-white dark:bg-gray-900 p-4 rounded-xl shadow-2xl border border-gray-100 dark:border-white/10">
                            <div class="mb-3 text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] text-center border-b border-gray-100 dark:border-gray-800 pb-2">Scan to Access</div>
                            <div v-html="qrCode" class="text-gray-900 dark:text-gray-200 [&>svg]:w-32 [&>svg]:h-32"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Fade (Dark Mode Only) -->
            <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-[#0a0a0a] to-transparent z-10 hidden dark:block"></div>
        </section>

        <!-- Tech Features Section -->
        <section class="py-24 bg-gray-50 dark:bg-[#0a0a0a] relative transition-colors duration-300">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-primary/5 skewed-bg pointer-events-none opacity-0 dark:opacity-100 transition-opacity"></div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="group relative bg-white dark:bg-gray-900/50 backdrop-blur-sm border border-gray-200 dark:border-white/5 p-8 hover:border-primary/50 transition duration-500 overflow-hidden shadow-lg dark:shadow-none rounded-sm">
                        <div class="absolute top-0 left-0 w-1 h-0 bg-primary transition-all duration-300 group-hover:h-full"></div>
                        <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded flex items-center justify-center mb-6 text-primary group-hover:text-white group-hover:bg-primary transition duration-300">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-raleway tracking-wide">ZERO LATENCY</h3>
                        <p class="text-gray-600 dark:text-gray-500 text-sm leading-relaxed group-hover:text-gray-800 dark:group-hover:text-gray-300 transition-colors">
                            Instant access to learning materials. Optimized for high-speed performance across all devices.
                        </p>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="group relative bg-white dark:bg-gray-900/50 backdrop-blur-sm border border-gray-200 dark:border-white/5 p-8 hover:border-primary/50 transition duration-500 overflow-hidden shadow-lg dark:shadow-none rounded-sm">
                        <div class="absolute top-0 left-0 w-1 h-0 bg-primary transition-all duration-300 group-hover:h-full"></div>
                        <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded flex items-center justify-center mb-6 text-primary group-hover:text-white group-hover:bg-primary transition duration-300">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-raleway tracking-wide">CERTIFIED MASTERY</h3>
                        <p class="text-gray-600 dark:text-gray-500 text-sm leading-relaxed group-hover:text-gray-800 dark:group-hover:text-gray-300 transition-colors">
                            Automated certification protocols upon successful completion of module assessments.
                        </p>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="group relative bg-white dark:bg-gray-900/50 backdrop-blur-sm border border-gray-200 dark:border-white/5 p-8 hover:border-primary/50 transition duration-500 overflow-hidden shadow-lg dark:shadow-none rounded-sm">
                        <div class="absolute top-0 left-0 w-1 h-0 bg-primary transition-all duration-300 group-hover:h-full"></div>
                        <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded flex items-center justify-center mb-6 text-primary group-hover:text-white group-hover:bg-primary transition duration-300">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-raleway tracking-wide">ACCELERATED GROWTH</h3>
                        <p class="text-gray-600 dark:text-gray-500 text-sm leading-relaxed group-hover:text-gray-800 dark:group-hover:text-gray-300 transition-colors">
                            Rapid skill acquisition through streamlined, interactive course modules.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Course Hologram Section -->
        <section class="py-24 bg-white dark:bg-[#050505] relative overflow-hidden transition-colors duration-300">
             <!-- Background Elements -->
             <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-primary/5 dark:bg-primary/10 filter blur-[100px] rounded-full pointer-events-none"></div>

            <div class="container mx-auto px-4 text-center relative z-10">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white font-raleway mb-16 uppercase tracking-[0.2em]">
                    <span class="border-b-2 border-primary pb-2">Top Programs</span>
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                     <!-- Course Card 1 -->
                     <div v-for="i in 3" :key="i" class="group bg-white dark:bg-gray-900 border border-gray-100 dark:border-white/10 overflow-hidden hover:border-primary/50 transition-all duration-500 hover:shadow-xl dark:hover:shadow-[0_0_30px_rgba(218,37,29,0.15)] rounded-sm">
                        <div class="relative h-48 overflow-hidden">
                            <div class="absolute inset-0 bg-primary/20 mix-blend-overlay z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <img 
                                src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80" 
                                class="w-full h-full object-cover dark:grayscale group-hover:grayscale-0 transition-all duration-700 transform group-hover:scale-110"
                                alt="Course"
                            />
                            <div class="absolute top-0 right-0 bg-primary/90 text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest clip-path-badge">Core</div>
                        </div>
                        <div class="p-6 text-left relative">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 font-raleway group-hover:text-primary transition-colors">INDUSTRIAL SAFETY PROTOCOLS</h3>
                            <p class="text-xs text-gray-500 mb-4 font-mono">MODULE_ID: 0X{{ i }}24B</p>
                            
                            <div class="flex items-center justify-between border-t border-gray-100 dark:border-white/5 pt-4 mt-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Level: Beginner</span>
                                <Link :href="route('dashboard')" class="text-xs font-bold text-primary hover:text-red-600 dark:hover:text-white transition-colors flex items-center gap-1 group-link">
                                    ACCESS
                                    <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </Link>
                            </div>
                        </div>
                     </div>
                </div>

                <div class="mt-20">
                     <Link :href="route('dashboard')" class="inline-flex items-center space-x-2 text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors border border-gray-300 dark:border-white/10 px-6 py-3 rounded hover:border-gray-400 dark:hover:border-white/30 text-xs tracking-[0.2em] font-bold uppercase">
                        <span>View Full Catalog</span>
                     </Link>
                </div>
            </div>
        </section>
    </EducationalLayout>
</template>

<style scoped>
/* Perspective Grid Animation */
.perspective-grid {
    perspective: 500px;
    background: #0a0a0a;
}

.grid-plane {
    position: absolute;
    top: 50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background-image: 
        linear-gradient(rgba(218, 37, 29, 0.3) 1px, transparent 1px),
        linear-gradient(90deg, rgba(218, 37, 29, 0.3) 1px, transparent 1px);
    background-size: 40px 40px;
    transform: rotateX(80deg) translateY(-100px);
    transform-origin: 50% 0;
    animation: grid-flow 1s linear infinite;
    mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 60%);
}

@keyframes grid-flow {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 0 40px;
    }
}

.clip-path-slant {
    clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%);
}

.clip-path-badge {
    clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
}

.skewed-bg {
    transform: skewX(-20deg);
    transform-origin: top;
}
</style>
