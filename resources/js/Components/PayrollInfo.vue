<template>
    <div
        v-if="result && result.payday && result.payment_date"
        class="w-full bg-green-50 p-3 mb-10 border border-gray-300 text-gray-900 rounded-lg flex flex-col gap-2 items-center"
    >
        <div class="flex flex-col gap-4">
            <div class="flex w-full flex-col">
                <p class="label"><strong>💰 Payday:</strong></p>
                <p class="date">📅 {{ formattedPayday }}</p>
            </div>
            <div class="flex w-full flex-col">
                <p class="label"><strong>📤 Payment Date:</strong></p>
                <p class="date">📅 {{ formattedPaymentDate }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
      result: {
        type: Object,
        required: false,
      },
    },
    computed: {
      formattedPayday() {
        return this.formatDate(this.result.payday);
      },
      formattedPaymentDate() {
        return this.formatDate(this.result.payment_date);
      },
    },
    methods: {
      /**
       * Formats a date string into a localized date string with full date components
       *
       * @param {string} date - The ISO date string to format
       * @returns {string} The formatted date string including weekday, month, day and year
       * @example
       * // Returns "Friday, January 24, 2025"
       * formatDate("2025-01-24")
       */
      formatDate(date) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(date).toLocaleDateString(undefined, options);
      },
    },
  };
</script>