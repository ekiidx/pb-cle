<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
  post: Object,
  community: Object,
  errors: Object,
});

const form = useForm({
  title: props.post?.title,
  description: props.post?.description,
  url: props.post?.url,
});

const submit = () => {
  form.put(
    route("communities.posts.update", [props.community.slug, props.post.slug])
  );
};
</script>

<template>
  	<Head title="Edit Community" />

  	<AppLayout title="Dashboard">

		<!-- <template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			Edit Post for {{ community.name }}
			</h2>
		</template> -->

      	<div class="main-container">
        	<div class="row g-3">

				<!-- Main Column -->
				<div class="col-lg-8">

					<!--- Header -->
					<div
						class="
						mb-3
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						p-3
						"
					>
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">/</span>
							<Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link>
						</h2>
					</div>

					<!-- Post Card -->
					<div class="flex mb-3 bg-dark border rounded-lg text-sm">

						<!-- Main Section -->
						<div style="padding-right: 48px !important" class="w-full py-3 px-3">

							<form @submit.prevent="submit">
								<div>
									<Label for="title" value="Title" />
									<Input
										id="title"
										type="text"
										class="mt-1 block w-full"
										v-model="form.title"
										autofocus
										autocomplete="title"
									/>
									<InputError :message="errors.title" />
								</div>

								<div class="mt-4">
									<Label for="url" value="Post Link" />
									<Input
										id="url"
										type="url"
										class="mt-1 block w-full"
										v-model="form.url"
										autocomplete="url"
									/>
									<InputError :message="errors.url" />
								</div>

								<div class="mt-4">
									<Label for="description" value="Content" />
									<textarea
										id="description"
										type="text"
										rows="5"
										class="mt-1 block w-full"
										v-model="form.description"
										autocomplete="description"
									></textarea>
									<InputError :message="errors.description" />
								</div>

								<div class="flex items-center justify-end mt-4">
									<Button
										class="ml-4"
										:class="{ 'opacity-25': form.processing }"
										:disabled="form.processing"
									>
										Update
									</Button>
								</div>
							</form>	
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="border rounded-lg mb-3">
						<h2
						class="
							font-semibold
							text-lg
							p-6
							bg-darkorchid
							rounded-lg
							text-white
							p-3
						"
						>
							Edit {{ community.name }} Post
						</h2>
						<p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">You can edit your post.</p>
					</div>
				</div>
    		</div>
		</div>
  	</AppLayout>
</template>
