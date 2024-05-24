<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Guest from "@/Layouts/Guest.vue";
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
// import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Guest>
        <Head title="Reset Password" />

        <AuthenticationCard>

            <div class="row">

                <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat bg-black" style="background-image: url('../assets/img/3.jpg'); background-size: cover; background-position: center;"></div>

                    <div class="col-xl-7 vh-100 align-items-center d-flex bg-black overflow-hidden">
                        <div class="card bg-black shadow-none border-0 ms-auto me-auto login-card">
                            <div class="card-body bg-black rounded-0 text-left">

                                <h2 class="text-white fw-700 display1-size display2-md-size mb-3">Password Reset</h2>

                                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                Create a new password and confirm it.
                            </div>

                            <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ status }}
                            </div>


                            <form @submit.prevent="submit">

                                <div class="block">
                                    <!-- <InputLabel for="email" value="Email" /> -->
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        class="block mt-1 w-full"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="mt-4">
                                    <!-- <InputLabel for="password" value="Password" /> -->
                                    <TextInput
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        class="block mt-1 w-full"
                                        required
                                        autocomplete="new-password"
                                    />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div class="mt-4">
                                    <!-- <InputLabel for="password_confirmation" value="Confirm Password" /> -->
                                    <TextInput
                                        id="password_confirmation"
                                        v-model="form.password_confirmation"
                                        type="password"
                                        class="block mt-1 w-full"
                                        required
                                        autocomplete="new-password"
                                    />
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Reset Password
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticationCard>
    </Guest>
</template>
