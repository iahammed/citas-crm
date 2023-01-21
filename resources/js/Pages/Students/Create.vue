<template>
    <div>
      <Head title="Create Contact" />
      <h1 class="mb-8 text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/students">Students</Link>
        <span class="text-indigo-400 font-medium">/</span> Create
      </h1>
      <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="store">
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <!-- Personal -->
            <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First name" />
            <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last name" />
            <date-input v-model="form.dob" :error="form.errors.dob" class="pb-8 pr-6 w-full lg:w-1/2" label="Date of birth"></date-input>
            <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
              <option :value="null" />
              <option value="CA">Canada</option>
              <option value="US">United States</option>
            </select-input>
            <text-input v-model="form.passport" :error="form.errors.passport" class="pb-8 pr-6 w-full lg:w-1/2" label="Passport No" />
          </div>
          <hr />
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <!-- Contact Address info-->
            <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
            <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
            <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2" label="Province/State" />
            <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />
            <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
            <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />            
          </div>
          <hr />
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <!-- Course and Fees -->
            <select-input v-model="form.course_id" @change="updateFees" :error="form.errors.course_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Course">
              <option :value="null" />
              <option v-for="course in courses" :key="course.id" :value="course.id">{{ course.name }}</option>
            </select-input>
            <text-input v-model="form.fees" :error="form.errors.fees" class="pb-8 pr-6 w-full lg:w-1/2" label="Fees" />
            <select-input v-model="form.pMethod"  :error="form.errors.pMethod" class="pb-8 pr-6 w-full lg:w-1/2" label="Method of Payment">
              <option :value="null" />
              <option v-for="pm in pMethods" :key="pm.id" :value="pm.id">{{ pm.name }}</option>
            </select-input>
            <text-input v-model="form.fees_received" :error="form.errors.fees_received" class="pb-8 pr-6 w-full lg:w-1/2" label="Fees received" />
            <date-input v-model="form.start" :error="form.errors.start" class="pb-8 pr-6 w-full lg:w-1/2" label="Course Start"></date-input>
            <select-input v-model="form.length"  :error="form.errors.length" class="pb-8 pr-6 w-full lg:w-1/2" label="Duration of course">
              <option :value="null" />
              <option v-for="ln in length" :key="ln.id" :value="ln.value">{{ ln.label }}</option>
            </select-input>
          </div>
          <hr />
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <select-input v-model="form.agent"  :error="form.errors.agent" class="pb-8 pr-6 w-full lg:w-1/2" label="Agent">
              <option :value="null" />
              <option v-for="agent in agents" :key="agent.id" :value="agent.id">{{ agent.name }}</option>
            </select-input>
            <text-input v-model="form.commission" :error="form.errors.commission" class="pb-8 pr-6 w-full lg:w-1/2" label="Commission" />
            <!-- <date-input v-model="form.finish" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Course Finish"></date-input> -->
          </div>
          <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
            <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Student</loading-button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { Head, Link } from '@inertiajs/inertia-vue3'
  import Layout from '@/Shared/Layout'
  import TextInput from '@/Shared/TextInput'
  import SelectInput from '@/Shared/SelectInput'
  import LoadingButton from '@/Shared/LoadingButton'
  import DateInput from '@/Shared/DateInput'
  
  export default {
    components: {
      Head,
      Link,
      LoadingButton,
      SelectInput,
      TextInput,
      DateInput
    },
    layout: Layout,
    props: {
      courses: Array,
      agents: Array,
      pMethods: Array
    },
    remember: 'form',
    data() {
      return {
        form: this.$inertia.form({
          first_name: 'Iftakher',
          last_name: 'Ahammed',
          course_id: null,
          email: 'iahammed@gmail.com',
          phone: '07707492700',
          address: '11 Valentines Road',
          city: 'London',
          region: 'Essex',
          country: '',
          postal_code: 'IG1 4RZ',
          dob: '',
          passport: 'PT860578K',
          fees: 0,
          fees_received: 0,
          pMethod: '',
          start: '',
          finish: '',
          agent: '',
          length: '',
          commission: ''
        }),
        length: [ {'label': 'Two Weeks', 'value': 2}, {'label': 'Four Weeks', 'value': 4}, {'label': 'Eight Weeks', 'value': 8}, {'label': 'Twelve Weeks', 'value': 12}, {'label': 'Twintysix Weeks', 'value': 26} ],
      }
    },
    methods: {
      updateFees(){
        for (let i = 0; i < this.courses.length; i++) {
            if (this.courses[i].id > this.form.course_id) {                
              this.form.fees = this.courses[i].fees
              break
            }
        }
      },
      store() {
        this.form.post('/students')
      },
    },
  }
  </script>
  