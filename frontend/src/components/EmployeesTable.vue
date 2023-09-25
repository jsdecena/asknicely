<template>
  <div v-if="employees.length">
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Company</th>
          <th scope="col">Employee</th>
          <th scope="col">Email</th>
          <th scope="col">Average Salary</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in employees" :key="item.id">
          <th scope="row">{{ item.id }}</th>
          <td>{{ item.company_name }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.email }}</td>
          <td>{{ item.salary }}</td>
          <td>
            <button
              @click="toggleEditEmail(item.id, item.email)"
              style="width: 100px"
              class="btn btn-primary btn-sm"
            >
              Edit Email
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-else>
    <p class="alert alert-warning">No items to show, try importing a csv?</p>
    <ImportCSV :on-upload="handleOnUpload" />
  </div>
</template>
<script>
import ImportCSV from '@/components/ImportCSV.vue'

export default {
  name: 'EmployeesTable',
  components: { ImportCSV },
  props: {
    employees: Array,
    successMessage: null,
    email: null,
    onEditEmail: {
      type: Function,
      required: true
    },
    onUploadCsv: {
      type: Function,
      required: true
    }
  },
  methods: {
    handleOnUpload(data) {
      this.onUploadCsv(data)
    },
    toggleEditEmail(id, email) {
      this.onEditEmail(id, email)
    }
  }
}
</script>
