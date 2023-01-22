<template>
    <div>
      <Head title="Create Contact" />
      <h1 class="mb-8 text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/students">Students</Link>
        <span class="text-indigo-400 font-medium">/</span> Create
      </h1>
      <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="store">
          <h1 class="-mb-8 -mr-6 p-8 text-2xl font-bold">
            <span class="text-indigo-600 font-medium">Personal Info</span>
          </h1>
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
            <text-input v-model="form.student_id" :error="form.errors.student_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Student ID" />
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
          <h1 class="-mb-8 -mr-6 p-8 text-2xl font-bold">
            <span class="text-indigo-600 font-medium">Course Info</span>
          </h1>
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
          <hr />
          <div class="flex flex-wrap mb-4">
            <h1 class="p-4 text-2xl font-bold w-3/5">
              <span class="text-indigo-600 font-medium">Accomodation Info</span> 
            </h1>
            <div class="align-baseline items-end content-end w-2/5">
              <div class="p-4 flex justify-between items-center" @click="form.needAccommodation = !form.needAccommodation">
                <h2 class="p-4 items-end">Need Accommodation :</h2>
                <div class="w-12 h-5 flex items-center rounded-full p-1 duration-300 ease-in-out bg-red-100" :class="{ 'bg-green-400': form.needAccommodation}">
                  <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-6': form.needAccommodation}"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap -mb-8 -mr-6 p-8" v-if="form.needAccommodation">
            <text-input v-model="form.accommodationFees" :error="form.errors.accommodationFees" class="pb-8 pr-6 w-full lg:w-1/2" label="Accommodation fees" />
            <date-input v-model="form.accommodationStart" :error="form.errors.accommodationStart" class="pb-8 pr-6 w-full lg:w-1/2" label="Accommodation Start"></date-input>
            <select-input v-model="form.accommodationLength"  :error="form.errors.accommodationLength" class="pb-8 pr-6 w-full lg:w-1/2" label="Duration of accomodation">
              <option :value="null" />
              <option v-for="ln in length" :key="ln.id" :value="ln.value">{{ ln.label }}</option>
            </select-input>
          </div>
          <hr />
          <div class="flex space-between mb-4 w-full">
            <h1 class="p-4 text-2xl font-bold w-3/5">
              <span class="text-indigo-600 font-medium">Transfer Info</span> 
            </h1>
            <div class="align-baseline items-end content-end w-2/5">
              <div class="p-4 flex justify-between items-center" @click="form.needTransfer = !form.needTransfer">
                <h2 class="p-4 items-end">Need Transfer:</h2>
                <div class="w-12 h-5 flex items-center rounded-full p-1 duration-300 ease-in-out bg-red-100" :class="{ 'bg-green-400': form.needTransfer}">
                  <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-6': form.needTransfer}"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap -mb-8 -mr-6 p-8" v-if="form.needTransfer">
            <text-input v-model="form.transferFees" :error="form.errors.transferFees" class="pb-8 pr-6 w-full lg:w-1/2" label="Transfer fees" />
            <date-input v-model="form.transferStart" :error="form.errors.transferStart" class="pb-8 pr-6 w-full lg:w-1/2" label="Transfer Start"></date-input>
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
      DateInput,
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
        // isActive: false,
        toggleActive: false,
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
          student_id: '',
          fees: 0,
          fees_received: 0,
          pMethod: '',
          start: '',
          finish: '',
          agent: '',
          length: '',
          commission: '',
          needAccommodation: false,
          accommodationFees: 0,
          accommodationStart: '',
          accommodationLength: '',
          needTransfer: false,
          transferFees: 0,
          transferStart: '',
        }),
        length: [ 
          {'label': 'Two Weeks', 'value': 2}, 
          {'label': 'Four Weeks', 'value': 4}, 
          {'label': 'Eight Weeks', 'value': 8}, 
          {'label': 'Twelve Weeks', 'value': 12}, 
          {'label': 'Twintysix Weeks', 'value': 26}
        ],
      }
    },
    methods: {
      toggle(value) {
        isActive.value = !isActive.value;
      },
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
  <style>
    input:checked {
      background-color: #087630; /* bg-green-500 */
    }

    input:checked ~ span:last-child {
      --tw-translate-x: 1.75rem; /* translate-x-7 */
    }
  </style>
  