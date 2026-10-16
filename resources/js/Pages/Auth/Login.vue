<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const showPassword = ref(false);
const isLoaded = ref(false);
const cardRef = ref(null);
const cardRotation = ref({ x: 0, y: 0 });

onMounted(() => {
    setTimeout(() => {
        isLoaded.value = true;
    }, 100);
});

// 3D Tilt Logic
const handleMouseMove = (e) => {
    if (!cardRef.value) return;
    
    const rect = cardRef.value.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    
    const rotateX = ((y - centerY) / centerY) * -5; // Max -5 to 5 deg
    const rotateY = ((x - centerX) / centerX) * 5;  // Max -5 to 5 deg
    
    cardRotation.value = { x: rotateX, y: rotateY };
};

const handleMouseLeave = () => {
    cardRotation.value = { x: 0, y: 0 };
};

const cardStyle = computed(() => ({
    transform: `perspective(1000px) rotateX(${cardRotation.value.x}deg) rotateY(${cardRotation.value.y}deg)`,
    transition: 'transform 0.1s ease-out'
}));

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Masuk - SPINDO LMS" />

    <div class="min-h-screen flex relative overflow-hidden bg-gray-900 font-sans" @mousemove="handleMouseMove" @mouseleave="handleMouseLeave">
        <!-- Dynamic Animated Background -->
        <div class="absolute inset-0 bg-gradient-animate opacity-40"></div>
        <div class="absolute inset-0 bg-[url('/img/grid.svg')] opacity-10 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        
        <!-- Orbs -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2 animate-blob animation-delay-2000"></div>

        <!-- Left Hero Section -->
        <div class="hidden lg:flex lg:w-1/2 relative z-10 flex-col justify-center items-center text-center px-12">
            <div 
                class="transition-all duration-1000 ease-out"
                :class="isLoaded ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10'"
            >
                <!-- Centered Logo -->
                <div class="flex justify-center mb-8">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-primary/50 rounded-full blur-3xl animate-pulse-slow group-hover:bg-primary/70 transition-colors duration-500"></div>
                        <img src="/logo.png" alt="SPINDO" 
                            class="h-28 w-auto relative z-10 transition-transform duration-500 transform group-hover:scale-110 rounded-2xl"
                            style="filter: brightness(1.1) contrast(1.05) drop-shadow(0 10px 30px rgba(218, 37, 29, 0.5));" 
                        />
                    </div>
                </div>
                
                <h1 class="text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-200 to-gray-400 mb-6 font-raleway tracking-tight leading-tight">
                    SPINDO<br/>
                    <span class="text-primary learning-text relative">
                        Learning
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-primary opacity-60" viewBox="0 0 100 10" preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="3" fill="none" />
                        </svg>
                    </span>
                </h1>
                
                <p class="text-gray-300 text-xl max-w-lg mx-auto leading-relaxed font-light mb-12">
                    Platform pengembangan kompetensi kelas dunia untuk <span class="text-white font-semibold">Masa Depan Industri Baja Indonesia</span>.
                </p>
                
                <!-- Animated Stats -->
                <div class="grid grid-cols-3 gap-8 border-t border-white/10 pt-8 max-w-lg mx-auto">
                    <div class="stat-card backdrop-blur-sm bg-white/5 p-4 rounded-2xl border border-white/10 hover:border-primary/50 transition-colors duration-300 group">
                        <p class="text-3xl font-bold text-white mb-1 group-hover:scale-110 transition-transform">500+</p>
                        <p class="text-gray-400 text-xs uppercase tracking-wider">Karyawan</p>
                    </div>
                    <div class="stat-card backdrop-blur-sm bg-white/5 p-4 rounded-2xl border border-white/10 hover:border-primary/50 transition-colors duration-300 group">
                        <p class="text-3xl font-bold text-white mb-1 group-hover:scale-110 transition-transform">50+</p>
                        <p class="text-gray-400 text-xs uppercase tracking-wider">Modul</p>
                    </div>
                    <div class="stat-card backdrop-blur-sm bg-white/5 p-4 rounded-2xl border border-white/10 hover:border-primary/50 transition-colors duration-300 group">
                        <p class="text-3xl font-bold text-white mb-1 group-hover:scale-110 transition-transform">24/7</p>
                        <p class="text-gray-400 text-xs uppercase tracking-wider">Akses</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Form Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 relative z-10">
            <!-- Back to Home -->
            <div class="absolute top-8 right-8 z-30">
                <Link :href="route('home')" class="flex items-center gap-2 text-white/50 hover:text-white transition-all duration-300 group bg-white/5 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 hover:border-white/30 hover:bg-white/10 hover:scale-105">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    <span class="text-sm font-medium tracking-wide">Beranda</span>
                </Link>
            </div>

            <!-- 3D Interactive Card -->
            <div 
                ref="cardRef"
                class="w-full max-w-md relative transition-all duration-1000 delay-200"
                :class="isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-20'"
                :style="cardStyle"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-primary to-orange-600 rounded-3xl blur-2xl opacity-20 -z-10 transform translate-y-10 scale-90"></div>
                
                <div class="backdrop-blur-xl bg-gray-900/60 rounded-3xl shadow-2xl border border-white/10 p-10 relative overflow-hidden group hover:border-white/20 transition-colors duration-500">
                    <!-- Glass Shine Effect -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>

                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold text-white mb-2 font-raleway">Selamat Datang</h2>
                        <p class="text-gray-400">Masuk untuk melanjutkan pembelajaran</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300 ml-1">Email Perusahaan</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 group-focus-within/input:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                                </div>
                                <input 
                                    v-model="form.email"
                                    type="email" 
                                    class="w-full bg-black/20 border border-white/10 rounded-xl py-4 pl-12 pr-4 text-white placeholder-gray-600 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-300 hover:bg-black/30"
                                    placeholder="nama@spindo.com"
                                    required
                                />
                            </div>
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300 ml-1">Password</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 group-focus-within/input:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                                <input 
                                    v-model="form.password"
                                    :type="showPassword ? 'text' : 'password'" 
                                    class="w-full bg-black/20 border border-white/10 rounded-xl py-4 pl-12 pr-12 text-white placeholder-gray-600 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-300 hover:bg-black/30"
                                    placeholder="••••••••"
                                    required
                                />
                                <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors">
                                    <svg v-if="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center cursor-pointer group">
                                <Checkbox name="remember" v-model:checked="form.remember" class="bg-white/10 border-white/20 text-primary focus:ring-offset-gray-900 rounded" />
                                <span class="ms-2 text-sm text-gray-400 group-hover:text-white transition-colors">Ingat saya</span>
                            </label>
                            <Link :href="route('password.request')" class="text-sm text-primary hover:text-red-400 transition-colors">Lupa Password?</Link>
                        </div>

                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="w-full bg-gradient-to-r from-primary to-red-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/25 hover:shadow-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 relative overflow-hidden group"
                        >
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 skew-x-12"></div>
                            <span class="relative flex items-center justify-center gap-2">
                                <svg v-if="form.processing" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                {{ form.processing ? 'Memproses...' : 'Masuk Sekarang' }}
                                <svg v-if="!form.processing" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </span>
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-gray-500 text-sm">
                            Belum punya akun?
                            <Link :href="route('register')" class="text-white hover:text-primary font-bold transition-colors ml-1">Daftar disini</Link>
                        </p>
                    </div>
                </div>
                
                <p class="text-center text-gray-500 text-xs mt-8 opacity-60">© {{ new Date().getFullYear() }} All Rights Reserved</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.font-raleway { font-family: 'Raleway', sans-serif; }

.bg-gradient-animate {
    background: linear-gradient(-45deg, #111827, #1f2937, #0f172a, #374151);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.animate-blob {
    animation: blob 10s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.perspective-1000 {
    perspective: 1000px;
}
</style>
