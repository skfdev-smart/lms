<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    certificate: Object,
    settings: Object,
});

const signatureUrl = computed(() => {
    if (props.settings?.signature_path) {
        return `/storage/${props.settings.signature_path}`;
    }
    return 'https://upload.wikimedia.org/wikipedia/commons/f/f8/Signature_sample.svg';
});

const isValid = computed(() => props.certificate && props.certificate.id); // Simple check for certificate existence
</script>

<template>
    <Head title="Verify Certificate" />
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="w-full max-w-[210mm] bg-white shadow-2xl overflow-hidden relative transform transition-all hover:scale-[1.01] duration-500">
            <!-- Premium Background (White) -->
            <div class="absolute inset-0 bg-white z-0"></div>

            <!-- Premium Border Container -->
            <div class="absolute inset-0 p-6 pointer-events-none z-20">
                <div class="w-full h-full border-4 border-[#996515] relative">
                    <!-- Inner Border Line -->
                    <div class="absolute inset-1 border border-[#996515]/50"></div>
                     <!-- Corner Ornaments (SVG) -->
                    <svg class="absolute -top-1 -left-1 w-12 h-12 text-[#996515]" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                    <svg class="absolute -top-1 -right-1 w-12 h-12 text-[#996515] transform rotate-90" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                    <svg class="absolute -bottom-1 -left-1 w-12 h-12 text-[#996515] transform -rotate-90" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                    <svg class="absolute -bottom-1 -right-1 w-12 h-12 text-[#996515] transform rotate-180" viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L40,0 L40,10 L10,10 L10,40 L0,40 Z" /><path d="M5,5 L35,5 L35,8 L8,8 L8,35 L5,35 Z" opacity="0.5"/></svg>
                </div>
            </div>

            <!-- Watermark -->
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.04] pointer-events-none z-0">
                <img src="/logo.png" class="w-2/3 h-2/3 object-contain grayscale" alt="Watermark">
            </div>

            <!-- Content -->
            <div class="relative z-10 p-8 sm:p-12 text-center">
                 <!-- Header -->
                <div class="flex items-center justify-center mb-6">
                    <img src="/logo.png" alt="SPINDO" class="h-12 w-auto mix-blend-multiply contrast-125">
                </div>

                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#CD2027] mb-2 uppercase tracking-wide">Certificate</h1>
                <h2 class="font-serif text-xl sm:text-2xl text-[#996515] italic mb-8">Verification</h2>

                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1">Recipient</p>
                        <h3 class="font-script text-4xl sm:text-5xl text-gray-800">{{ certificate.user.name }}</h3>
                    </div>

                    <div>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1">Checking Course Completion</p>
                        <h4 class="font-bold text-lg sm:text-xl text-gray-800">"{{ certificate.course.title }}"</h4>
                    </div>

                    <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto mt-8 border-t border-b border-[#996515]/20 py-4">
                        <div class="text-right pr-4 border-r border-[#996515]/20">
                            <p class="text-[10px] uppercase tracking-wider text-gray-400">Date Issued</p>
                            <p class="font-serif font-bold text-gray-700">{{ new Date(certificate.issued_at).toLocaleDateString('en-GB') }}</p>
                        </div>
                        <div class="text-left pl-4">
                             <p class="text-[10px] uppercase tracking-wider text-gray-400">Certificate ID</p>
                            <p class="font-mono font-bold text-gray-700 text-sm">{{ certificate.certificate_number }}</p>
                        </div>
                    </div>

                     <!-- Signature -->
                    <div class="mt-8">
                         <div class="relative h-20 w-48 mx-auto mb-2">
                             <img :src="signatureUrl" alt="Signature" class="h-full w-full object-contain filter contrast-125 mix-blend-multiply opacity-90">
                         </div>
                        <div class="border-b border-[#996515] w-48 mx-auto mb-2 opacity-50"></div>
                        <p class="font-bold text-gray-700 text-xs uppercase">{{ settings?.signer_name || 'Director of Training' }}</p>
                         <p class="text-[10px] text-[#996515] font-serif italic">{{ settings?.signer_position || 'PT SPINDO Tbk.' }}</p>
                    </div>
                </div>

                <div class="pt-6 border-t">
                     <p class="text-xs text-center text-gray-400">
                        This verification page confirms that the certificate above was officially issued by PT. Steel Pipe Industry of Indonesia, Tbk.
                    </p>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 text-center border-t">
                <a :href="menuLink" class="text-primary text-sm font-semibold hover:underline">Go to Learning Portal</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        menuLink() {
            return '/';
        }
    }
}
</script>
