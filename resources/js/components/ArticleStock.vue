<template>
  <div class="col-1">
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="fas fa-bookmark mr-1"
         :class="{'yellow-text':this.isStockedBy, 'animated heartBeat fast':this.gotToStock}"
         @click="clickStock"
      />
    </button>
    {{ countStocks }}
  </div>
</template>
<script>
export default {
  props: {
    initialIsStockedBy: {
      'type': Boolean,
      'default': false,
    },
    initialCountStocks: {
      'type': Number,
      'default': 0,
    },
    authorized: {
      'type': Boolean,
      'default': false,
    },
    endpoint: {
      'type': String,
    },
  },
  data() {
    return {
      isStockedBy: this.initialIsStockedBy,
      countStocks: this.initialCountStocks,
      gotToStock: false,
    }
  },
  methods: {
    clickStock() {
      if (!this.authorized) {
        alert('ストック機能はログイン中のみ使用できます。')
        return
      }
      this.isStockedBy 
        ? this.unstocks()
        : this.stocks()
    },
    async stocks() {
      const response = await axios.put(this.endpoint)

      this.isStockedBy = true
      this.countStocks = response.data.countStocks
      this.gotToStock = true
    },
    async unstocks() {
      const response = await axios.delete(this.endpoint)

      this.isStockedBy = false
      this.countStocks = response.data.countStocks
      this.gotToStock = false
    }
  }
 }
</script>
