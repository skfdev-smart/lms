<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ThemeToggle from '@/Components/ThemeToggle.vue';

const isScrolled = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const page = usePage();
</script>

<template>
    <div class="min-h-screen font-sans transition-colors duration-300 dark:bg-[#0a0a0a] bg-gray-50 text-gray-800 dark:text-gray-200 selection:bg-primary selection:text-white">
        <!-- Header -->
        <header 
            :class="[
                'fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4 print:hidden backdrop-blur-sm',
                isScrolled 
                    ? 'dark:bg-[#0a0a0a]/90 bg-white/90 shadow-md dark:shadow-[0_4px_30px_rgba(0,0,0,0.5)] border-b dark:border-white/5 border-gray-200 py-3' 
                    : 'bg-transparent'
            ]"
        >
            <!-- Background Decorations Wrapper (Clipped) -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
                <!-- Processor Network Motif (Left) -->
                <div class="absolute top-0 left-0 h-full w-80 opacity-90 dark:opacity-80 hidden md:block">
                    <svg viewBox="0 0 300 100" class="h-full w-full" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="fiberGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#DA251D" stop-opacity="0" />
                                <stop offset="50%" stop-color="#DA251D" />
                                <stop offset="100%" stop-color="#DA251D" stop-opacity="0" />
                            </linearGradient>
                        </defs>

                        <!-- Circuit Lines (Base) -->
                        <path d="M0,20 L50,20 L70,40 L120,40" fill="none" class="stroke-gray-300 dark:stroke-gray-700" stroke-width="2" />
                        <path d="M0,80 L30,80 L50,60 L100,60" fill="none" class="stroke-gray-300 dark:stroke-gray-700" stroke-width="2" />
                        <path d="M40,0 L40,15" fill="none" class="stroke-gray-300 dark:stroke-gray-700" stroke-width="2" />
                        
                        <!-- Fiber Optic Flow Animation -->
                        <path d="M0,20 L50,20 L70,40 L120,40" fill="none" class="stroke-primary filter drop-shadow-[0_0_5px_rgba(218,37,29,1)]" stroke-width="3" stroke-dasharray="40 120" stroke-linecap="round">
                             <animate attributeName="stroke-dashoffset" from="160" to="0" dur="1.5s" repeatCount="indefinite" />
                        </path>
                        <path d="M0,80 L30,80 L50,60 L100,60" fill="none" class="stroke-primary filter drop-shadow-[0_0_5px_rgba(218,37,29,1)]" stroke-width="3" stroke-dasharray="30 100" stroke-linecap="round">
                             <animate attributeName="stroke-dashoffset" from="130" to="0" dur="2s" repeatCount="indefinite" />
                        </path>

                        <!-- Nodes -->
                        <circle cx="50" cy="20" r="4" class="fill-primary animate-pulse" />
                        <circle cx="120" cy="40" r="5" class="fill-primary" />
                        <circle cx="50" cy="60" r="4" class="fill-primary" />
                        
                        <!-- Hexagon/Tech Shape -->
                        <path d="M150,10 L170,10 L180,25 L170,40 L150,40 L140,25 Z" fill="none" class="stroke-gray-400 dark:stroke-gray-600" stroke-width="1.5" opacity="0.6" />
                        <circle cx="160" cy="25" r="5" class="fill-primary/20" />
                    </svg>
                </div>

                <!-- Processor Network Motif (Right) -->
                <div class="absolute top-0 right-0 h-full w-80 opacity-90 dark:opacity-80 hidden md:block transform scale-x-[-1]">
                    <svg viewBox="0 0 300 100" class="h-full w-full" preserveAspectRatio="none">
                        <!-- Circuit Lines (Base) -->
                        <path d="M0,30 L60,30 L80,50 L140,50" fill="none" class="stroke-gray-300 dark:stroke-gray-700" stroke-width="2" />
                        <path d="M0,70 L40,70 L50,60 L90,60" fill="none" class="stroke-gray-300 dark:stroke-gray-700" stroke-width="2" />
                        
                        <!-- Fiber Optic Flow Animation -->
                        <path d="M0,30 L60,30 L80,50 L140,50" fill="none" class="stroke-primary filter drop-shadow-[0_0_5px_rgba(218,37,29,1)]" stroke-width="3" stroke-dasharray="40 120" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="180" to="0" dur="1.8s" repeatCount="indefinite" />
                        </path>
                         <path d="M0,70 L40,70 L50,60 L90,60" fill="none" class="stroke-primary filter drop-shadow-[0_0_5px_rgba(218,37,29,1)]" stroke-width="3" stroke-dasharray="40 100" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="130" to="0" dur="1.6s" repeatCount="indefinite" />
                        </path>
                        
                        <!-- Nodes -->
                        <circle cx="60" cy="30" r="4" class="fill-primary" />
                        <circle cx="140" cy="50" r="5" class="fill-primary animate-pulse" />
                        <circle cx="90" cy="60" r="4" class="fill-primary" />
                        
                        <!-- Tech Shape -->
                        <path d="M160,50 L180,50 L190,65 L180,80 L160,80 L150,65 Z" fill="none" class="stroke-gray-400 dark:stroke-gray-600" stroke-width="1.5" opacity="0.6" />
                    </svg>
                </div>

                <!-- Fiber Optic Bottom Line Animation -->
                <div class="absolute bottom-0 left-0 w-full h-[3px] z-50 overflow-hidden">
                    <!-- Base Line -->
                    <div class="absolute inset-0 bg-gray-200 dark:bg-white/10"> </div>
                    <!-- Moving Light Packet (Red Fiber Optic) -->
                    <div class="absolute inset-0 w-1/2 bg-gradient-to-r from-transparent via-[#DA251D] to-transparent opacity-100 blur-[2px] animate-[slide-right_3s_linear_infinite]" style="will-change: transform;"></div>
                    <!-- Second Packet (Delayed/Faster) -->
                    <div class="absolute inset-0 w-1/3 bg-gradient-to-r from-transparent via-[#DA251D]/80 to-transparent opacity-80 blur-[2px] animate-[slide-right_4s_linear_infinite_1s]" style="will-change: transform;"></div>
                </div>
            </div>

            <div class="container mx-auto px-4 md:px-6 flex items-center justify-between relative z-10">
                <!-- Logo -->
                <Link href="/" class="flex items-center space-x-2 group">
                    <img src="/logo.png" alt="SPINDO LMS" class="h-12 w-auto object-contain transition-transform group-hover:scale-105 dark:drop-shadow-[0_0_10px_rgba(255,255,255,0.2)] rounded-lg" />
                </Link>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <Link href="/" class="text-sm font-bold tracking-widest uppercase transition-all hover:text-primary relative group" :class="route().current('home') ? 'text-primary' : 'dark:text-gray-300 text-gray-600'">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </Link>
                    <Link :href="route('catalog')" class="text-sm font-bold tracking-widest uppercase transition-all hover:text-primary relative group" :class="route().current('catalog') ? 'text-primary' : 'dark:text-gray-300 text-gray-600'">
                        Catalog
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </Link>
                    <Link :href="route('my-learning')" class="text-sm font-bold tracking-widest uppercase transition-all hover:text-primary relative group" :class="route().current('my-learning') ? 'text-primary' : 'dark:text-gray-300 text-gray-600'">
                        My Learning
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </Link>
                    <Link :href="route('support')" class="text-sm font-bold tracking-widest uppercase transition-all hover:text-primary relative group" :class="route().current('support') ? 'text-primary' : 'dark:text-gray-300 text-gray-600'">
                        Support
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </Link>
                    <Link href="/admin" v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" class="text-sm font-bold tracking-widest uppercase text-red-600 hover:text-red-500 relative group animate-pulse">
                        Admin
                    </Link>
                </nav>

                <!-- Auth / CTA -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle -->
                    <ThemeToggle />

                    <template v-if="!$page.props.auth.user">
                        <Link :href="route('login')" class="text-sm font-bold uppercase tracking-wider dark:text-white text-gray-700 hover:text-primary transition">Log in</Link>
                        <Link :href="route('register')" class="relative overflow-hidden bg-primary text-white text-xs font-bold uppercase tracking-widest px-6 py-2 rounded clip-path-slant hover:bg-red-600 transition shadow-lg dark:shadow-[0_0_15px_rgba(218,37,29,0.4)] group">
                            <span class="relative z-10">Get Started</span>
                        </Link>
                    </template>
                    <template v-else>
                        <!-- User Dropdown -->
                        <div class="relative ms-3">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="group flex items-center space-x-3 text-sm focus:outline-none transition-all duration-200 ease-in-out px-2 py-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-white/10 border border-transparent hover:border-gray-200 dark:hover:border-white/20"
                                        >
                                            <div class="relative">
                                                <img 
                                                    class="h-9 w-9 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 group-hover:border-primary transition" 
                                                    :src="$page.props.auth.user.profile_photo_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent($page.props.auth.user.name) + '&color=DA251D&background=fca5a5'" 
                                                    :alt="$page.props.auth.user.name" 
                                                />
                                                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white dark:ring-[#0a0a0a]"></span>
                                            </div>
                                            
                                            <div class="hidden text-left md:block">
                                                <p class="font-bold text-gray-700 dark:text-gray-200 group-hover:text-primary transition text-xs uppercase tracking-wide">
                                                    {{ $page.props.auth.user.name }}
                                                </p>
                                                <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                    {{ $page.props.auth.user.role || 'Member' }}
                                                </p>
                                            </div>

                                            <svg
                                                class="ms-2 h-4 w-4 text-gray-400 group-hover:text-primary transition"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('dashboard')">
                                        Dashboard
                                    </DropdownLink>
                                    <DropdownLink :href="route('certificates.index')">
                                        My Certificates
                                    </DropdownLink>
                                    <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Fiber Optic Bottom Line Animation -->
            <div class="absolute bottom-0 left-0 w-full h-[3px] z-50 overflow-hidden">
                <!-- Base Line -->
                <div class="absolute inset-0 bg-gray-200 dark:bg-white/10 h-[1px] top-1"></div>
                <!-- Moving Light Packet (Red Fiber Optic) -->
                <div class="absolute inset-0 w-1/2 bg-gradient-to-r from-transparent via-[#DA251D] to-transparent opacity-100 blur-[2px] animate-[slide-right_3s_linear_infinite]" style="will-change: transform;"></div>
                <!-- Second Packet (Delayed/Faster) -->
                <div class="absolute inset-0 w-1/3 bg-gradient-to-r from-transparent via-[#DA251D]/80 to-transparent opacity-80 blur-[2px] animate-[slide-right_4s_linear_infinite_1s]" style="will-change: transform;"></div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="pt-20 print:pt-0 min-h-screen relative">
            <!-- Background Grid Effect (Dark Mode Only) -->
            <div class="fixed inset-0 z-0 pointer-events-none opacity-20 hidden dark:block" 
                 style="background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 30px 30px;">
            </div>
            
            <!-- Light Mode Professional Background -->
             <div class="fixed inset-0 z-0 pointer-events-none dark:hidden">
                <!-- Background Image -->
                <img 
                    src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                    alt="Professional Background" 
                    class="absolute inset-0 w-full h-full object-cover"
                />
                <!-- White Overlay for Readability -->
                <div class="absolute inset-0 bg-white/90 backdrop-blur-[1px]"></div>
                <!-- Subtle Grid on Top -->
                <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
            </div>

            <div class="relative z-10">
                <slot />
            </div>
        </main>

        <!-- Footer -->
        <footer class="dark:bg-[#050505] bg-white border-t dark:border-white/10 border-gray-200 mt-20 print:hidden relative z-10 transition-colors duration-300">
            <div class="container mx-auto px-4 md:px-6 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-1">
                        <img src="/logo.png" alt="SPINDO LMS" class="h-8 w-auto mb-4 object-contain opacity-80" />
                        <p class="mt-4 dark:text-gray-500 text-gray-600 text-sm leading-relaxed font-mono">
                            PT. Steel Pipe Industry of Indonesia, Tbk.<br>
                            Engineered for Excellence.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-bold dark:text-white text-gray-900 mb-4 uppercase text-xs tracking-[0.2em] text-primary">Quick Links</h4>
                        <ul class="space-y-2 text-sm dark:text-gray-500 text-gray-600 font-mono">
                            <li><Link href="/" class="hover:text-primary transition duration-300 hover:translate-x-1 block">Home</Link></li>
                            <li><a href="https://www.spindo.com/" target="_blank" class="hover:text-primary transition duration-300 hover:translate-x-1 block">Corporate Website</a></li>
                            <li><Link href="#" class="hover:text-primary transition duration-300 hover:translate-x-1 block">Internal Portal</Link></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold dark:text-white text-gray-900 mb-4 uppercase text-xs tracking-[0.2em] text-primary">Programs</h4>
                        <ul class="space-y-2 text-sm dark:text-gray-500 text-gray-600 font-mono">
                            <li><Link href="#" class="hover:text-primary transition duration-300 hover:translate-x-1 block">Safety (K3)</Link></li>
                            <li><Link href="#" class="hover:text-primary transition duration-300 hover:translate-x-1 block">Technical Skills</Link></li>
                            <li><Link href="#" class="hover:text-primary transition duration-300 hover:translate-x-1 block">Management</Link></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold dark:text-white text-gray-900 mb-4 uppercase text-xs tracking-[0.2em] text-primary">HQ Contact</h4>
                        <p class="text-sm dark:text-gray-500 text-gray-600 font-mono leading-relaxed">
                            Gd. Baja, Lt. 7B <br>
                            Jl. Pangeran Jayakarta No. 55 <br>
                            Jakarta 10730 <br><br>
                            <span class="text-gray-400">P:</span> (021) 6231 3502<br>
                            <span class="text-gray-400">E:</span> info@spindo.com
                        </p>
                    </div>
                </div>
            </div>
            <div class="dark:bg-black bg-gray-50 py-6 border-t dark:border-white/5 border-gray-200 text-center text-xs dark:text-gray-600 text-gray-500 font-mono tracking-wider">
                &copy; {{ new Date().getFullYear() }} <span class="dark:text-gray-400 text-gray-700 font-bold">PT. SPINDO</span> // SYSTEM_READY
            </div>
        </footer>
    </div>
</template>

<style scoped>
.container {
    max-width: 1200px;
}
</style>
