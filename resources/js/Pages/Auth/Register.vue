<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Guest from "@/Layouts/Guest.vue";
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
// import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
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
        <Head title="Register" />

        <AuthenticationCard>
            <div class="row">

                <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat bg-black" style="background-image: url('assets/img/2.jpg'); background-size: cover; background-position: center;"></div>

                <div class="col-xl-7 vh-100 align-items-center d-flex bg-black overflow-hidden">
                    <div class="card bg-black shadow-none border-0 ms-auto me-auto login-card">
                        <div class="card-body bg-black rounded-0 text-left">
                            <h2 class="text-white fw-700 display1-size display2-md-size mb-4">Create <br>your account</h2>                        


                            <form @submit.prevent="submit">

                                    <!-- <InputLabel for="username" value="Username" /> -->
                                    <div class="form-group icon-input mb-3">
                                        <i class="font-sm ti-user text-grey-500 pe-0"></i>
                                        <TextInput
                                            id="username"
                                            v-model="form.username"
                                            type="text"
                                            class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                            placeholder="Userame"
                                            required
                                            autofocus
                                            autocomplete="username"
                                        />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                           
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
                                            autocomplete="username"
                                        />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                        
                                    <!-- <InputLabel for="password" value="Password" /> -->
                                    <div class="form-group icon-input mb-3">
                                        <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                        <TextInput
                                            id="password"
                                            v-model="form.password"
                                            type="password"
                                            class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                            placeholder="Password"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>
                                    
                                    <!-- <InputLabel for="password_confirmation" value="Confirm Password" /> -->
                                    <div class="form-group icon-input mb-1">
                                        <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                        <TextInput
                                            id="password_confirmation"
                                            v-model="form.password_confirmation"
                                            type="password"
                                            class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                            placeholder="Confirm Password"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                    </div>

                                    <div class="form-check text-left mb-3">
                      
                                        <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="">
                                            <InputLabel for="terms">
                                                <div class="flex items-center">
                                                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                                                    <div class="ml-2">
                                                        I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy Policy</a>
                                                    </div>
                                                </div>
                                                <InputError class="mt-2" :message="form.errors.terms" />
                                            </InputLabel>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 p-0 text-left">
                                        <div class="form-group mb-1">

                                            <Link :href="route('login')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                Already registered?
                                            </Link>

                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Register
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
