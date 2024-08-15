<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { IconBrandLinkedin, IconBrandFacebook, IconBrandGit, IconBrandWindows, IconBrandGoogle } from '@tabler/icons-vue';

defineProps({
    canResetPassword: Boolean,
    status: String
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const routeto = (provider) => {
    if (provider === 'github') {
        window.location.href = route('github.redirect');
    }
    else if (provider === 'google') {
        window.location.href = route('google.redirect');
    }
    else if (provider === 'facebook') {
        window.location.href = route('facebook.redirect');
    }
    else if (provider === 'linkedin')
    {
        window.location.href = route('linkedin.redirect');
    }
    else if (provider === 'microsoft')
    {
        window.location.href = route('microsoft.redirect');
    }
};

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? 'on' : ''
    })).post(route('login'), {
        onFinish: () => form.reset('password')
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Log in </PrimaryButton>
            </div>
        </form>
        <div class="flex flex-col w-full my-4 space-y-3">
        <PrimaryButton class="ms-4" @click="routeto('github')" :disabled="form.processing">

            <IconBrandGit class="w-6 h-6 mr-6" />

            Log in with github
        </PrimaryButton>
        <PrimaryButton class="ms-4" @click="routeto('google')" :disabled="form.processing">

            <IconBrandGoogle class="w-6 h-6 mr-6" />

            Log in with google
        </PrimaryButton>
        <PrimaryButton class="ms-4" @click="routeto('facebook')" :disabled="form.processing">

            <IconBrandFacebook class="w-6 h-6 mr-6" />

            Log in with facebook
        </PrimaryButton>
        <PrimaryButton class="ms-4" @click="routeto('linkedin')" :disabled="form.processing">

            <IconBrandLinkedin class="w-6 h-6 mr-6" />

            Log in with linkedin
        </PrimaryButton>
        <PrimaryButton class="ms-4" @click="routeto('microsoft')" :disabled="form.processing">


            <IconBrandWindows class="w-6 h-6 mr-6" />

            Log in with microsoft
        </PrimaryButton>
        </div>
    </AuthenticationCard>
</template>
