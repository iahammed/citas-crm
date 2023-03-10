<template>
    <div>
      <Head title="Students" />
      <h1 class="mb-8 text-3xl font-bold">Students</h1>
      <div class="flex items-center justify-between mb-6">
        <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
          <label class="block text-gray-700">Trashed:</label>
          <select v-model="form.trashed" class="form-select mt-1 w-full">
            <option :value="null" />
            <option value="with">With Trashed</option>
            <option value="only">Only Trashed</option>
          </select>
        </search-filter>
        <Link class="btn-indigo" href="/students/create">
          <span>Create</span>
          <span class="hidden md:inline">&nbsp;Students</span>
        </Link>
      </div>
      <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Std ID</th>
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6">Course</th>
            <th class="pb-4 pt-6 px-6">Start</th>
            <th class="pb-4 pt-6 px-6">Finish</th>
            <th class="pb-4 pt-6 px-6">Fees</th>
            <th class="pb-4 pt-6 px-6">Received</th>
            <th class="pb-4 pt-6 px-6">Escrow</th>
          </tr>
          <tr v-for="student in students.data" :key="student.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/students/${student.id}/edit`">
                {{ student.student_id }}
                <icon v-if="student.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/students/${student.id}/edit`">
                {{ student.name }}
                <icon v-if="student.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/students/${student.id}/edit`" tabindex="-1">
                {{ student.course.name }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/students/${student.id}/edit`" tabindex="-1">
                {{ date(student.course_fees.start_date) }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/students/${student.id}/edit`" tabindex="-1">
                {{ date(student.course_fees.finish_date) }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/students/${student.id}/edit`" tabindex="-1">
                {{ student.course_fees.fees }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/students/${student.id}/edit`" tabindex="-1">
                {{ student.course_fees.fees_received }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/students/${student.id}/edit`" tabindex="-1">
                {{ student.course_fees.fees_escrow }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/students/${student.id}/edit`" tabindex="-1">
                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="students.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No students found.</td>
          </tr>
        </table>
      </div>
      <pagination class="mt-6" :links="students.links" />
    </div>
  </template>
  
  <script>
  import { Head, Link } from '@inertiajs/inertia-vue3'
  import Icon from '@/Shared/Icon'
  import pickBy from 'lodash/pickBy'
  import Layout from '@/Shared/Layout'
  import throttle from 'lodash/throttle'
  import mapValues from 'lodash/mapValues'
  import Pagination from '@/Shared/Pagination'
  import SearchFilter from '@/Shared/SearchFilter'
  import moment from 'moment'
  export default {
    components: {
      Head,
      Icon,
      Link,
      Pagination,
      SearchFilter,
    },
    layout: Layout,
    props: {
      filters: Object,
      students: Object
    },
    data() {
      return {
        form: {
          search: this.filters.search,
          trashed: this.filters.trashed,
        },
      }
    },
    watch: {
      form: {
        deep: true,
        handler: throttle(function () {
          this.$inertia.get('/students', pickBy(this.form), { preserveState: true })
        }, 150),
      },
    },
    methods: {
      reset() {
        this.form = mapValues(this.form, () => null)
      },
      date(item) {
          return moment(item).format('MMM Do, YYYY');
      },
    },
  }
  </script>
  