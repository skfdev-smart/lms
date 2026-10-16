<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    courses: Array,
    enrolledCourseIds: Array,
    categories: Array,
});

const searchQuery = ref('');
const selectedCategory = ref('');
const enrollingCourseId = ref(null);

const filteredCourses = computed(() => {
    return props.courses.filter(course => {
        const matchesSearch = !searchQuery.value || 
            course.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            (course.description && course.description.toLowerCase().includes(searchQuery.value.toLowerCase()));
        
        const matchesCategory = !selectedCategory.value || 
            course.category === selectedCategory.value;
        
        return matchesSearch && matchesCategory;
    });
});

const groupedCourses = computed(() => {
    const groups = {};
    const coursesToGroup = filteredCourses.value;

    coursesToGroup.forEach(course => {
        const cat = course.category || 'General';
        if (!groups[cat]) groups[cat] = [];
        groups[cat].push(course);
    });

    // Return as array of objects for easier template iteration
    return Object.keys(groups).sort().map(name => ({
        name,
        courses: groups[name]
    }));
});

const isEnrolled = (courseId) => {
    return props.enrolledCourseIds.includes(courseId);
};

const enrollInCourse = (course) => {
    enrollingCourseId.value = course.id;
    router.post(route('course.enroll', course.id), {}, {
        preserveScroll: true,
        onFinish: () => {
            enrollingCourseId.value = null;
        }
    });
};
</script>

<template>
    <Head title="Course Catalog" />

    <EducationalLayout>
        <!-- Header Section -->
        <div class="relative py-10 mb-8 overflow-hidden bg-[#151515]">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-0 left-0 w-1/2 h-full overflow-hidden opacity-80">
                    <div class="w-[150%] h-full bg-[repeating-linear-gradient(45deg,#DA251D,#DA251D_10px,transparent_10px,transparent_20px)] transform -skew-x-12 -translate-x-10"></div>
                </div>
                <div class="absolute top-0 right-0 w-1/2 h-full overflow-hidden opacity-80">
                    <div class="w-[150%] h-full bg-[repeating-linear-gradient(-45deg,#DA251D,#DA251D_10px,transparent_10px,transparent_20px)] transform skew-x-12 translate-x-10"></div>
                </div>
                <div class="absolute inset-x-0 top-0 h-10 bg-gradient-to-b from-[#0a0a0a] to-transparent z-10"></div>
                <div class="absolute inset-x-0 bottom-0 h-10 bg-gradient-to-t from-[#0a0a0a] to-transparent z-10"></div>
                <div class="absolute inset-y-0 left-0 w-32 bg-[#151515] transform skew-x-12 origin-bottom-left border-r-4 border-[#DA251D] shadow-[0_0_15px_#DA251D] z-20"></div>
                <div class="absolute inset-y-0 right-0 w-32 bg-[#151515] transform -skew-x-12 origin-bottom-right border-l-4 border-[#DA251D] shadow-[0_0_15px_#DA251D] z-20"></div>
                <div class="absolute inset-0 mx-auto w-full bg-gradient-to-b from-[#222] to-[#111] transform skew-x-0 border-x-0 border-[#DA251D]/50 z-10 clip-path-center-plate">
                     <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,white_1px,transparent_1px)] bg-[size:10px_10px]"></div>
                     <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent"></div>
                </div>
                 <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#DA251D] shadow-[0_0_20px_#DA251D] z-30"></div>
            </div>

            <div class="container mx-auto px-4 relative z-30 text-center">
                <span class="inline-block py-1 px-3 rounded bg-red-900/30 text-[#ef4444] border border-[#d24444]/30 text-xs font-bold tracking-[0.3em] uppercase mb-2 backdrop-blur-sm">
                    Spindo Learning Center
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-white font-raleway uppercase tracking-tighter drop-shadow-lg">
                    Course <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF512F] to-[#DA251D]">Catalog</span>
                </h1>
                <p class="text-gray-400 mt-2 font-sans text-sm md:text-base max-w-2xl mx-auto border-t border-gray-800/50 pt-2">
                    Explore our range of expert-led courses designed for professional growth.
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="container mx-auto px-4 pb-20">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <aside class="w-full lg:w-64 shrink-0">
                    <div class="sticky top-24 bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden">
                        <div class="p-4 bg-gray-50 dark:bg-white/5 border-b border-gray-100 dark:border-white/10">
                            <h3 class="font-bold text-secondary dark:text-white font-raleway text-xs uppercase tracking-widest">Departments</h3>
                        </div>
                        <nav class="p-2">
                            <button 
                                @click="selectedCategory = ''"
                                class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-semibold transition-all flex items-center justify-between group"
                                :class="!selectedCategory ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5'"
                            >
                                <span>All Courses</span>
                                <span class="text-[10px] opacity-60 bg-black/10 px-2 py-0.5 rounded-full">{{ courses.length }}</span>
                            </button>
                            <div class="my-2 border-t border-gray-100 dark:border-white/5"></div>
                            <div class="space-y-1">
                                <button 
                                    v-for="category in categories" 
                                    :key="category"
                                    @click="selectedCategory = category"
                                    class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-semibold transition-all flex items-center justify-between group"
                                    :class="selectedCategory === category ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5'"
                                >
                                    <span class="line-clamp-1">{{ category }}</span>
                                    <span v-if="selectedCategory !== category" class="text-[10px] opacity-40 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </span>
                                </button>
                            </div>
                        </nav>
                    </div>
                </aside>

                <!-- Right Side Content -->
                <div class="flex-1">
                    <!-- Search Bar -->
                    <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 p-4 mb-8">
                        <div class="relative">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input 
                                v-model="searchQuery"
                                type="text" 
                                placeholder="Search courses by title or description..." 
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-white/20 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition text-sm bg-white dark:bg-white/5 dark:text-white dark:placeholder-gray-500 shadow-inner"
                            >
                        </div>
                    </div>

                    <!-- Groups/List -->
                    <div v-if="filteredCourses.length > 0" class="space-y-12">
                        <section v-for="group in groupedCourses" :key="group.name">
                            <div class="flex items-center gap-4 mb-6">
                                <h2 class="text-xl font-bold text-secondary dark:text-white font-raleway uppercase tracking-wider shrink-0 bg-primary/10 dark:bg-primary/20 text-primary px-4 py-1.5 rounded-lg border border-primary/20">
                                    {{ group.name }}
                                </h2>
                                <div class="h-px bg-gray-100 dark:bg-white/10 flex-1"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                                <!-- Card -->
                                <div v-for="course in group.courses" :key="course.id" class="bg-white dark:bg-[#111] rounded-lg overflow-hidden shadow-sm border border-gray-100 dark:border-white/10 group transition hover:shadow-lg dark:hover:shadow-[0_0_30px_rgba(218,37,29,0.15)] flex flex-col h-full transform hover:-translate-y-1 duration-300">
                                    <div class="relative overflow-hidden aspect-video">
                                        <img 
                                            :src="course.thumbnail ? '/storage/' + course.thumbnail : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80'" 
                                            alt="Course Thumbnail"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        >
                                        <div v-if="isEnrolled(course.id)" class="absolute top-4 left-4 bg-green-500 text-white text-[10px] font-bold px-3 py-1 rounded uppercase tracking-wider flex items-center gap-1 shadow-lg ring-1 ring-white/20">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Enrolled
                                        </div>
                                    </div>

                                    <div class="p-6 flex flex-col flex-1 text-left">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-[10px] text-gray-400 font-semibold tracking-widest uppercase">{{ course.author_name || 'Instructor' }}</span>
                                            <span class="bg-green-50 dark:bg-green-900/20 text-primary dark:text-green-400 text-xs font-bold px-2 py-1 rounded border border-transparent dark:border-green-500/20">FREE</span>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 font-raleway group-hover:text-primary transition line-clamp-1">
                                            {{ course.title }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 line-clamp-2 leading-relaxed flex-1">
                                            {{ course.description || 'No description available for this course.' }}
                                        </p>
                                        <div class="flex items-center justify-between border-t border-gray-100 dark:border-white/10 pt-4 mt-auto">
                                            <div class="flex items-center space-x-3 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                                    <span>{{ course.students_count || 0 }}</span>
                                                </div>
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                                    <span>{{ course.lessons_count }}</span>
                                                </div>
                                            </div>
                                            <div v-if="isEnrolled(course.id)">
                                                <Link :href="route('course.show', course.id)" class="text-primary font-bold hover:text-primary-hover transition text-xs uppercase tracking-widest flex items-center group/btn">
                                                    Continue
                                                    <svg class="w-4 h-4 ml-1 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                                </Link>
                                            </div>
                                            <button 
                                                v-else
                                                @click="enrollInCourse(course)"
                                                :disabled="enrollingCourseId === course.id"
                                                class="bg-primary text-white font-bold text-xs uppercase tracking-widest px-4 py-2 rounded-full hover:bg-primary-hover transition flex items-center gap-1 disabled:opacity-50"
                                            >
                                                <svg v-if="enrollingCourseId === course.id" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                <span v-else>Enroll</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Empty State -->
                    <div v-else class="text-center py-24 bg-white dark:bg-[#111] rounded-2xl border-2 border-dashed border-gray-100 dark:border-white/5 transition-all">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-primary/20 blur-2xl rounded-full"></div>
                            <svg class="w-20 h-20 text-gray-300 dark:text-gray-700 mx-auto relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary dark:text-white mb-2 font-raleway">No courses found</h3>
                        <p v-if="searchQuery || selectedCategory" class="text-gray-500 dark:text-gray-400 font-sans max-w-md mx-auto">
                            We couldn't find anything matching your search for 
                            <span class="text-primary font-bold">"{{ searchQuery }}"</span> 
                            in the current selection.
                        </p>
                        <p v-else class="text-gray-500 dark:text-gray-400 font-sans">No courses available in this category yet. Check back soon!</p>
                        <button @click="searchQuery = ''; selectedCategory = ''" class="mt-8 text-primary font-bold text-sm uppercase tracking-widest hover:underline">
                            Clear all filters
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </EducationalLayout>
</template>

<style scoped>
.clip-path-center-plate {
    clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
}
@media (min-width: 768px) {
    .clip-path-center-plate {
        clip-path: polygon(0 0, 100% 0, 90% 100%, 10% 100%);
    }
}
.container {
    max-width: 1600px;
}
</style>
