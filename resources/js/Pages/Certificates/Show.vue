<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    certificate: Object,
    settings: Object,
});

const isPrinting = ref(false);

const printCertificate = () => {
    isPrinting.value = true;
    setTimeout(() => {
        window.print();
        isPrinting.value = false;
    }, 100);
};

import { computed } from 'vue';

const qrCodeUrl = computed(() => {
    const origin = typeof window !== 'undefined' ? window.location.origin : 'https://lms.spindo.com';
    const verifyUrl = `${origin}/verify/${props.certificate.certificate_number}`;
    return `https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=${encodeURIComponent(verifyUrl)}`;
});

const signatureUrl = computed(() => {
    if (props.settings?.signature_path) {
        return `/storage/${props.settings.signature_path}`;
    }
    return 'https://upload.wikimedia.org/wikipedia/commons/f/f8/Signature_sample.svg';
});
</script>

<template>
    <Head :title="`Certificate - ${certificate.course.title}`" />

    <EducationalLayout>
        <!-- Header Actions -->
        <div class="bg-primary py-8 mb-8 print:hidden">
            <div class="container mx-auto px-4 flex items-center justify-between">
                <div>
                    <Link :href="route('certificates.index')" class="text-white/80 hover:text-white transition text-sm flex items-center gap-1 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                        Back to Certificates
                    </Link>
                    <h1 class="text-2xl font-bold text-white font-raleway">Certificate of Completion</h1>
                </div>
                <button 
                    @click="printCertificate" 
                    :disabled="isPrinting"
                    class="bg-white text-primary px-5 py-2.5 rounded-full font-bold text-sm hover:bg-gray-100 transition flex items-center gap-2 shadow-lg"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Print Certificate
                </button>
            </div>
        </div>

        <div class="flex justify-center pb-20 print:p-0 print:block">
            <!-- A4 Landscape Paper Container -->
            <div class="certificate-paper relative shadow-2xl print:shadow-none print:w-full print:h-full overflow-hidden mx-auto bg-white">
                
                <!-- Premium Background (White) -->
                <div class="absolute inset-0 bg-white z-0"></div>

                <!-- Premium Border Container -->
                <div class="absolute inset-0 p-6 pointer-events-none">
                    <div class="w-full h-full border-4 border-[#996515] relative z-10 flex flex-col justify-between">
                        <!-- Inner Border Line (Double Border Effect) -->
                        <div class="absolute inset-1 border border-[#996515]/50"></div>
                        
                        <!-- Corner Ornaments (SVG) -->
                        <svg class="absolute -top-1 -left-1 w-16 h-16 text-[#996515] z-20" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                        <svg class="absolute -top-1 -left-1 w-16 h-16 text-[#996515]" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                        <svg class="absolute -top-1 -left-1 w-20 h-20 text-[#996515]" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                        <svg class="absolute -top-1 -right-1 w-20 h-20 text-[#996515] transform rotate-90" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                        <svg class="absolute -bottom-1 -left-1 w-20 h-20 text-[#996515] transform -rotate-90" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                        <svg class="absolute -bottom-1 -right-1 w-20 h-20 text-[#996515] transform rotate-180" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                    </div>
                </div>

                <!-- Watermark Background -->
                <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none z-0">
                    <img src="/logo.png" class="w-[600px] h-[600px] object-contain grayscale" alt="Watermark">
                </div>

                <!-- Premium Gold Seal -->
                <div class="absolute bottom-36 right-16 z-20 opacity-100 print:opacity-100">
                    <div class="relative w-40 h-40 flex items-center justify-center filter drop-shadow-2xl">
                        <!-- Seal SVG -->
                        <svg viewBox="0 0 200 200" class="w-full h-full animate-pulse-slow">
                            <defs>
                                <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#F5E080;stop-opacity:1" />
                                    <stop offset="30%" style="stop-color:#B8860B;stop-opacity:1" />
                                    <stop offset="70%" style="stop-color:#F5E080;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#8B4513;stop-opacity:1" />
                                </linearGradient>
                                <filter id="insetShadow">
                                    <feOffset dx="0" dy="0"/>
                                    <feGaussianBlur stdDeviation="2" result="offset-blur"/>
                                    <feComposite operator="out" in="SourceGraphic" in2="offset-blur" result="inverse"/>
                                    <feFlood flood-color="black" flood-opacity="0.5" result="color"/>
                                    <feComposite operator="in" in="color" in2="inverse" result="shadow"/>
                                    <feComposite operator="over" in="shadow" in2="SourceGraphic"/>
                                </filter>
                            </defs>
                            
                            <!-- Rosette Shape -->
                            <path fill="url(#goldGradient)" d="M100,10 L112,30 L135,26 L138,49 L160,54 L154,76 L172,90 L158,107 L170,127 L150,136 L154,158 L132,156 L128,178 L108,168 L96,186 L84,168 L64,178 L60,156 L38,158 L42,136 L22,127 L34,107 L20,90 L38,76 L32,54 L54,49 L57,26 L80,30 Z" stroke="#8B4513" stroke-width="1" />
                            
                            <!-- Inner Circle -->
                            <circle cx="96" cy="96" r="65" fill="none" stroke="#8B4513" stroke-width="2" opacity="0.5" />
                            <circle cx="96" cy="96" r="60" fill="none" stroke="#F5E080" stroke-width="1" />

                            <!-- Text Path -->
                            <path id="curve" d="M 50,96 A 46,46 0 1,1 142,96" fill="none" />
                            <text width="200" font-family="serif" font-size="12" font-weight="bold" fill="#3A2805" letter-spacing="2">
                                <textPath xlink:href="#curve" startOffset="50%" text-anchor="middle">OFFICIAL CERTIFICATE</textPath>
                            </text>

                            <!-- Center Text -->
                            <text x="96" y="90" text-anchor="middle" font-family="serif" font-size="24" font-weight="900" fill="#3A2805">SEAL</text>
                            <text x="96" y="105" text-anchor="middle" font-family="serif" font-size="8" font-weight="bold" fill="#3A2805" letter-spacing="1">OF EXCELLENCE</text>
                            <text x="96" y="125" text-anchor="middle" font-family="sans-serif" font-size="10" font-weight="bold" fill="#8B4513" letter-spacing="1">PT SPINDO</text>
                            
                            <!-- Stars -->
                            <text x="96" y="140" text-anchor="middle" font-size="10" fill="#3A2805">★ ★ ★</text>
                        </svg>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="relative z-10 w-full h-full flex flex-col justify-between p-20 pb-24">
                    
                    <!-- Header -->
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-5">
                            <!-- Logo with blend mode to remove white box -->
                            <img src="/logo.png" alt="SPINDO" class="h-20 w-auto mix-blend-multiply filter contrast-125">
                            <div class="border-l border-[#996515]/50 pl-5">
                                <h2 class="text-xl font-bold text-gray-800 tracking-wide uppercase leading-tight">PT. Steel Pipe Industry<br>of Indonesia, Tbk.</h2>
                                <p class="text-[#996515] text-xs font-bold tracking-[0.2em] uppercase mt-1">Excellence in Steel Pipe Manufacturing</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <h3 class="gold-text font-serif italic text-xl">Official Certificate</h3>
                            <p class="text-xs text-gray-400 font-mono mt-1">ID: {{ certificate.certificate_number }}</p>
                        </div>
                    </div>

                    <!-- Main Body -->
                    <div class="text-center mt-0">
                        <h1 class="gold-text-gradient font-serif text-[4rem] font-bold mb-0 tracking-wide uppercase leading-none drop-shadow-sm">Certificate</h1>
                        <h2 class="font-serif text-3xl italic mb-4 relative inline-block px-10 font-bold">
                            <span class="relative z-10 gold-text-gradient">of Completion</span>
                            <div class="absolute top-1/2 left-0 w-8 h-[1px] bg-[#996515]"></div>
                            <div class="absolute top-1/2 right-0 w-8 h-[1px] bg-[#996515]"></div>
                        </h2>

                        <p class="text-gray-500 uppercase tracking-[0.25em] text-sm mb-2 font-medium">This is to certify that</p>
                        
                        <div class="mb-4 relative inline-block">
                            <h3 class="font-script text-8xl text-[#CD2027] pb-2 px-12 min-w-[600px] border-b-2 border-[#996515]/30 leading-tight">
                                {{ certificate.user.name }}
                            </h3>
                             <!-- Decorative curve -->
                             <svg class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 w-32 h-4 text-[#996515]/40" viewBox="0 0 100 20" preserveAspectRatio="none">
                                <path d="M0,10 Q50,20 100,10" fill="none" stroke="currentColor" stroke-width="2" />
                             </svg>
                        </div>

                        <p class="text-gray-500 uppercase tracking-[0.25em] text-sm mb-6 font-medium">Has successfully completed the course</p>
                        
                        <h4 class="text-4xl font-bold text-gray-800 mb-8 max-w-5xl mx-auto leading-tight font-serif">
                            "{{ certificate.course.title }}"
                        </h4>

                        <div v-if="certificate.quiz_attempt" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#996515]/10 via-[#996515]/20 to-[#996515]/10 px-8 py-2 rounded-full border border-[#996515]/30 shadow-sm">
                            <svg class="w-5 h-5 text-[#996515]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="text-[#996515] font-bold text-sm uppercase tracking-wider">Final Assessment Score: {{ certificate.quiz_attempt.score }}%</span>
                        </div>
                    </div>

                    <!-- Footer / Signatures -->
                    <div class="grid grid-cols-3 items-end gap-8 pb-4">
                        <!-- Left: QR -->
                         <div class="text-left">
                            <p class="text-[10px] text-[#996515] font-bold uppercase tracking-widest mb-3">Authenticity Verification</p>
                            <!-- QR with blend mode -->
                            <img :src="qrCodeUrl" 
                                    alt="Verification QR" 
                                    class="w-24 h-24 mix-blend-multiply opacity-90 filter contrast-125"
                            >
                            <p class="font-mono text-gray-400 text-[9px] mt-2 tracking-wider">Scan to verify authenticity</p>
                        </div>

                        <!-- Center: Signature -->
                        <div class="text-center relative">
                            <!-- Adjusted positioning relative to line -->
                             <div class="h-24 flex items-end justify-center mb-1">
                                <!-- Signature with blend mode -->
                                <img :src="signatureUrl" alt="Signature" class="h-24 w-auto object-contain mix-blend-multiply filter contrast-125">
                             </div>
                            
                            <div class="border-b-2 border-[#996515] w-full mb-3"></div>
                            
                            <h5 class="font-bold text-gray-800 text-sm uppercase tracking-wider mb-0.5">{{ settings?.signer_name || 'Director of Training' }}</h5>
                            <p class="text-xs text-[#996515] font-serif italic">{{ settings?.signer_position || 'PT SPINDO Tbk.' }}</p>
                        </div>

                        <!-- Right: Date -->
                        <div class="text-right flex flex-col items-end justify-end h-full pb-1">
                            <p class="text-[10px] text-[#996515] font-bold uppercase tracking-widest mb-1">Date of Issue</p>
                            <p class="font-serif font-bold text-gray-700 text-xl border-b border-[#996515]/20 pb-1 inline-block">
                                {{ new Date(certificate.issued_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </EducationalLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=Cinzel:wght@400;700;900&family=Raleway:wght@400;600;700&family=Pinyon+Script&display=swap');

.font-serif { font-family: 'Playfair Display', serif; }
.font-raleway { font-family: 'Raleway', sans-serif; }
.font-cinzel { font-family: 'Cinzel', serif; }
.font-script { font-family: 'Pinyon Script', cursive; }

/* Darker Gold Text Gradient Effect */
.gold-text-gradient {
    background: linear-gradient(to bottom, #996515 22%,#5C4010 24%, #996515 26%, #996515 27%,#C4953E 40%,#3A2805 78%); 
    -webkit-background-clip: text; 
    -webkit-text-fill-color: transparent; 
    color: #996515;
}

.gold-text {
    color: #805500;
    background: linear-gradient(to right, #805500, #C4953E, #805500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.certificate-paper {
    width: 297mm;
    height: 210mm; 
    box-sizing: border-box;
    background-color: #FAFAFA;
}

@media print {
    @page {
        size: A4 landscape;
        margin: 0;
    }
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        background: none !important;
    }
    .print\:hidden { display: none !important; }
    
    .certificate-paper {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        border: none;
        box-shadow: none;
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
    }
}
</style>
