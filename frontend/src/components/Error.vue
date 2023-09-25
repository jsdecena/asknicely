<template>
  <p v-if="error" class="alert alert-danger">{{ error }}</p>
</template>
<script>
export default {
  name: 'ErrorMessage',
  props: {
    error: String
  }
}
</script>
