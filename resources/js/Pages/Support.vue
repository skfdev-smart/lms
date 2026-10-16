<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Support" />

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
                    Help & Resources
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-white font-raleway uppercase tracking-tighter drop-shadow-lg">
                    Support <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF512F] to-[#DA251D]">Center</span>
                </h1>
                <p class="text-gray-400 mt-2 font-sans text-sm md:text-base max-w-2xl mx-auto border-t border-gray-800/50 pt-2">
                    Need help? We are here to assist you with any technical or course-related issues.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <!-- Contact Info -->
                <div class="bg-white dark:bg-[#111] p-8 rounded-lg shadow-sm border border-gray-100 dark:border-white/10 dark:shadow-[0_0_30px_rgba(218,37,29,0.15)] transition-colors">
                    <h3 class="text-2xl font-bold text-secondary dark:text-white mb-6 flex items-center">
                        <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        Contact Us
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-400 uppercase tracking-wide font-bold">Email</p>
                            <a href="mailto:info@spindo.com" class="text-lg text-primary hover:underline">info@spindo.com</a>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400 uppercase tracking-wide font-bold">Phone</p>
                            <p class="text-lg text-gray-800 dark:text-gray-200">(031) 123-4567</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400 uppercase tracking-wide font-bold">Address</p>
                            <p class="text-gray-700 dark:text-gray-400">Jl. Kalibutuh No. 189-191, Surabaya, Indonesia</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-secondary dark:text-white mb-6">Frequently Asked Questions</h3>
                    
                    <div class="border-b border-gray-200 dark:border-white/10 pb-4">
                        <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-2">How do I access my certificate?</h4>
                        <p class="text-gray-600 dark:text-gray-500">Once you complete all lessons and pass the final quiz, your certificate will be available for download on the course page.</p>
                    </div>

                    <div class="border-b border-gray-200 dark:border-white/10 pb-4">
                        <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-2">Can I access courses from home?</h4>
                        <p class="text-gray-600 dark:text-gray-500">Yes, the SPINDO LMS is accessible from any device with an internet connection, 24/7.</p>
                    </div>

                    <div class="border-b border-gray-200 dark:border-white/10 pb-4">
                        <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-2">Who do I contact for login issues?</h4>
                        <p class="text-gray-600 dark:text-gray-500">Please contact the IT Support department or use the email provided on this page.</p>
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
