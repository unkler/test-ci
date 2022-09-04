import './bootstrap'
import Vue from 'vue'
import Vuelidate from 'vuelidate'
import ArticleLike from './components/ArticleLike'
import ArticleStock from './components/ArticleStock'
import ArticleTagsInput from './components/ArticleTagsInput'
import FollowButton from './components/FollowButton'
import ArticleComment from './components/ArticleComment'

Vue.use(Vuelidate)

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
