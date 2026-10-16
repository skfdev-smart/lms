<script setup>
import EducationalLayout from '@/Layouts/EducationalLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <EducationalLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="flex items-center gap-4 mb-4">
                     <div class="h-1 w-12 bg-primary"></div>
                     <span class="text-primary font-mono text-xs uppercase tracking-[0.2em] font-bold">User_Settings</span>
                </div>
                <h1 class="text-3xl font-black text-gray-900 dark:text-white font-raleway uppercase tracking-tight mb-8">
                    Profile <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-800 to-gray-400 dark:from-white dark:to-gray-500">Settings</span>
                </h1>

                <div
                    class="bg-white dark:bg-[#111] p-4 shadow sm:rounded-lg sm:p-8 border border-gray-200 dark:border-white/10"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div
                    class="bg-white dark:bg-[#111] p-4 shadow sm:rounded-lg sm:p-8 border border-gray-200 dark:border-white/10"
                >
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div
                    class="bg-white dark:bg-[#111] p-4 shadow sm:rounded-lg sm:p-8 border border-gray-200 dark:border-white/10"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </EducationalLayout>
</template>
