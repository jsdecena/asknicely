<template>
  <div class="container">
    <div class="row">
      <h2>Ask Nicely Technical Exam</h2>
    </div>
    <div class="row">
      <Error :error="error" />
      <Message :message="successMessage" />
      <div v-if="!isEditingEmail">
        <Loader :is-loading="isLoading" />
        <EmployeesTable
          :on-edit-email="toggleEditEmail"
          :employees="employees"
          :on-upload-csv="handleOnUpload"
        />
      </div>
      <div v-if="isEditingEmail">
        <EditEmail :id="id" :email="email" :on-back="handleBack" :on-update-email="updateEmail" />
      </div>
    </div>
  </div>
</template>
<script>
import EditEmail from '@/components/EditEmail.vue'
import Error from '@/components/Error.vue'
import Message from '@/components/Message.vue'
import Loader from '@/components/Loader.vue'
import EmployeesTable from '@/components/EmployeesTable.vue'

export default {
  name: 'EmployeesList',
  components: { EmployeesTable, Loader, Message, Error, EditEmail },
  data: () => ({
    isLoading: false,
    isSubmitting: false,
    isEditingEmail: false,
    isImportingData: false,
    successMessage: null,
    error: null,
    employees: [],
    email: null,
    id: null
  }),
  methods: {
    handleBack() {
      this.isEditingEmail = false
    },
    toggleEditEmail(id, email) {
      this.successMessage = null
      this.id = id
      this.email = email
      this.isEditingEmail = !this.isEditingEmail
    },
    handleOnUpload(data) {
      this.successMessage = 'Upload successful.'
      this.employees = data
    },
    async updateEmail(data) {
      this.isSubmitting = true
      this.employees = data
      this.isEditingEmail = false
      this.isSubmitting = false
    },
    async getEmployeesData() {
      this.isLoading = true
      try {
        const response = await fetch('http://localhost:8000')

        if (!response.ok) {
          throw new Error('Network response was not ok')
        }

        const toJson = await response.json()
        this.employees = toJson.data
      } catch (error) {
        this.error = error.message
      }

      this.isLoading = false
    }
  },
  async mounted() {
    await this.getEmployeesData()
  }
}
</script>
