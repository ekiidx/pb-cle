<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm, Head } from "@inertiajs/vue3";
import PostVote from "@/Components/PostVote.vue";
import CommentVote from "@/Components/CommentVote.vue";
import PostList from "@/Components/PostList.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
	community: Object,
	post: Object,
	posts: Object,
	comments: Object,
	can_delete: Boolean,
	can_update: Boolean,
	is_user: Number,
	errors: Object,
});

const form = useForm({
  content: "",
  comment_image: "",
});

function commentImagePreview() {
  commentImageFrame.src=URL.createObjectURL(event.target.files[0])
}

const submit = () => {
  form.post(
    route("frontend.posts.comments", [
      props.community.slug,
      props.post.data.slug,
    ]),
    {
      onSuccess: () => form.reset(),
	  preserveScroll: true,
    }
  );
};
</script>

<template>
  	<AppLayout title="Dashboard">

		<Head>
			<title>{{ community.name }} - {{ post.data.title }}</title>
		</Head>

   		<div class="main-container">
			<div class="row gutter">
				<!-- Main Column -->
				<div class="col-lg-8">
					<!--- Header -->
					<div
						class="
						header-post-box
						flex
						items-center
						bg-dark
						rounded-lg
						border border-gray-200
						justify-between
						"
					>
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight">
							<Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link>
						</h2>
						<Link
							:href="route('communities.posts.create', community.slug)"
							class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
							>Create Post</Link
						>
					</div>
					
					<!-- Post Card -->
					<div 
						class="
						post-main-container
						flex
						bg-dark
						border
						rounded-lg
						"
					>

						<!-- Vote -->
						<div>
							<PostVote :post="post.data" />
						</div>

						<!-- Main Section -->
						<div class="w-full">

							<!-- Header -->
							<div class="flex flex-wrap post-header text-sm">
								<!-- Posted by -->
								<a :href="'/ravers/'+post.data.user_slug">
								<span class="font-semibold mr-1 text-darkorchid">
									{{ post.data.username }}
								</span></a>
								<span class="mr-2">
									{{ post.data.created_at }}
								</span>
									
								<!-- Edit Post -->
								<div v-if="$page.props.auth">
									<Link v-if="can_update"
										:href="
										route('communities.posts.edit', [
											community.slug,
											post.data.slug,
										])
										"
										class="
										font-semibold
										text-electricgreen
										mr-2
										"
										>Edit</Link
									>
								</div>
								<div v-if="$page.props.auth">
									<Link v-if="can_delete"
										:href="
										route('communities.posts.destroy', [
											community.slug,
											post.data.slug,
										])
										"
										class="
										font-semibold
										text-darkorchid
										"
										method="delete"
										as="button"
										type="button"
										onclick="return confirm('Are you sure you wish to delete this post?')"
										>Delete</Link
									>
								</div>
							</div>

							<div class="mb-2">
								<!-- Title -->
								<h1 class="pr-4 font-bold tracking-tight text-white post-title" style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: anywhere;">
									{{ post.data.title }}
								</h1>

								<!-- Description -->
								<p v-if="post.data.description" class="post-content text-grey-300 text-sm" style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: anywhere;">{{ post.data.description }}</p>
								
								<!-- Link -->
								<div v-if="post.data.url" class="post-link">
									<a
										:href="post.data.url"
										class="font-semibold text-electricgreen text-sm"
										style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: anywhere;  word-break: break-all;"
										>{{ post.data.url }}</a
									>
								</div>
							</div>

							<!-- Image -->
							<a v-if="post.data.post_image" :href="'/storage/post-images/'+ post.data.post_image">
                    			<img v-if="post.data.post_image" class="mb-3" style="width: 100%; height: auto;" :src="'/storage/post-images/'+post.data.post_image">
                			</a>

							<!-- Divider -->
							<!-- <div style="padding-right: 48px !important;"> -->
								<!-- <div class="px-3" v-if="post.data.comments != 0">
									<hr />
								</div> -->
								
								<!-- Comments -->
								<div class="post-comments">
									<div v-if="props.comments != 0">
										<ul role="list">
											<li
												v-for="(comment, index) in props.comments"
												:key="index"
												class="flex flex-col mb-3"
											>
												<div class="flex text-sm mb-1">
													<!-- Commented by -->
													<a :href="'/ravers/'+comment.user_slug">
													<span class="font-semibold text-darkorchid mr-1">{{
														comment.username
													}}</span></a>
													{{ comment.created_at_diff }}

													<!-- Edit Comment -->
													<Link
														v-if="comment.user_id === props.is_user"
														:href="
														route('posts.comments.edit', [
															community.slug,
															post.data.slug,
															comment.id
														])
														"
														class="
														font-semibold
														text-electricgreen
														ml-2
														"
														style="
														font-size: 0.85rem"
														>Edit</Link
													>
												</div>

												<div v-if="comment.content"
													class="whitespace-pre-wrap break-words">
													<p class="text-grey-300 text-sm">{{ comment.content }}</p>
												</div>

												<!-- Image -->
												<a v-if="comment.comment_image" :href="'/storage/comment-images/'+ comment.comment_image" class="mt-1">
													<img v-if="comment.comment_image" style="width: 100%; max-width: 400px; height: auto;" 
													:src="'/storage/comment-images/'+comment.comment_image">
												</a>

												<div class="mt-1">
													<CommentVote :comment="comment" />
												</div>
											</li>
										</ul>
									</div>
								</div>
							<!-- </div> -->

							<!-- Textarea -->
							 <div class="comment-textarea">
								<div v-if="$page.props.auth.user.username">
									<form @submit.prevent="submit">
										<div class="mb-1">
											<textarea
											v-model="form.content"
											id="comment"
											rows="5"
											class="mt-1 block w-full bg-dark text-white"
											placeholder="Your comment..."
											></textarea>
										</div>

										<!-- Flyer Upload -->
										<div class="mb-4">
											<img v-if="form.comment_image"
												style="max-width: 7rem; max-height: 5rem; height: auto;"
												class="mt-2"
												id="commentImageFrame"
												src="">
												<InputError :message="errors.comment_image" />
												<label for="comment-image-upload" class="cursor-pointer image-upload-button"><i class="ti-image text-xl"></i></label>
											<input id="comment-image-upload" style="display:none" name="comment_image" type="file" @input="form.comment_image = $event.target.files[0]" @change="commentImagePreview()" hidden />
										</div>
										
										<div class="mb-3">
											<button
											class="
												comment-btn
												items-center
												border-transparent
												bg-darkorchid
												fw-600
												text-white
												font-xsss
												text-center
												lh-20
												rounded-xl
											">
												Comment
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			
				<!-- Sidebar -->
				<div class="col-lg-4">
					<div 
						class="
						about-box
						border
						rounded-lg
						bg-dark
						"
					>
						<div class="bg-darkorchid rounded-lg p-3">
							<img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
							<h2
							class="
								font-semibold
								text-white
								d-inline
								"
							>
								About {{ community.name }}
							</h2>
						</div>
						<p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">{{ community.description }}</p>
					</div>
					
					<PostList :posts="posts.data" :community="community">
						<template #title>Popular Posts</template>
					</PostList>
				</div>
			</div>
    	</div>
	</AppLayout>
</template>
