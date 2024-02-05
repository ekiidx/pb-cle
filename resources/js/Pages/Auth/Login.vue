<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Guest from "@/Layouts/Guest.vue";
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
// import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Guest>

        <Head title="Log in" />

        <AuthenticationCard>
            
            <div class="row">

                <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat bg-black" style="background-image: url('assets/img/3.jpg'); background-size: cover; background-position: center;"></div>

                <div class="col-xl-7 vh-100 align-items-center d-flex bg-black overflow-hidden">

        
                    <div class="card bg-black shadow-none border-0 ms-auto me-auto login-card">
                        <div class="card-body bg-black rounded-0 text-left">

                            <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ status }}
                            </div>
                        </div>

                        <h2 class="text-white fw-700 display1-size display2-md-size mb-3">Login into <br>your account</h2>

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

                            <!-- <InputLabel for="password" value="Password" /> -->
                            <div class="form-group icon-input mb-1">
                                <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                    placeholder="Password"
                                    required
                                    autocomplete="current-password"
                                />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                
                            <div class="form-check text-left mb-3">
                                <label class="form-check-label font-xsss text-grey-500">
                                    <Checkbox v-model:checked="form.remember" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                                </label>
                        
                                <Link v-if="canResetPassword" :href="route('password.request')" class="fw-600 font-xsss text-grey-700 mt-1 float-right">
                                    Forgot your password?
                                </Link>
                            </div>

                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-1">

                                    <PrimaryButton class="" :class="{ '': form.processing }" :disabled="form.processing">
                                        Log in
                                    </PrimaryButton>
                                </div>

                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Dont have account <a href="/register" class="fw-700 ms-1">Register</a></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticationCard>
    </Guest>
</template>