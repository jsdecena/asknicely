<template>
  <div v-if="isLoading">Fetching data ...</div>
</template>
<script>
export default {
  name: 'LoaderApp',
  props: {
    isLoading: Boolean
  }
}
</script>
