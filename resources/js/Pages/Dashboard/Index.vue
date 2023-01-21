<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>

    <!-- new BOX -->
    <div class="grid grid-cols-12 gap-6 mt-5">
      <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
          <div class="report-box zoom-in">
              <div class="box p-5">
                  <div class="flex">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart report-box__icon text-theme-21"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> 
                      <div class="ml-auto">
                          <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"> 33% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg> </div>
                      </div>
                  </div>
                  <div class="text-3xl font-medium leading-8 mt-6">4.710</div>
                  <div class="text-base text-gray-600 mt-1">Item Sales</div>
              </div>
          </div>
      </div>
      <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
          <div class="report-box zoom-in">
              <div class="box p-5">
                  <div class="flex">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card report-box__icon text-theme-22"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg> 
                      <div class="ml-auto">
                          <div class="report-box__indicator bg-theme-24 tooltip cursor-pointer"> 2% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4 ml-0.5"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
                      </div>
                  </div>
                  <div class="text-3xl font-medium leading-8 mt-6">3.721</div>
                  <div class="text-base text-gray-600 mt-1">New Orders</div>
              </div>
          </div>
      </div>
      <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
          <div class="report-box zoom-in">
              <div class="box p-5">
                  <div class="flex">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor report-box__icon text-theme-23"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg> 
                      <div class="ml-auto">
                          <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"> 12% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg> </div>
                      </div>
                  </div>
                  <div class="text-3xl font-medium leading-8 mt-6">2.149</div>
                  <div class="text-base text-gray-600 mt-1">Total Products</div>
              </div>
          </div>
      </div>
      <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
          <div class="report-box zoom-in">
              <div class="box p-5">
                  <div class="flex">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-10"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> 
                      <div class="ml-auto">
                          <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"> 22% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 ml-0.5"><polyline points="18 15 12 9 6 15"></polyline></svg> </div>
                      </div>
                  </div>
                  <div class="text-3xl font-medium leading-8 mt-6">152.040</div>
                  <div class="text-base text-gray-600 mt-1">Unique Visitor</div>
              </div>
          </div>
      </div>
  </div>

    <!-- new REPORT -->
    <div class="col-span-12 lg:col-span-6 mt-8">
      <div class="intro-y block sm:flex items-center h-10">
          <h2 class="text-lg font-medium truncate mr-5">
              Sales Report
          </h2>
          <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> 
              <input type="text" class="datepicker form-control sm:w-56 box pl-10">
          </div>
      </div>
      <div class="intro-y box p-5 mt-12 sm:mt-5">
          <div class="flex flex-col xl:flex-row xl:items-center">
              <div class="flex">
                  <div>
                      <div class="text-theme-26 dark:text-gray-300 text-lg xl:text-xl font-medium">$15,000</div>
                      <div class="mt-0.5 text-gray-600 dark:text-gray-600">This Month</div>
                  </div>
                  <div class="w-px h-12 border border-r border-dashed border-gray-300 dark:border-dark-5 mx-4 xl:mx-5"></div>
                  <div>
                      <div class="text-gray-600 dark:text-gray-600 text-lg xl:text-xl font-medium">$10,000</div>
                      <div class="mt-0.5 text-gray-600 dark:text-gray-600">Last Month</div>
                  </div>
              </div>
              <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
                  <button class="dropdown-toggle btn btn-outline-secondary font-normal" aria-expanded="false"> Filter by Category <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4 ml-2"><polyline points="6 9 12 15 18 9"></polyline></svg> </button>
                  <div class="dropdown-menu w-40">
                      <div class="dropdown-menu__content box dark:bg-dark-1 p-2 overflow-y-auto h-32"> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">PC &amp; Laptop</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Smartphone</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Electronic</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Photography</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Sport</a> </div>
                  </div>
              </div>
          </div>
          <div class="report-chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="report-line-chart" class="mt-6 chartjs-render-monitor" style="display: block; height: 263px; width: 468px;" width="936" height="526"></canvas>
          </div>
      </div>
    </div>

    <!-- New end -->



  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'

export default {
  components: {
    Head,
  },
  layout: Layout,
}
</script>
