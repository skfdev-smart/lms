<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    user: Object,
    stats: Object,
    recentCourses: Array,
    announcements: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <EducationalLayout>

        <!-- Header -->
        <div class="relative py-10 mb-8 overflow-hidden bg-[#151515]">
            <!-- Abstract Modern Background Design -->
            <div class="absolute inset-0 pointer-events-none">
                <!-- 1. Diagonal Red Stripes (Left & Right) -->
                <div class="absolute top-0 left-0 w-1/2 h-full overflow-hidden opacity-80">
                    <div class="w-[150%] h-full bg-[repeating-linear-gradient(45deg,#DA251D,#DA251D_10px,transparent_10px,transparent_20px)] transform -skew-x-12 -translate-x-10"></div>
                </div>
                <div class="absolute top-0 right-0 w-1/2 h-full overflow-hidden opacity-80">
                    <div class="w-[150%] h-full bg-[repeating-linear-gradient(-45deg,#DA251D,#DA251D_10px,transparent_10px,transparent_20px)] transform skew-x-12 translate-x-10"></div>
                </div>

                <!-- 2. Dark Overlays (Simulating Plates) -->
                <div class="absolute inset-x-0 top-0 h-10 bg-gradient-to-b from-[#0a0a0a] to-transparent z-10"></div>
                <div class="absolute inset-x-0 bottom-0 h-10 bg-gradient-to-t from-[#0a0a0a] to-transparent z-10"></div>
                
                <!-- 3. Central Shapes (Mechanical V-Shape) -->
                <div class="absolute inset-y-0 left-0 w-32 bg-[#151515] transform skew-x-12 origin-bottom-left border-r-4 border-[#DA251D] shadow-[0_0_15px_#DA251D] z-20"></div>
                <div class="absolute inset-y-0 right-0 w-32 bg-[#151515] transform -skew-x-12 origin-bottom-right border-l-4 border-[#DA251D] shadow-[0_0_15px_#DA251D] z-20"></div>

                <!-- 4. Center Main Plate -->
                <div class="absolute inset-0 mx-auto w-full bg-gradient-to-b from-[#222] to-[#111] transform skew-x-0 border-x-0 border-[#DA251D]/50 z-10 clip-path-center-plate">
                     <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,white_1px,transparent_1px)] bg-[size:10px_10px]"></div>
                     <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent"></div>
                </div>
                
                <!-- 5. Neon Glow Lines -->
                 <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#DA251D] shadow-[0_0_20px_#DA251D] z-30"></div>
            </div>

            <div class="container mx-auto px-4 relative z-30 text-center">
                <span class="inline-block py-1 px-3 rounded bg-red-900/30 text-[#ef4444] border border-[#d24444]/30 text-xs font-bold tracking-[0.3em] uppercase mb-2 backdrop-blur-sm">
                    Selamat Datang
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-white font-raleway uppercase tracking-tighter drop-shadow-lg">
                    {{ user.name }}! <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF512F] to-[#DA251D]">👋</span>
                </h1>
                <p class="text-gray-400 mt-2 font-sans text-sm md:text-base max-w-2xl mx-auto border-t border-gray-800/50 pt-2">
                    Lanjutkan perjalanan belajar Anda hari ini.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 pb-20">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6 flex items-center gap-4 dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-all">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-secondary dark:text-white">{{ stats.totalEnrolled }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Kursus Diikuti</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6 flex items-center gap-4 dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-all">
                    <div class="w-14 h-14 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-secondary dark:text-white">{{ stats.completedCourses }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Kursus Selesai</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6 flex items-center gap-4 dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-all">
                    <div class="w-14 h-14 bg-yellow-100 dark:bg-yellow-900/20 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-secondary dark:text-white">{{ stats.completedLessons }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Materi Selesai</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6 flex items-center gap-4 dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-all">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-secondary dark:text-white">{{ stats.quizzesPassed }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Quiz Lulus</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Courses -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-colors">
                        <div class="p-6 border-b border-gray-100 dark:border-white/10 flex items-center justify-between">
                            <h2 class="font-bold text-secondary dark:text-white font-raleway text-lg">Lanjutkan Belajar</h2>
                            <Link :href="route('my-learning')" class="text-primary text-sm font-semibold hover:underline">Lihat Semua →</Link>
                        </div>
                        <div v-if="recentCourses.length > 0" class="divide-y divide-gray-100 dark:divide-white/10">
                            <div v-for="course in recentCourses" :key="course.id" class="p-5 flex items-center gap-4 hover:bg-gray-50 dark:hover:bg-white/5 transition">
                                <img 
                                    :src="course.thumbnail ? '/storage/' + course.thumbnail : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&h=70&q=80'" 
                                    alt="Course"
                                    class="w-20 h-14 object-cover rounded-lg"
                                >
                                <div class="flex-1">
                                    <h3 class="font-semibold text-secondary dark:text-white mb-1 line-clamp-1">{{ course.title }}</h3>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mb-1">
                                        <div class="bg-primary h-1.5 rounded-full" :style="{ width: (course.lessons_count > 0 ? Math.round((course.completed_lessons_count / course.lessons_count) * 100) : 0) + '%' }"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ course.lessons_count > 0 ? Math.round((course.completed_lessons_count / course.lessons_count) * 100) : 0 }}% selesai</p>
                                </div>
                                <Link :href="route('course.show', course.id)" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary-hover transition">
                                    Lanjut
                                </Link>
                            </div>
                        </div>
                        <div v-else class="p-10 text-center text-gray-400">
                            <p>Belum ada kursus yang diikuti.</p>
                            <Link :href="route('catalog')" class="text-primary font-semibold hover:underline">Jelajahi Katalog →</Link>
                        </div>
                    </div>
                </div>

                <!-- Announcements / Quick Actions -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-6 dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-colors">
                        <h2 class="font-bold text-secondary dark:text-white font-raleway mb-4">Akses Cepat</h2>
                        <div class="space-y-3">
                            <Link :href="route('catalog')" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-white/5 dark:hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                                <span class="font-semibold text-secondary dark:text-white text-sm">Cari Kursus Baru</span>
                            </Link>
                            <Link :href="route('my-learning')" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-white/5 dark:hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700/50 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                </div>
                                <span class="font-semibold text-secondary dark:text-white text-sm">Kursus Saya</span>
                            </Link>
                            <Link :href="route('support')" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-white/5 dark:hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <span class="font-semibold text-secondary dark:text-white text-sm">Bantuan & FAQ</span>
                            </Link>
                        </div>
                    </div>

                    <!-- Announcements -->
                    <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-colors">
                        <div class="bg-gradient-to-r from-primary to-red-700 p-4 text-white">
                            <h2 class="font-bold font-raleway flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                                Pengumuman
                            </h2>
                        </div>
                        <div v-if="announcements && announcements.length > 0" class="divide-y divide-gray-100 dark:divide-white/10 max-h-64 overflow-y-auto">
                            <div v-for="ann in announcements" :key="ann.id" class="p-4">
                                <div class="flex items-start gap-2">
                                    <span 
                                        class="w-2 h-2 rounded-full mt-1.5 shrink-0"
                                        :class="{
                                            'bg-blue-500': ann.type === 'info',
                                            'bg-green-500': ann.type === 'success',
                                            'bg-yellow-500': ann.type === 'warning',
                                            'bg-red-500': ann.type === 'danger'
                                        }"
                                    ></span>
                                    <div>
                                        <h4 class="font-semibold text-secondary dark:text-white text-sm">{{ ann.title }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2" v-html="ann.content"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="p-6 text-center text-gray-400 text-sm">
                            <p>Tidak ada pengumuman saat ini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </EducationalLayout>
</template>

<style scoped>
.container {
    max-width: 1600px;
}
.clip-path-center-plate {
    clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
}
@media (min-width: 768px) {
    .clip-path-center-plate {
        clip-path: polygon(0 0, 100% 0, 90% 100%, 10% 100%);
    }
}
</style>
