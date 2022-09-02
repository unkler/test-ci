<template>
  <div>
		<div>
			<button type="button" class="btn btn-info btn-sm" @click="isDisplayCommentArea = !isDisplayCommentArea">コメントを書く</button>
		</div>
		<transition name="fade-input-comment">
			<div v-show="isDisplayCommentArea">
				<div class="form-group">
					<form method="POST" :action="endpoint">
						<input type="hidden" name="_token" :value="csrf">
						<input type="hidden" name="article_id" :value="articleId">
						<textarea name="body" class="form-control" rows="5" placeholder="本文"></textarea>
						<div>
							<button class="btn btn-info btn-sm">送信</button>
						</div>
					</form>
				</div>
			</div>
		</transition>
  </div>
</template>

<script>
  export default {
    props: {
    	csrf: {
      	type: String,
        required: true,
    	},
      articleId: {
      	type: Number,
      },
      endpoint: {
      	type: String,
      },
    },
    data() {
    	return {
      	isDisplayCommentArea : false,
      }
    },
   }
</script>

<style scoped>
.fade-input-comment-enter-active, .fade-input-comment-leave-active {
    transition: opacity .8s
}

.fade-input-comment-enter, .fade-input-comment-leave-to {
    opacity: 0
}
</style>