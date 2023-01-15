  <template>
    <div class="flex flex-col md:flex-row md:space-x-6">
      <div>
        <Head :title="`${form.first_name} ${form.last_name}`" />
        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-indigo-400 hover:text-indigo-600" href="/students">Students</Link>
          <span class="text-indigo-400 font-medium">/</span>
          {{ form.first_name }} {{ form.last_name }}
        </h1>
        <trashed-message v-if="student.deleted_at" class="mb-6" @restore="restore"> This student has been deleted. </trashed-message>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
          <form @submit.prevent="update">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First name" />
              <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last name" />
              <!-- <select-input v-model="form.organization_id" :error="form.errors.organization_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Organization">
                <option :value="null" />
                <option v-for="organization in organizations" :key="organization.id" :value="organization.id">{{ organization.name }}</option>
              </select-input> -->
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
            </div>
            <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
              <button v-if="!student.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete student</button>
              <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update student</loading-button>
            </div>
          </form>
        </div>
      </div>
      <div class="mt-12 md:mt-0">
        <Head :title="`${form.first_name} ${form.last_name}`" />
        <h1 class="mb-8 text-3xl font-bold">Payment history
          <span class="text-indigo-400 font-medium">:</span>
          Fees: {{ my_course.fees }}
          <span class="text-indigo-400 font-medium">/</span>
          Received: {{ my_course.fees_received }}
        </h1>
        <div class="bg-white rounded-md shadow overflow-x-auto">
          <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
              <th class="pb-4 pt-6 px-6">Date</th>
              <th class="pb-4 pt-6 px-6">Received by</th>
              <th class="pb-4 pt-6 px-6">Amount</th>
            </tr>
            <tr v-for="pay in payments" :key="pay.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t">
                <span class="flex items-center px-6 py-4 focus:text-indigo-500">{{ date(pay.payment.payment_date) }}</span>
              </td>
              <td class="border-t">
                <span class="flex items-center px-6 py-4 focus:text-indigo-500">{{ pay.user.first_name }} {{  pay.user.last_name }}</span>
              </td>
              <td class="border-t">
                <span class="flex items-center px-6 py-4 focus:text-indigo-500">{{ pay.payment.amount }}</span>
              </td>
            </tr>
          </table>
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <Link class="btn-indigo ml-auto" :href="`/students/${student.id}/payment`" tabindex="-1">
            Add Payment
          </Link>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { Head, Link } from '@inertiajs/inertia-vue3'
  import Layout from '@/Shared/Layout'
  import TextInput from '@/Shared/TextInput'
  import SelectInput from '@/Shared/SelectInput'
  import LoadingButton from '@/Shared/LoadingButton'
  import TrashedMessage from '@/Shared/TrashedMessage'
  import moment from 'moment'
  
  export default {
    components: {
      Head,
      Link,
      LoadingButton,
      SelectInput,
      TextInput,
      TrashedMessage,
    },
    layout: Layout,
    props: {
      student: Object,
      payments: Array,
      my_course: Object,
    },
    remember: 'form',
    data() {
      return {
        form: this.$inertia.form({
          first_name: this.student.first_name,
          last_name: this.student.last_name,
          email: this.student.email,
          phone: this.student.phone,
          address: this.student.address,
          city: this.student.city,
          region: this.student.region,
          country: this.student.country,
          postal_code: this.student.postal_code,
        }),
      }
    },
    methods: {
      date(item) {
          return moment(item).format('MMM Do, YYYY');
      },
      update() {
        this.form.put(`/students/${this.student.id}`)
      },
      destroy() {
        if (confirm('Are you sure you want to delete this student?')) {
          this.$inertia.delete(`/students/${this.student.id}`)
        }
      },
      restore() {
        if (confirm('Are you sure you want to restore this student?')) {
          this.$inertia.put(`/students/${this.student.id}/restore`)
        }
      },
    },
  }
  </script>
  