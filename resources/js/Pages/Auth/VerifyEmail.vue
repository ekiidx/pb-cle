<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Guest from "@/Layouts/Guest.vue";
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
// import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Guest>
        <Head title="Email Verification" />

        <AuthenticationCard>

            <div class="row">

                <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat bg-black" style="background-image: url('/assets/img/3.jpg'); background-size: cover; background-position: center;"></div>

                <div class="col-xl-7 vh-100 align-items-center d-flex bg-black overflow-hidden">

                    <div class="card bg-black shadow-none border-0 ms-auto me-auto login-card">

                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                        </div>

                        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            A new verification link has been sent to the email address you provided in your profile settings.
                        </div>

                        <form @submit.prevent="submit">
                            <div class="mt-4 flex items-center justify-between">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Resend Email
                                </PrimaryButton>

                                <div>
                                    <Link
                                        :href="route('profile.show')"
                                        class="mr-3"
                                    >
                                        Edit Profile</Link>

                                    <Link
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                        class=""
                                    >
                                        Log Out
                                    </Link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticationCard>
    </Guest>
</template>
