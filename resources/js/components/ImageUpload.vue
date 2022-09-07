<template>
  <div>
    <div v-if="userFilePath">
      <img :src="userFilePath" class="user-large-image" />
    </div>
    <div v-else>
      <i class="fas fa-user-circle fa-3x"></i>
    </div>
    <h2 class="h5 card-title m-0">
      {{ userName }}
    </h2>
    <div v-if="userId === loginUserId" class="form-group mt-3">
      <label for="inputFile">プロフィール画像</label>
      <div class="custom-file">
        <input
          type="file"
          class="custom-file-input"
          id="inputFile"
          @change="changeImage"
        />
        <label class="custom-file-label" for="inputFile" data-browse="参照"
          >ファイルを選択(ここにドロップすることもできます)</label
        >
        <div v-if="previewImage" class="mt-3">
          <img :src="previewImage" />
        </div>
        <button
          class="btn-square btn-block mt-3"
          data-toggle="modal"
          data-target="#modal-user-image-upload"
        >
          アップロード
        </button>
      </div>
    </div>

    <!-- modal -->
    <div v-if="previewImage !== ''"
      id="modal-user-image-upload"
      class="modal fade"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="閉じる"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            選択した画像を登録します。よろしいですか？
          </div>
          <div class="modal-footer justify-content-between">
            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
            <button
              type="submit"
              class="btn btn-danger"
              @click="uploadFile"
              data-dismiss="modal"
            >
              登録する
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: {
    userId: {
      type: Number,
      default: 0,
    },
    userName: {
      type: String,
      default: '',
    },
    userFilePath: {
      type: String,
      default: '',
    },
    loginUserId: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      fileInfo: '',
      previewImage: '',
    };
  },
  methods: {
    changeImage(event) {
      this.fileInfo = event.target.files[0];

      if (this.fileInfo && this.fileInfo.type.match(/^image\/(png|jpeg)$/)) {
        this.previewImage = URL.createObjectURL(this.fileInfo);
        return;
      }
    },
    async uploadFile() {
      const formData = new FormData();

      formData.append('file', this.fileInfo);

      await axios
        .post('/users/upload_file', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then(() => {
          alert('画像を登録しました')
          this.previewImage = ''
          
        })
        .catch(error => {
          console.log(error)
        })
    },
  },
};
</script>

<style scoped>
.btn-square {
  display: inline-block;
  padding: 0.5em 1em;
  text-decoration: none;
  background: #3d9adc;
  color: #fff;
  border-bottom: solid 4px #627295;
  border-radius: 3px;
}
</style>