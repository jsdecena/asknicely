<template>
  <p v-if="message" class="alert alert-success">{{ message }}</p>
</template>
<script>
export default {
  name: 'SuccessMessage',
  props: {
    message: String
  }
}
</script>
