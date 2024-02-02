<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Guest from "@/Layouts/Guest.vue";
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
// import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<style>
    .nav-header {
        background-color: transparent !important;
    }
    .header-search {
        display: none;
    }
    .menu-icon i {
        display: none;
    }
    @media only screen and (min-width: 992px) {
        .main-wrapper {
            padding-left: 0rem;
            padding-right: 0rem;
        }
    }
    @media only screen and (min-width: 1440px) {
        .main-wrapper {
            padding-left: 0rem;
            padding-right: 0rem;
        }
    }
</style>

<template>
    <Guest>
        <Head title="Forgot Password" />

        <AuthenticationCard>

            <div class="row">

                <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat bg-black" style="background-image: url('assets/img/3.jpg'); background-size: cover; background-position: center;"></div>

                <div class="col-xl-7 vh-100 align-items-center d-flex bg-black overflow-hidden">
                    <div class="card bg-black shadow-none border-0 ms-auto me-auto login-card">
                        <div class="card-body bg-black rounded-0 text-left">

                            <h2 class="text-white fw-700 display1-size display2-md-size mb-3">Forgot your password?</h2>

                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                No problem, just let us know your email address and we will email you a password reset link.
                            </div>

                            <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ status }}
                            </div>

                            <form @submit.prevent="submit">
                               
                                <!-- <InputLabel for="email" value="Email" /> -->
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                        placeholder="Your Email Address"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                
                                <div class="col-sm-12 p-0 text-left">
                                    <div class="form-group mb-1">

                                        <PrimaryButton :class="{ '': form.processing }" :disabled="form.processing">
                                        Submit
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticationCard>
    </Guest>
</template>
