<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import { useToast } from 'vue-toast-notification';

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
        data: 'code',
        title: 'Borrow Code',
    },
    {
        data: 'user.name',
        title: 'Student Name',
    },
    {
        data: 'user.studentID',
        title: 'Student Number',
    },
    {
        data: 'copy.book.name',
        title: 'Book Name',
    },
    {
        data: 'borrowed_at',
        title: 'Borrowed Date',
    },
    {
        data: 'returned_at',
        title: 'Returning Date',
    },
    {
        data: 'confirmed',
        title: 'Return Confirmation',
        render: function (data) {
            if (data == 0) {
                return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">Not Confirmed</span>';
            } else if(data == 3) {
                return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-white-800 dark:bg-yellow-800/30 dark:text-yellow-500">Overdue</span>';
            } else {
                return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Confirmed</span>';
            }
        }

    },
    {
        data: 'id',
        title: 'Action',
        render: function (data) {
            const editUrl = `/admin/borrows/${data}/edit`;

            return `<div><a href="${editUrl}" class="pr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-custom-blue hover:text-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">CONFIRM RETURN</a></div>`;
        },
    },
];


</script>

<script>
export default {

    props: {
        borrows: {
            type: Array,
        }
    },

    mounted() {
        this.bindDeleteButtonClick()
    },

    methods: {

        editAuthor(id) {
            // Construct the route URL using the category ID
            const route = `/admin/authors/${id}/edit`;

            // Navigate to the edit route using Inertia's visit method
            this.$inertia.visit(route);
        },

        deleteAuthor(id) {

            this.$inertia.delete(`/admin/authors/${id}`, {
                onSuccess: () => {

                    // Handle success, show notification, etc.
                    const $toast = useToast();


                    if (!(this.$page.props.flash.message == null)) {

                        $toast.success(this.$page.props.flash.message);

                    } else {
                        $toast.error(this.$page.props.flash.error);
                    }


                    // Redirect to another page if needed
                    this.$inertia.visit('/admin/authors');

                },


                onError: (error) => {
                    // Handle error, show error message, etc.
                    console.error('Error deleting Author:', error);
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
                        this.deleteAuthor(id);
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
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">

            <DataTable class="display" :columns="columns" :data="borrows" ref="myDataTable">

            </DataTable>

        </div>
    </div>

</template>
<style>
@import 'datatables.net-dt';
@import 'datatables.net-responsive-dt';
</style>