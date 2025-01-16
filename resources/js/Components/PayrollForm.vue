<template>
    <form @submit.prevent="onSubmit">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="year" class="block mb-2 text-sm font-medium">Year</label>
                <input
                    type="number"
                    v-model="localYear"
                    id="year"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Year"
                    min="2000"
                    max="2100"
                    required
                />
            </div>
            <div>
                <label for="month" class="block mb-2 text-sm font-medium">Month</label>
                <input
                    type="number"
                    v-model="localMonth"
                    id="month"
                    min="1"
                    max="12"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Month"
                    required
                />
            </div>
        </div>
        <button
            type="submit"
            :disabled="loading"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            {{ loading ? 'Loading...' : 'Get Payroll Dates' }}
        </button>
    </form>
</template>

<script>
export default {
    props: {
        year: {
            type: Number,
            required: true,
        },
        month: {
            type: Number,
            required: true,
        },
        loading: Boolean,
    },
    data() {
        return {
            localYear: this.year,
            localMonth: this.month,
        };
    },
    watch: {
        year(value) {
            this.localYear = value;
        },
        month(value) {
            this.localMonth = value;
        },
        localYear(value) {
            this.$emit('update', { year: value, month: this.localMonth });
        },
        localMonth(value) {
            this.$emit('update', { year: this.localYear, month: value });
        },
    },
    methods: {
        onSubmit() {
            this.$emit('submit');
        },
    },
};
</script>
