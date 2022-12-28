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
            <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First name" />
            <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last name" />
            
            <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
            <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
            <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
            <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
            <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2" label="Province/State" />
            <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
              <option :value="null" />
              <option value="CA">Canada</option>
              <option value="US">United States</option>
            </select-input>
            <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />
            <date-input v-model="form.dob" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Date of birth"></date-input>
            <!-- Course and Fees -->
            <hr />
            <select-input v-model="form.course_id" @change="updateFees" :error="form.errors.course_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Course">
              <option :value="null" />
              <option v-for="course in courses" :key="course.id" :value="course.id">{{ course.name }}</option>
            </select-input>
            <text-input v-model="form.fees" :error="form.errors.fees" class="pb-8 pr-6 w-full lg:w-1/2" label="Fees" />
            <text-input v-model="form.fees_received" :error="form.errors.fees_received" class="pb-8 pr-6 w-full lg:w-1/2" label="Fees received" />
            <date-input v-model="form.start" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Date of birth"></date-input>
            <date-input v-model="form.finish" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Date of birth"></date-input>
          </div>
          <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
            <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Contact</loading-button>
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
    },
    remember: 'form',
    data() {
      return {
        form: this.$inertia.form({
          first_name: '',
          last_name: '',
          course_id: null,
          email: '',
          phone: '',
          address: '',
          city: '',
          region: '',
          country: '',
          postal_code: '',
          dob: '',
          fees: 0,
          fees_received: 0,
          start: '',
          finish: ''
        }),
      }
    },
    // watch: {
    //   fees() {
    //     for (let i = 0; i < this.courses.length; i++) {
    //         if (this.courses[i].id > this.form.course_id) {                
    //           this.form.fees = this.courses[i].fees
    //           break
    //         }
    //     }
    //   }
    // },
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
  