<template>
  <div>
		<div>
			<button type="button" class="btn btn-info btn-sm" @click="isDisplayCommentArea = !isDisplayCommentArea">コメントを書く</button>
		</div>
		<div class="alert alert-primary alert-dismissible fade show" role="alert" v-show="createdBody !== null">
			<h6>コメントを登録しました</h6>
			<p>{{ createdBody }}</p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<transition name="fade-input-comment">
			<div v-show="isDisplayCommentArea">
				<div class="form-group">
					<div v-if="$v.body.$dirty">
            <div class="invalid-feedback d-block" v-if="!$v.body.required">コメントを入力してください。</div>
						<div class="invalid-feedback d-block" v-if="!$v.body.maxLength">
							コメントは {{$v.body.$params.maxLength.max}} 文字以内で入力してください。</div>
          </div>
					<textarea name="body" class="form-control" rows="5" placeholder="本文" v-model="$v.body.$model"></textarea>
					<button class="btn btn-info btn-sm" @click="registerComment" :disabled="commentButtonDisabled">送信</button>
				</div>
			</div>
		</transition>
  </div>
</template>

<script>
	import { required, maxLength } from "vuelidate/lib/validators";
  export default {
    props: {
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
				body: null,
				createdBody: null,
				commentButtonDisabled: false,
      }
    },
		methods: {
			async registerComment() {
				this.commentButtonDisabled = true

				const data = {
					article_id : this.articleId,
          body: this.body,
        }

				await axios.post(this.endpoint, data)
					.then(res => {
						this.createdBody = res.data.body
					})
					.catch(error => { console.log(error); })
			
			}
		},
		validations: {
			body: {
				required,
				maxLength: maxLength(500),
			},
		}
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