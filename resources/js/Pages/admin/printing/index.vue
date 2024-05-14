<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import { useToast } from 'vue-toast-notification';

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
        data: 'user.name',
        title: 'Student Name',
    },
    {
        data: 'user.studentID',
        title: 'Student ID',
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
        title: 'Location',
        
    },
    {
        data: 'file_name',
        title: 'File Upload',
        render: function (data) {
            const url = `/storage/${data}`;
            
            return `<a href='${url}' class='inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500'>Download File</a>`;
        }
    },
    {
        data: null,
        title: 'Status',
        render: function (data) {
            
            const editUrl = `/admin/printing/${data.id}/edit`;

            if(data.status == 'pending') {
                    
                return `<a class='inline-flex items-center gap-x-1.5 py-1.5 px-3 hover:cursor-pointer rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-500' href="${editUrl}">Pending</a>`
            }else if (data.status == 'printing') {
                return `<a class="inline-flex items-center gap-x-1.5 py-1.5 px-3 hover:cursor-pointer  rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500" href="${editUrl}">Printing</a>`
            }else {
                return `<a class="inline-flex items-center gap-x-1.5 py-1.5 px-3 hover:cursor-pointer  rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500" href="${editUrl}">Completed</a>`;
            }
        }
    },
];


</script>

<script>
export default {

    props: {
        printing: {
            type: Array,
        }
    },

    mounted() {
        this.bindDeleteButtonClick()
    },

    methods: {

        editGenre(id) {
            // Construct the route URL using the category ID
            const route = `/admin/genres/${id}/edit`;

            // Navigate to the edit route using Inertia's visit method
            this.$inertia.visit(route);
        },

        deleteGenre(id) {

            this.$inertia.delete(`/admin/genres/${id}`, {
                onSuccess: () => {

                    // Handle success, show notification, etc.
                    const $toast = useToast();


                    if (!(this.$page.props.flash.message == null)) {

                        $toast.success(this.$page.props.flash.message);

                    } else {
                        $toast.error(this.$page.props.flash.error);
                    }


                    // Redirect to another page if needed
                    this.$inertia.visit('/admin/genres');

                },


                onError: (error) => {
                    // Handle error, show error message, etc.
                    console.error('Error deleting Genre:', error);
                },

            });

        },
        bindDeleteButtonClick() {
            const self = this;
            // Bind click event for delete button
            this.$nextTick(() => {
                const dataTable = this.$refs.myDataTable.$el;
                dataTable.querySelector('tbody').addEventListener('click', (event) => {
                    if (event.target.classList.contains('delete-button')) {
                        const id = event.target.dataset.id;
                        this.deleteGenre(id);
                    }
                });
            });
        },
    }

}

</script>

<template>
    <Header />


    <Sidebar />


    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6 py-2">
            <DataTable class="display" :columns="columns" :data="printing " ref="myDataTable">

            </DataTable>

        </div>
    </div>

</template>
<style>
@import 'datatables.net-dt';
@import 'datatables.net-responsive-dt';
</style>