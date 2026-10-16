<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    certificates: Array,
});
</script>

<template>
    <Head title="My Certificates" />

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
                    Achievements
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-white font-raleway uppercase tracking-tighter drop-shadow-lg">
                    My <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF512F] to-[#DA251D]">Certificates</span>
                </h1>
                <p class="text-gray-400 mt-2 font-sans text-sm md:text-base max-w-2xl mx-auto border-t border-gray-800/50 pt-2">
                    Your achievements and course completions.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 pb-20">
            <div v-if="certificates.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="cert in certificates" :key="cert.id" class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden hover:shadow-lg dark:hover:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-all group">
                    <!-- Certificate Preview -->
                    <div class="bg-gradient-to-br from-primary to-red-900 p-6 text-white relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                <span class="text-xs font-bold uppercase tracking-wider opacity-80">Certificate</span>
                            </div>
                            <h3 class="text-lg font-bold font-raleway line-clamp-1">{{ cert.course.title }}</h3>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <span>{{ cert.certificate_number }}</span>
                            <span>{{ new Date(cert.issued_at).toLocaleDateString('id-ID') }}</span>
                        </div>
                        
                        <div v-if="cert.quiz_attempt" class="flex items-center gap-2 mb-4 text-sm">
                            <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-2 py-1 rounded font-bold border border-transparent dark:border-green-500/30">Score: {{ cert.quiz_attempt.score }}%</span>
                        </div>
                        
                        <Link 
                            :href="route('certificate.show', cert.id)" 
                            class="block w-full text-center bg-secondary text-white py-2.5 rounded-lg font-bold uppercase text-xs hover:bg-black transition"
                        >
                            View Certificate
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-20 bg-white dark:bg-[#111] rounded-xl border border-dashed border-gray-200 dark:border-white/10">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">No certificates yet</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">Complete courses and pass quizzes to earn your certificates.</p>
                <Link :href="route('catalog')" class="bg-primary text-white px-6 py-2.5 rounded-full font-bold hover:bg-primary-hover transition">
                    Browse Courses
                </Link>
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
