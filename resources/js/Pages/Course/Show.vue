<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    course: Object,
    completedLessonIds: Array,
    latestAttempt: Object,
});

const currentLesson = ref(props.course.lessons[0] || null);
const completedMock = ref([...props.completedLessonIds]); 

const allLessonsCompleted = computed(() => {
    return props.course.lessons.every(lesson => completedMock.value.includes(lesson.id));
});

const toggleComplete = (lesson) => {
    router.post(route('lesson.complete', lesson.id), {}, {
        preserveScroll: true,
        onSuccess: () => {
            if (completedMock.value.includes(lesson.id)) {
                completedMock.value = completedMock.value.filter(id => id !== lesson.id);
            } else {
                completedMock.value.push(lesson.id);
            }
        }
    });
};

const selectLesson = (lesson) => {
    currentLesson.value = lesson;
};

const isVideo = computed(() => currentLesson.value?.content_type === 'video');
const isPdf = computed(() => currentLesson.value?.content_type === 'pdf');
const isText = computed(() => currentLesson.value?.content_type === 'text');

const getYoutubeEmbedUrl = (url) => {
    if (!url) return '';
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? `https://www.youtube.com/embed/${match[2]}` : url;
};
</script>

<template>
    <Head :title="course.title" />

    <EducationalLayout>
        <!-- Course Header -->
        <div class="bg-primary py-10">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-white font-raleway leading-tight md:text-4xl">
                            {{ course.title }}
                        </h1>
                        <p class="text-white/80 mt-2 text-sm font-sans flex items-center gap-2">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            {{ course.lessons.length }} Lessons
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-[#0a0a0a] min-h-screen py-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row gap-8">
                    
                    <!-- Main Content Area -->
                    <div class="flex-1 bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden flex flex-col">
                        <div v-if="currentLesson" class="p-8">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b border-gray-100 dark:border-white/10 pb-6">
                                <div>
                                     <h2 class="text-2xl font-bold text-secondary dark:text-white font-raleway">{{ currentLesson.title }}</h2>
                                     <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold mt-1 block">
                                        Lesson Content
                                     </span>
                                </div>
                                <button 
                                    @click="toggleComplete(currentLesson)"
                                    class="px-5 py-2.5 rounded-full text-sm font-bold transition flex items-center gap-2 shadow-sm"
                                    :class="completedMock.includes(currentLesson.id) 
                                        ? 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400' 
                                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-800 dark:bg-white/10 dark:text-gray-300 dark:hover:bg-white/20'"
                                >
                                    <span v-if="completedMock.includes(currentLesson.id)">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Completed
                                    </span>
                                    <span v-else>Mark as Complete</span>
                                </button>
                            </div>
                            
                            <!-- Video Player -->
                            <div v-if="isVideo" class="rounded-lg overflow-hidden shadow-lg mb-6 bg-black">
                                <div class="aspect-w-16 aspect-h-9">
                                    <iframe 
                                        :src="getYoutubeEmbedUrl(currentLesson.content_url)" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen
                                        class="w-full h-[500px]"
                                    ></iframe>
                                </div>
                            </div>

                            <!-- PDF Viewer -->
                            <div v-if="isPdf" class="rounded-lg overflow-hidden border border-gray-200 dark:border-white/10 shadow-sm h-[800px] mb-6">
                                <iframe :src="currentLesson.content_url || '/storage/' + currentLesson.content_url" class="w-full h-full"></iframe>
                            </div>

                            <!-- Text Content -->
                            <div v-if="isText" class="prose max-w-none text-gray-600 dark:text-gray-300 leading-relaxed font-sans dark:prose-invert">
                                <div v-html="currentLesson.content_body"></div>
                            </div>

                        </div>
                        <div v-else class="p-20 text-center text-gray-400">
                             <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                             <p>Select a lesson from the sidebar to start learning.</p>
                        </div>
                    </div>

                    <!-- Sidebar Lesson List -->
                    <div class="w-full lg:w-96 flex flex-col gap-6">
                        <!-- Progress Card -->
                         <div class="bg-white dark:bg-[#111] p-6 rounded-xl shadow-sm border border-gray-100 dark:border-white/10">
                            <h3 class="font-bold text-secondary dark:text-white font-raleway mb-4 uppercase text-sm tracking-wider">Your Progress</h3>
                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-2.5 mb-2">
                                <div class="bg-primary h-2.5 rounded-full transition-all duration-500" :style="{ width: Math.round((completedMock.length / course.lessons.length) * 100) + '%' }"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 font-bold">
                                <span>{{ Math.round((completedMock.length / course.lessons.length) * 100) }}% Complete</span>
                                <span>{{ completedMock.length }}/{{ course.lessons.length }} Steps</span>
                            </div>
                        </div>

                         <!-- Quiz Card -->
                        <div v-if="course.quiz" class="bg-gradient-to-br from-primary to-red-900 p-6 rounded-xl shadow-lg text-white relative overflow-hidden group">
                             <div class="relative z-10">
                                <h3 class="font-bold font-raleway text-lg mb-2">Quiz Kompetensi</h3>
                                
                                <div v-if="allLessonsCompleted">
                                    <p class="text-white/90 text-sm mb-4">Selamat! Anda telah menyelesaikan materi. Uji pemahaman Anda sekarang!</p>
                                    
                                    <div v-if="!latestAttempt || !latestAttempt.is_passed">
                                        <Link 
                                            :href="route('quiz.show', course.quiz.id)" 
                                            class="inline-flex items-center gap-2 bg-white text-primary px-6 py-2 rounded-full text-sm font-bold shadow hover:bg-gray-50 transition transform hover:scale-105"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Mulai Quiz
                                        </Link>
                                    </div>
                                    <div v-else class="space-y-3">
                                        <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm inline-flex items-center gap-2 border border-white/20">
                                            <span class="text-2xl">🏆</span>
                                            <div>
                                                <div class="text-xs font-bold uppercase tracking-wider opacity-80">Lulus</div>
                                                <div class="font-bold text-lg">{{ latestAttempt.score }}% Score</div>
                                            </div>
                                        </div>
                                        <div>
                                            <Link 
                                                :href="route('certificate.generate', course.id)" 
                                                method="post"
                                                as="button"
                                                class="inline-flex items-center gap-2 bg-yellow-400 text-yellow-900 px-5 py-2 rounded-full text-sm font-bold shadow hover:bg-yellow-300 transition transform hover:scale-105"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                                                Get Certificate
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="opacity-80">
                                    <p class="text-white/80 text-sm mb-4">Selesaikan semua materi pelajaran untuk membuka akses Quiz ini.</p>
                                    <div class="inline-flex items-center gap-2 bg-black/20 px-4 py-2 rounded-full text-sm font-semibold cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                        Terkunci
                                    </div>
                                </div>
                             </div>
                             
                             <!-- Decorative Circle -->
                             <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-110 transition-transform duration-700"></div>
                             
                             <!-- Striped Pattern -->
                             <div v-if="!allLessonsCompleted" class="absolute inset-0 opacity-10" style="background-image: linear-gradient(45deg, #000 25%, transparent 25%, transparent 50%, #000 50%, #000 75%, transparent 75%, transparent); background-size: 10px 10px;"></div>
                        </div>

                        <!-- Lesson List -->
                        <div class="bg-white dark:bg-[#111] rounded-xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden flex flex-col max-h-[600px]">
                             <div class="p-4 bg-gray-50 dark:bg-white/5 border-b border-gray-100 dark:border-white/10">
                                <h3 class="font-bold text-secondary dark:text-white font-raleway text-sm uppercase tracking-wider">Course Content</h3>
                            </div>
                            <div class="overflow-y-auto flex-1 p-2">
                                <ul class="space-y-1">
                                    <li v-for="(lesson, index) in course.lessons" :key="lesson.id">
                                        <button 
                                            @click="selectLesson(lesson)"
                                            class="w-full text-left px-4 py-3 rounded-lg transition flex items-start gap-3 relative group"
                                            :class="currentLesson?.id === lesson.id ? 'bg-green-50 dark:bg-green-900/20 text-secondary dark:text-white' : 'hover:bg-gray-50 dark:hover:bg-white/5 text-gray-600 dark:text-gray-400'"
                                        >   
                                            <!-- Checkmark or Number -->
                                            <div class="shrink-0 mt-0.5" >
                                                <div v-if="completedMock.includes(lesson.id)" class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs shadow-sm">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                                </div>
                                                <div v-else class="w-5 h-5 rounded-full border-2 border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 flex items-center justify-center text-[10px] font-bold group-hover:border-primary group-hover:text-primary transition">
                                                    {{ index + 1 }}
                                                </div>
                                            </div>

                                            <div class="flex-1">
                                                <div class="text-sm font-semibold transition" :class="currentLesson?.id === lesson.id ? 'text-primary' : 'group-hover:text-primary dark:text-gray-300'">
                                                    {{ lesson.title }}
                                                </div>
                                                <div class="text-[10px] text-gray-400 uppercase tracking-wider font-bold mt-1 flex items-center gap-1.5">
                                                    <span v-if="lesson.content_type === 'video'" class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Video</span>
                                                    <span v-if="lesson.content_type === 'pdf'" class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg> PDF</span>
                                                    <span v-if="lesson.content_type === 'text'" class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg> Article</span>
                                                </div>
                                            </div>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

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
