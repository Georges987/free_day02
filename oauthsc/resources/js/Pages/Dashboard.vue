<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    users: {
        type: Object,
        default: () => ({}),
    }
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white text-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <table class="min-w-full overflow-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Connexion type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="border px-4 py-2">{{ user.id }}</td>
                                    <td class="border px-4 py-2">{{ user.name }}</td>
                                    <td class="border px-4 py-2">
                                        <span v-if="user.github_id">
                                            Github
                                        </span>
                                        <span v-if="user.google_id">
                                            Google
                                        </span>
                                        <span v-if="user.facebook_id">
                                            Facebook
                                        </span>
                                        <span v-if="user.linkedin_id">
                                            LinkedIn
                                        </span>
                                        <span v-if="user.microsoft_id">
                                            Microsoft
                                        </span>
                                        <span v-if="user.is_basic_auth">
                                            Basic Auth
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
