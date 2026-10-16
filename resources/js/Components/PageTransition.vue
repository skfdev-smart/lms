<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

// Determine transition based on current page
const transitionName = computed(() => {
    const currentPage = page.component;
    
    // Use door transition for auth pages
    if (currentPage.includes('Auth/')) {
        return 'slide-door';
    }
    
    // Default fade for other pages
    return 'fade-slide';
});
</script>

<template>
    <div class="door-transition-wrapper min-h-screen">
        <Transition :name="transitionName" mode="out-in">
            <slot />
        </Transition>
    </div>
</template>
