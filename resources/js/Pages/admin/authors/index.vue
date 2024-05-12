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
        data: 'name',
        title: 'Author Name',
    },
    {
        data: 'id',
        title: 'Action',
        render: function (data) {
            const editUrl = `/admin/authors/${data}/edit`;

            const deleteButton = `<a class=" delete-button pr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-custom-blue hover:text-custom-blue disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#" :href="" data-id="${data}">Delete</a>`;

            return `<div><a href="${editUrl}" class="pr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-custom-blue hover:text-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Edit</a>${deleteButton}</div>`;
        },
    },
];


</script>

<script>
export default {

    props: {
        authors: {
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
            <div class="py-2">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="grid justify-between float-right pl-2 items-center text-center">
                            <!-- Button -->
                            <Link href="/admin/authors/create"
                                class="py-2  px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-custom-blue text-white hover:bg-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                            <PencilSquareIcon class="h-5 w-5" />Create
                            </Link>
                        </div>
                    </div>
                </div>  
            <DataTable class="display" :columns="columns" :data="authors" ref="myDataTable">

            </DataTable>

        </div>
    </div>

</template>
<style>
@import 'datatables.net-dt';
@import 'datatables.net-responsive-dt';
</style>