<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
// import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Settings">

         <!-- Header -->
         <!-- <div class="bg-dark border rounded-lg mb-3 p-3">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Settings
            </h2>
        </div> -->

        <div class="main-container">
            <div class="row g-3">
                
                <div class="col-lg-8">
        
         
                    <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                        <UpdateProfileInformationForm :user="$page.props.auth.user" />
                        <!-- <SectionBorder /> -->
                    </div>

                    <div v-if="$page.props.jetstream.canUpdatePassword">
                        <UpdatePasswordForm class="mt-10 sm:mt-0" />
                    </div>

                    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                        <TwoFactorAuthenticationForm
                            :requires-confirmation="confirmsTwoFactorAuthentication"
                            class="mt-10 sm:mt-0"
                        />
                    </div>

                    <LogoutOtherBrowserSessionsForm :sessions="sessions" class="" />

                    <!-- <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <DeleteUserForm class="mt-10 sm:mt-0" />
                    </template> -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
