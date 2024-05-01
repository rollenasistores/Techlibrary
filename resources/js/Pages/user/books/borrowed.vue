<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
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
        data: 'copy.book.name',
        title: 'Book Name',
    },
    {
        data: 'id',
        title: 'Action',
        render: function (data) {
            const editUrl = `/admin/books/${data}/edit`;

            const deleteButton = `<a class=" delete-button pr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-600 hover:text-green-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#" :href="" data-id="${data}">Delete</a>`;

            return `<div><a href="${editUrl}" class="pr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-600 hover:text-green-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Edit</a>${deleteButton}</div>`;
        },
    },
];


</script>

<script>
export default {

    props: {
        books: {
            type: Array,
        }
    },

    mounted() {
        this.bindDeleteButtonClick()
    },

    methods: {

        editBook(id) {
            // Construct the route URL using the category ID
            const route = `/admin/books/${id}/edit`;

            // Navigate to the edit route using Inertia's visit method
            this.$inertia.visit(route);
        },

        deleteBook(id) {

            this.$inertia.delete(`/admin/books/${id}`, {
                onSuccess: () => {

                    // Handle success, show notification, etc.
                    const $toast = useToast();


                    if (!(this.$page.props.flash.message == null)) {

                        $toast.success(this.$page.props.flash.message);

                    } else {
                        $toast.error(this.$page.props.flash.error);
                    }


                    // Redirect to another page if needed
                    this.$inertia.visit('/admin/books');

                },


                onError: (error) => {
                    // Handle error, show error message, etc.
                    console.error('Error deleting Books:', error);
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
                        this.deleteBook(id);
                    }
                });
            });
        },
    }

}

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <DataTable class="display" :columns="columns" :data="books" :options ref="myDataTable">

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