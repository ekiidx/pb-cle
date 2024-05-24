<script setup>
import { ref } from 'vue';
import Guest from "@/Layouts/Guest.vue";
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
// import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Guest>
        <Head title="Secure Area" />

        <AuthenticationCard>

            <div class="row">

                <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat bg-black" style="background-image: url('../assets/img/3.jpg'); background-size: cover; background-position: center;"></div>

                <div class="col-xl-7 vh-100 align-items-center d-flex bg-black overflow-hidden">
                    <div class="card bg-black shadow-none border-0 ms-auto me-auto login-card">
                        <div class="card-body bg-black rounded-0 text-left">

                            <h2 class="text-white fw-700">This is a secure area of the application. Please confirm your password before continuing.</h2>
                        
                            <form @submit.prevent="submit">
                                <div>
                                    <InputLabel for="password" value="Password" />
                                    <TextInput
                                        id="password"
                                        ref="passwordInput"
                                        v-model="form.password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="current-password"
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div class="flex justify-end mt-4">
                                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Confirm
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
