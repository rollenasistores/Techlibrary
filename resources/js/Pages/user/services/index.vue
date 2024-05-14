<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import { PencilSquareIcon } from '@heroicons/vue/24/solid'
import { Link } from '@inertiajs/vue3'


import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';

DataTable.use(DataTablesCore);


const options = {
    dom: 'Bftip',
    responsive: true,
    select: true,
};

const columns = [
    {
        data: 'file_name',
        title: 'File Name',

    },
    {
        data: 'printing_type',
        title: 'Printing Type',

    },
    {
        data: 'copies',
        title: 'No. Copies',

    },
    {
        data: 'location',
        title: 'School Library',

    },
    {
        data: 'status',
        title: 'Service Status',
        render: function (data) {
            if (data == 'pending') {
                return `<span class='inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-500'>Pending</span>`
            } else if (data == 'printing') {
                return `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Printing</span>`
            } else {
                return `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">Completed</span>`;
            }
        }
    },
];


</script>

<script>
export default {

    props: {
        printings: {
            type: Array,
        }
    },


}

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Printing Services
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="py-2">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="grid justify-between float-right pl-2 items-center text-center">
                                <!-- Button -->
                                <Link href="/printing/create"
                                    class="py-2  px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-custom-blue text-white hover:bg-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                <PencilSquareIcon class="h-5 w-5" />Create
                                </Link>
                            </div>
                        </div>
                    </div>
                    <DataTable class="display" :columns="columns" :data="printings" :options ref="myDataTable">

                    </DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
@import 'datatables.net-dt';
@import 'datatables.net-responsive-dt';
</style>