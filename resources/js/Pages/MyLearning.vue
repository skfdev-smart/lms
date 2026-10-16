<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    courses: Array,
});
</script>

<template>
    <Head title="My Learning" />

    <EducationalLayout>
        <!-- Header -->
        <!-- Header -->
        <div class="relative py-10 mb-12 overflow-hidden bg-[#151515]">
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
                 <!-- Left trapezoid cover --- Adjusted z-index for stacking -->
                <div class="absolute inset-y-0 left-0 w-32 bg-[#151515] transform skew-x-12 origin-bottom-left border-r-4 border-[#DA251D] shadow-[0_0_15px_#DA251D] z-20"></div>
                <!-- Right trapezoid cover -->
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
                    Learner Progress
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-white font-raleway uppercase tracking-tighter drop-shadow-lg">
                    My <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF512F] to-[#DA251D]">Learning</span>
                </h1>
                <p class="text-gray-400 mt-2 font-sans text-sm md:text-base max-w-2xl mx-auto border-t border-gray-800/50 pt-2">
                    Continue your journey and track your achievements.
                </p>
            </div>
        </div>

        <style scoped>
        .clip-path-center-plate {
            clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
        }
        @media (min-width: 768px) {
            .clip-path-center-plate {
                 clip-path: polygon(0 0, 100% 0, 90% 100%, 10% 100%);
            }
        }
        </style>

        <div class="container mx-auto px-4 pb-20">
            <div v-if="courses.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="course in courses" :key="course.id" class="bg-white dark:bg-[#111] rounded-lg overflow-hidden shadow-sm border border-gray-100 dark:border-white/10 group transition hover:shadow-lg dark:hover:shadow-[0_0_30px_rgba(218,37,29,0.15)] flex flex-col h-full">
                    <!-- Thumbnail -->
                    <div class="relative overflow-hidden">
                         <img 
                            :src="course.thumbnail ? '/storage/' + course.thumbnail : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80'" 
                            alt="Course Thumbnail"
                            class="w-full h-48 object-cover group-hover:scale-110 transition duration-500"
                        >
                        <div class="absolute top-4 right-4 bg-primary text-white text-[10px] font-bold px-3 py-1 rounded uppercase tracking-wider">
                           {{ course.category || 'Enrolled' }}
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-1 text-left">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 font-raleway group-hover:text-primary transition line-clamp-1">
                            {{ course.title }}
                        </h3>
                        
                        <!-- Progress Bar (Mockup for now) -->
                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mb-4">
                            <div class="bg-primary h-2.5 rounded-full" :style="{ width: (course.lessons_count > 0 ? Math.round((course.completed_lessons_count / course.lessons_count) * 100) : 0) + '%' }"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">{{ course.lessons_count > 0 ? Math.round((course.completed_lessons_count / course.lessons_count) * 100) : 0 }}% Completed</p>

                        <div class="mt-auto">
                            <Link 
                                :href="route('course.show', course.id)" 
                                class="inline-block w-full text-center bg-secondary text-white py-2 rounded font-bold uppercase text-xs hover:bg-black transition"
                            >
                                Continue Learning
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-20 bg-white dark:bg-[#111] rounded-lg border border-dashed border-gray-200 dark:border-white/10">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">No courses started yet</h3>
                <p class="text-gray-500 mb-6">Explore our catalog and start your learning journey today.</p>
                <Link :href="route('catalog')" class="bg-primary text-white px-6 py-2 rounded-full font-bold hover:bg-primary-hover transition">
                    Browse Catalog
                </Link>
            </div>
        </div>
    </EducationalLayout>
</template>

<style scoped>
.container {
    max-width: 1600px;
}
</style>
