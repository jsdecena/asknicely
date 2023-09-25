<template>
  <form @submit.prevent="handleSubmit">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input
        :disabled="isSubmitting"
        type="email"
        class="form-control"
        id="email"
        v-model="formData.email"
      />
    </div>
    <button style="margin-right: 10px" class="btn btn-light" @click="onBack">Back</button>
    <button class="btn btn-primary">
      <span v-if="isSubmitting">Processing ...</span>
      <span v-else>Update</span>
    </button>
  </form>
</template>
<script>
import { ref } from 'vue'
export default {
  name: 'EditEmail',
  props: {
    id: {
      type: Number,
      required: true
    },
    email: String,
    onBack: {
      type: Function,
      required: true
    },
    onUpdateEmail: {
      type: Function,
      required: true
    }
  },
  data: () => ({
    isSubmitting: false
  }),
  setup(props) {
    const formData = ref({
      email: props.email
    })

    const handleSubmit = async () => {
      // Handle form submission logic here
      try {
        const response = await fetch(`http://localhost:8000/employees/${props.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            email: formData.value.email
          })
        })

        if (response.ok) {
          const toJson = await response.json()
          props.onUpdateEmail(toJson.data)
        } else {
          alert('Failed to upload CSV.')
        }
      } catch (error) {
        alert('An error occurred: ' + error.message)
      }
    }

    return {
      formData,
      handleSubmit
    }
  }
}
</script>
