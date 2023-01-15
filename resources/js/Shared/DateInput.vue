<template>
    <div :class="$attrs.class">
      <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
      <Datepicker v-model="selected" class="rounded-xl"  :year-range="[1960, 2050]" :format="format" :min-date="minDate" :max-date="maxDate" :start-date="maxDate" :enable-time-picker="false" v-bind="{ ...$attrs, class: null }" :class="{ error: error }" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
      <div v-if="error" class="form-error">{{ error }}</div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue'
  import { subYears } from 'date-fns'
  //https://vue3datepicker.com/
  import { v4 as uuid } from 'uuid'
  import Datepicker from '@vuepic/vue-datepicker'
  import '@vuepic/vue-datepicker/dist/main.css'
  // Example using a custom format function
  export default {
    components: { Datepicker },
    inheritAttrs: false,
    props: {
      id: {
        type: String,
        default() {
          return `text-input-${uuid()}`
        },
      },
      type: {
        type: String,
        default: 'text',
      },
      error: String,
      label: String,
      modelValue: String,
    },
    emits: ['update:modelValue'],
    data() {
      return {
        selected: this.modelValue,
      }
    },
    // computed: {
    //   maxDate() {
    //     return subYears(new Date(), 18)
    //   },
    //   startDate() {
    //     return subYears(new Date(), 18)
    //   },
    // },
    watch: {
      selected(selected) {
        this.$emit('update:modelValue', selected)
      },
    },
    methods: {
      focus() {
        this.$refs.input.focus()
      },
      setup() {
        const date = ref(new Date())
        // In case of a range picker, you'll receive [Date, Date]
        const format = (date) => {
          const day = date.getDate()
          const month = date.getMonth() + 1
          const year = date.getFullYear()
          return `${day}/${month}/${year}`
        }
        return { date, format }
      },
    },
  }
  </script>
  
  <style>
  /* .dp__theme_light {
    --dp-background-color: #e9ecf0;
    --dp-text-color: #3f3d3d;
    --dp-hover-color: #413d3d;
    --dp-hover-text-color: #454343;
    --dp-hover-icon-color: #959595;
    --dp-primary-color: #1976d2;
    --dp-primary-text-color: #f8f5f5;
    --dp-secondary-color: #c0c4cc;
    --dp-border-color: #1976d200;
    --dp-menu-border-color: #1976d2;
    --dp-border-color-hover: #1976d2;
    --dp-disabled-color: #f6f6f6;
    --dp-scroll-bar-background: #f3f3f3;
    --dp-scroll-bar-color: #959595;
    --dp-success-color: #76d275;
    --dp-success-color-disabled: #a3d9b1;
    --dp-icon-color: #959595;
    --dp-danger-color: #ff6f60;
  } */
  </style>