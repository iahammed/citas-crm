<template>
    <div class="flex flex-col md:flex-row md:space-x-6">
      <div>
        <Head :title="`${form.first_name} ${form.last_name}`" />
        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-indigo-400 hover:text-indigo-600" href="/students">Students</Link>
          <span class="text-indigo-400 font-medium">/</span>
          {{ form.first_name }} {{ form.last_name }} / New Payment
        </h1>
        <span class="mb-8 text-indigo-400 font-medium">
          Fees: {{ student.fees }} / Received: {{ student.received }} / Escrow {{  student.escrow }}
        </span>
        <trashed-message v-if="student.deleted_at" class="mb-6" @restore="restore"> This student has been deleted. </trashed-message>
        <div class="max-w-3xl mt-8 bg-white rounded-md shadow overflow-hidden">
          <form @submit.prevent="updatePayment">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.first_name" disabled :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First name" />
              <text-input v-model="form.last_name" disabled :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last name" />
              <date-input v-model="form.paydate" :error="form.errors.paydate" class="pb-8 pr-6 w-full lg:w-1/2" label="Payment date"></date-input>
              <select-input v-model="form.pMethod"  :error="form.errors.pMethod" class="pb-8 pr-6 w-full lg:w-1/2" label="Method of Payment">
                <option :value="null" />
                <option v-for="pm in pMethods" :key="pm.id" :value="pm.id">{{ pm.name }}</option>
              </select-input>
            <text-input @keyup="checkPayment" v-model="form.amount" :error="form.errors.amount" class="pb-8 pr-6 w-full lg:w-1/2" label="Amount" />
              <textarea-input v-model="form.note" :error="form.errors.note" class="pb-8 pr-6 w-full lg:w-full" label="Note" />
            </div>
            <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update student</loading-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { Head, Link } from '@inertiajs/inertia-vue3'
  import Layout from '@/Shared/Layout'
  import TextInput from '@/Shared/TextInput'
  import TextareaInput from '@/Shared/TextareaInput.vue'
  import SelectInput from '@/Shared/SelectInput'
  import LoadingButton from '@/Shared/LoadingButton'
  import TrashedMessage from '@/Shared/TrashedMessage'
  import DateInput from '@/Shared/DateInput'
  import moment from 'moment'
  
  export default {
    components: {
      Head,
      Link,
      LoadingButton,
      SelectInput,
      TextInput,
      TrashedMessage,
      DateInput,
      TextareaInput     
    },
    layout: Layout,
    props: {
      student: Object,
      pMethods: Array
    },
    remember: 'form',
    data() {
      return {
        form: this.$inertia.form({
          first_name: this.student.first_name,
          last_name: this.student.last_name,
          paydate: this.student.paydate,
          pMethod: 2,
          amount: this.student.amount,
          note: this.student.note,
        }),
      }
    },
    methods: {
      date(item) {
          return moment(item).format('MMM Do, YYYY');
      },
      updatePayment() {
        this.form.post(`/students-payment-save/${this.student.id}`)
      },
    },
  }
  </script>
  