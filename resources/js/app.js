import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleStock from './components/ArticleStock'
import ArticleTagsInput from './components/ArticleTagsInput'
import FollowButton from './components/FollowButton'
import ArticleComment from './components/ArticleComment'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    ArticleStock,
    ArticleTagsInput,
    FollowButton,
    ArticleComment,
  }
})
