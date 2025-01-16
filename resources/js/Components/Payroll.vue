<template>
    <div>
      <!-- Instructions -->
      <div class="mb-4">
        <p>
          Select the year and month to get payroll dates for employees. The payday is the date when employees are paid,
          and the payment date is the date when the payment is required to be made.
        </p>
        <p>
          Payday is the second to last working day of the month, and payments take four business days to process.
        </p>
      </div>

      <!-- Error Message -->
      <AlertMessage v-if="error" :message="error" type="error" />

      <!-- Payroll Information -->
      <PayrollInfo v-if="result" :result="result" />

      <!-- Form -->
      <PayrollForm 
        :year="year" 
        :month="month" 
        :loading="loading" 
        @update="updateDates"
        @submit="fetchPayroll" 
      />
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import PayrollInfo from './PayrollInfo.vue';
  import PayrollForm from './PayrollForm.vue';
  import AlertMessage from './AlertMessage.vue';
  
  export default {
    components: {
      PayrollInfo,
      PayrollForm,
      AlertMessage,
    },
    data() {
      return {
        year: 0,
        month: 0,
        error: null,
        result: null,
        loading: false,
      };
    },
    mounted() {
      this.setDefaultDates();
    },
    methods: {
      /**
       * Sets the default year and month values to the current date
       * 
       * The year is set to the current year and month is set to the current month (1-12).
       * Note that JavaScript months are 0-based, so we add 1 to get the correct month number.
       * 
       * @returns {void}
       */
      setDefaultDates() {
        const now = new Date();
        this.year = now.getFullYear();
        this.month = now.getMonth() + 1;
      },
      /**
       * Updates the year and month values when changed in the form
       *
       * @param {Object} params - The date parameters
       * @param {number} params.year - The selected year
       * @param {number} params.month - The selected month (1-12)
       * @returns {void}
       */
      updateDates({ year, month }) {
        this.year = year;
        this.month = month;
      },
      /**
       * Fetches payroll data from the API for the selected year and month.
       *
       * This method:
       * - Sets loading state while fetching
       * - Makes an authenticated API request with year/month parameters
       * - Updates the result data on success
       * - Handles and displays errors if the request fails
       * - Clears loading state when complete
       * 
       * @async
       * @returns {Promise<void>}
       * @throws {Error} When the API request fails
       */
      async fetchPayroll() {
        try {
          this.loading = true;
          const params = { year: this.year, month: this.month };
          const response = await axios.get('/api/payroll', { params, withCredentials: true });
          this.result = response.data.data;
          this.error = null; // Clear error if successful
        } catch (error) {
          this.error = 'Failed to fetch payroll data. Please try again.';
          console.error('Error fetching payroll data:', error);
        } finally {
          this.loading = false;
        }
      },
    },
  };
  </script>
  