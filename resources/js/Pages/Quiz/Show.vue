<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    quiz: Object,
});

const currentQuestionIndex = ref(0);
const answers = ref({});
const quizStarted = ref(false);
const isSubmitting = ref(false);
const cardRef = ref(null);
const cardRotation = ref({ x: 0, y: 0 });

const currentQuestion = computed(() => props.quiz.questions[currentQuestionIndex.value]);
const progress = computed(() => {
    if (!props.quiz.questions || props.quiz.questions.length === 0) return 0;
    return Math.round(((currentQuestionIndex.value) / props.quiz.questions.length) * 100);
});

// 3D Tilt Logic
const handleMouseMove = (e) => {
    if (!cardRef.value) return;
    const rect = cardRef.value.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    cardRotation.value = { 
        x: ((y - centerY) / centerY) * -3, 
        y: ((x - centerX) / centerX) * 3 
    };
};

const handleMouseLeave = () => {
    cardRotation.value = { x: 0, y: 0 };
};

const cardStyle = computed(() => ({
    transform: `perspective(1000px) rotateX(${cardRotation.value.x}deg) rotateY(${cardRotation.value.y}deg)`,
    transition: 'transform 0.1s ease-out'
}));

const selectAnswer = (answerText) => {
    answers.value[currentQuestion.value.id] = answerText;
};

const nextQuestion = () => {
    if (currentQuestionIndex.value < props.quiz.questions.length - 1) {
        currentQuestionIndex.value++;
    }
};

const prevQuestion = () => {
    if (currentQuestionIndex.value > 0) {
        currentQuestionIndex.value--;
    }
};

// Start Quiz Animation
const startQuiz = () => {
    quizStarted.value = true;
};

const submitQuiz = () => {
    if (confirm('Yakin ingin menyelesaikan quiz ini?')) {
        isSubmitting.value = true;
        router.post(route('quiz.submit', props.quiz.id), {
            answers: answers.value
        }, {
            onFinish: () => isSubmitting.value = false
        });
    }
};
</script>

<template>
    <Head :title="quiz.title" />

    <div class="min-h-screen bg-gray-900 font-sans text-white overflow-hidden relative" @mousemove="handleMouseMove" @mouseleave="handleMouseLeave">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-animate opacity-40"></div>
        <div class="absolute inset-0 bg-[url('/img/grid.svg')] opacity-10 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        
        <!-- Orbs -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2 animate-blob animation-delay-2000"></div>

        <!-- Navbar -->
        <nav class="absolute top-0 left-0 right-0 z-50 p-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="/logo.svg" class="h-10 drop-shadow-lg" alt="Logo" />
                <span class="text-xl font-bold font-raleway tracking-wide">Quiz<span class="text-primary">Mode</span></span>
            </div>
            <Link :href="route('dashboard')" class="bg-white/10 hover:bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-sm font-semibold transition-all border border-white/10 flex items-center gap-2 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Keluar
            </Link>
        </nav>

        <!-- Main Content -->
        <div class="container mx-auto px-4 h-screen flex flex-col justify-center items-center relative z-10">
            
            <!-- START SCREEN -->
            <div v-if="!quizStarted" class="text-center max-w-2xl">
                <div class="mb-8 relative group perspective-1000">
                    <div class="absolute inset-0 bg-primary/30 rounded-full blur-3xl animate-pulse-slow"></div>
                    <h1 class="text-6xl font-extrabold font-raleway mb-4 relative z-10 drop-shadow-2xl">
                        {{ quiz.title }}
                    </h1>
                </div>
                
                <p class="text-xl text-gray-300 mb-12 leading-relaxed font-light">
                    {{ quiz.description || 'Uji pemahaman Anda tentang materi ini dengan menjawab pertanyaan berikut.' }}
                </p>

                <div class="grid grid-cols-3 gap-6 mb-12 text-sm text-gray-400">
                    <div class="bg-white/5 backdrop-blur-sm p-4 rounded-xl border border-white/10">
                        <span class="block text-2xl font-bold text-white mb-1">{{ quiz.questions.length }}</span>
                        Soal
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm p-4 rounded-xl border border-white/10">
                        <span class="block text-2xl font-bold text-white mb-1">{{ quiz.passing_percentage }}%</span>
                        Passing Grade
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm p-4 rounded-xl border border-white/10">
                         <span class="block text-2xl font-bold text-white mb-1">∞</span>
                        Percobaan
                    </div>
                </div>

                <button 
                    @click="startQuiz"
                    class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-primary font-raleway rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary hover:bg-primary-hover shadow-lg shadow-primary/30 hover:scale-105"
                >
                    <span class="mr-2">Mulai Quiz Sekarang</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    <div class="absolute inset-0 rounded-full ring-2 ring-white/20 group-hover:ring-white/40 animate-pulse"></div>
                </button>
            </div>

            <!-- QUIZ INTERFACE -->
            <div v-else class="w-full max-w-4xl transition-all duration-500" :style="cardStyle" ref="cardRef">
                <!-- Progress Header -->
                <div class="mb-8 flex items-end justify-between px-2">
                    <div>
                        <span class="text-6xl font-black text-white/10 block leading-none absolute -top-16 left-0 -z-10">{{ currentQuestionIndex + 1 }}</span>
                        <div class="text-sm font-bold text-primary uppercase tracking-widest mb-1">Pertanyaan {{ currentQuestionIndex + 1 }} / {{ quiz.questions.length }}</div>
                        <h2 class="text-2xl font-bold text-white">Fokus dan teliti</h2>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-primary">{{ progress }}%</div>
                    </div>
                </div>

                <!-- 3D Card -->
                <div class="backdrop-blur-xl bg-gray-900/80 rounded-3xl shadow-2xl border border-white/10 p-8 md:p-12 relative overflow-hidden">
                    <!-- Progress Bar Background -->
                    <div class="absolute top-0 left-0 h-1 bg-gradient-to-r from-primary to-orange-500 transition-all duration-500" :style="{ width: progress + '%' }"></div>
                    
                    <!-- Question Text -->
                    <div class="mb-10 min-h-[100px]">
                        <h3 class="text-2xl md:text-3xl font-medium leading-relaxed font-raleway text-white" v-html="currentQuestion.question_text"></h3>
                    </div>

                    <!-- Options -->
                    <div class="grid grid-cols-1 gap-4 mb-10">
                        <button 
                            v-for="(option, index) in currentQuestion.options" 
                            :key="index"
                            @click="selectAnswer(option.text)"
                            class="group relative w-full text-left p-5 rounded-2xl border transition-all duration-200 flex items-center gap-5 hover:scale-[1.01]"
                                :class="answers[currentQuestion.id] === option.text 
                                    ? 'bg-primary/20 border-primary shadow-[0_0_20px_rgba(218,37,29,0.3)]' 
                                    : 'bg-white/5 border-white/10 hover:bg-white/10 hover:border-white/30'"
                        >
                            <span 
                                class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-bold transition-colors duration-200"
                                :class="answers[currentQuestion.id] === option.text ? 'bg-primary text-white' : 'bg-white/10 text-gray-400 group-hover:bg-white/20 group-hover:text-white'"
                            >
                                {{ String.fromCharCode(65 + index) }}
                            </span>
                            <span class="text-lg font-medium" :class="answers[currentQuestion.id] === option.text ? 'text-white' : 'text-gray-300 group-hover:text-white'">
                                {{ option.text }}
                            </span>
                            
                            <!-- Checkmark Icon for Selected -->
                            <div v-if="answers[currentQuestion.id] === option.text" class="absolute right-5 text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </button>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between items-center border-t border-white/10 pt-8">
                        <button 
                            @click="prevQuestion"
                            :disabled="currentQuestionIndex === 0"
                            class="px-6 py-3 rounded-xl font-bold text-gray-400 hover:text-white hover:bg-white/5 transition-all disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-gray-400"
                        >
                            ← Sebelumnya
                        </button>

                        <button 
                            v-if="currentQuestionIndex < quiz.questions.length - 1"
                            @click="nextQuestion"
                            :disabled="!answers[currentQuestion.id]"
                            class="px-8 py-3 bg-white text-gray-900 rounded-xl font-bold hover:bg-gray-100 transition-all shadow-lg hover:scale-105 disabled:opacity-50 disabled:scale-100 disabled:hover:bg-white flex items-center gap-2"
                        >
                            Selanjutnya →
                        </button>

                        <button 
                            v-else
                            @click="submitQuiz"
                            :disabled="Object.keys(answers).length < quiz.questions.length || isSubmitting"
                            class="px-8 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-bold hover:brightness-110 transition-all shadow-lg shadow-primary/30 hover:scale-105 disabled:opacity-50 disabled:scale-100 flex items-center gap-2"
                        >
                            <svg v-if="isSubmitting" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            {{ isSubmitting ? 'Mengirim...' : 'Selesaikan Quiz ✨' }}
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>
.font-raleway { font-family: 'Raleway', sans-serif; }

.bg-gradient-animate {
    background: linear-gradient(-45deg, #0f172a, #1e293b, #111827, #334155);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.perspective-1000 {
    perspective: 1000px;
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
</style>
