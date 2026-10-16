<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    courses: Array,
});
</script>

<template>
    <Head title="Course Catalog" />

    <EducationalLayout>
        <!-- Cyber Header -->
        <div class="relative py-16 mb-12 overflow-hidden bg-white dark:bg-[#0a0a0a] transition-colors duration-300">
            <!-- Background Elements -->
            <div class="absolute inset-0 bg-gray-50 dark:bg-[#0a0a0a]">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-200/50 to-transparent dark:from-primary/10 dark:to-transparent"></div>
                <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-gray-100 to-transparent dark:from-primary/5 dark:to-transparent skew-x-12 transform origin-top-right"></div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="flex items-center gap-4 mb-4">
                     <div class="h-1 w-12 bg-primary"></div>
                     <span class="text-primary font-mono text-xs uppercase tracking-[0.2em] font-bold">System_Catalog</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white font-raleway uppercase tracking-tight mb-2 transition-colors">
                    Available <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-800 to-gray-400 dark:from-white dark:to-gray-500">Modules</span>
                </h1>
                <p class="text-gray-600 dark:text-gray-400 font-sans max-w-xl text-lg leading-relaxed transition-colors">
                    Access critical training modules and certification programs.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 pb-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="course in courses" :key="course.id" class="group bg-white dark:bg-[#111] border border-gray-200 dark:border-white/10 overflow-hidden hover:border-primary/50 transition-all duration-500 hover:shadow-xl dark:hover:shadow-[0_0_30px_rgba(218,37,29,0.1)] flex flex-col h-full rounded-sm">
                    <div class="relative overflow-hidden h-48">
                        <div class="absolute inset-0 bg-primary/20 mix-blend-overlay z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <img 
                            :src="course.thumbnail ? '/storage/' + course.thumbnail : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80'" 
                            alt="Course Thumbnail"
                            class="w-full h-full object-cover dark:grayscale group-hover:grayscale-0 transition-all duration-700 transform group-hover:scale-110"
                        >
                        <div class="absolute top-0 right-0 bg-primary/90 text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest clip-path-badge z-20">
                           {{ course.category || 'Core' }}
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-1 text-left relative">
                        <!-- Tech decoration line (Dark Mode Only) -->
                        <div class="absolute top-0 left-6 right-6 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent hidden dark:block"></div>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] text-primary font-mono font-bold tracking-widest uppercase">{{ course.author_name || 'System_Admin' }}</span>
                            <span class="bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-gray-300 text-[10px] font-bold px-2 py-1 border border-gray-200 dark:border-white/10">FREE ACCESS</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-raleway group-hover:text-primary transition-colors line-clamp-1 uppercase tracking-wide">
                            {{ course.title }}
                        </h3>
                        
                        <p class="text-sm text-gray-600 dark:text-gray-500 mb-6 line-clamp-2 leading-relaxed flex-1 font-sans">
                            {{ course.description || 'Module description unavailable.' }}
                        </p>
                        
                        <div class="flex items-center justify-between border-t border-gray-100 dark:border-white/5 pt-4 mt-auto">
                            <div class="flex items-center space-x-4 text-gray-500 text-[10px] font-bold uppercase tracking-widest">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    <span>{{ course.students_count || 0 }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                    <span>{{ course.lessons_count }}</span>
                                </div>
                            </div>
                            
                            <Link 
                                :href="route('course.show', course.id)" 
                                class="text-gray-900 dark:text-white font-bold hover:text-primary transition-colors text-[10px] uppercase tracking-[0.2em] flex items-center group/btn relative"
                            >
                                <span class="relative z-10">Initialize</span>
                                <svg class="w-3 h-3 ml-2 transition-transform group-hover/btn:translate-x-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </Link>
                        </div>
                    </div>
                </div>

                <div v-if="courses.length === 0" class="col-span-full text-center py-20 bg-gray-50 dark:bg-white/5 rounded border border-dashed border-gray-300 dark:border-white/10">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <p class="text-gray-500 dark:text-gray-400 font-mono text-sm tracking-widest">SYSTEM_STATUS: NO_MODULES_FOUND</p>
                </div>
            </div>
        </div>
    </EducationalLayout>
</template>

<style scoped>
.container {
    max-width: 1200px;
}
</style>
