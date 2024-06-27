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
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Profile
            </h2>
        </template> -->
        <div class="main-container">
            <div class="row g-3">
                <div class="col-lg-8">

                    <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                        <UpdateProfileInformationForm :user="$page.props.auth.user" />
                    </div>

                    <div v-if="$page.props.jetstream.canUpdatePassword">
                        <UpdatePasswordForm />
                    </div>

                    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                        <TwoFactorAuthenticationForm
                            :requires-confirmation="confirmsTwoFactorAuthentication"
                        />
                    </div>

                    <LogoutOtherBrowserSessionsForm :sessions="sessions" />

                    <!-- <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <DeleteUserForm class="mt-10 sm:mt-0" />
                    </template> -->
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
					<div class="about-box border rounded-lg bg-dark">
						<div class="bg-darkorchid rounded-lg p-3">
							<img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
							<h2
							class="
								font-semibold
								text-lg
								text-white
								d-inline
								"
							>
								Settings
							</h2>
						</div>
						<p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">Update profile settings.</p>
					</div>
				</div>
            </div>
        </div>
    </AppLayout>
</template>
