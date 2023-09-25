<template>
  <label class="form-label" for="csv">Import a CSV</label>
  <input
    type="file"
    class="form-control"
    id="csv"
    placeholder="Choose a file"
    @change="handleFileChange"
  />
  <button :disabled="!this.selectedFile" class="btn btn-primary import-btn" @click="importCSV">
    Import CSV
  </button>
</template>
<script>
export default {
  name: 'ImportCSV',
  data: () => ({
    selectedFile: null
  }),
  props: {
    onUpload: {
      type: Function,
      required: true
    }
  },
  methods: {
    handleFileChange(event) {
      this.selectedFile = event.target.files[0]
    },
    async importCSV() {
      if (!this.selectedFile) {
        alert('Please select a file first.')
        return
      }

      const formData = new FormData()
      formData.append('csv', this.selectedFile)

      try {
        const response = await fetch('http://localhost:8000/import', {
          method: 'POST',
          body: formData
        })

        if (response.ok) {
          const toJson = await response.json()

          this.onUpload(toJson.data)
        } else {
          alert('Failed to upload CSV.')
        }
      } catch (error) {
        alert('An error occurred: ' + error.message)
      }
    }
  }
}
</script>
