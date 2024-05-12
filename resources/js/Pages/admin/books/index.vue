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
        data: 'image_url',
        title: 'Book Image',
        render: function (data) {
            return `<img src="${route('photo.show', data)}" alt="Book Image" class="h-auto w-16">`;
        }
    },
    {
        data: 'name',
        title: 'Book Name',
    },
    {
        data: 'description',
        title: 'Description',
        render: function (data) {
            // Truncate the description to 120 characters
            return data.length > 120 ? data.substr(0, 120) + '...' : data;
        }
    },
    {
        data: 'author.name',
        title: 'Author Name',
    },


    {
        data: 'genre.name',
        title: 'Genre Name',
    },
    {
        data: 'publication_year',
        title: 'Publication Year',
    },
    {
        data: 'copies',
        title: 'Availability Status',
        render: function (data) {
            // Count the number of available copies
            var availableCount = data.reduce(function (acc, copy) {
                return acc + (copy.is_available ? 1 : 0);
            }, 0);

            var notAvailableCount = data.reduce(function (acc, copy) {
                return acc + (copy.is_available ? 0 : 1);
            }, 0);

            return `${availableCount} / ${notAvailableCount}`;
        }
    },
    {
        data: 'id',
        title: 'Action',
        render: function (data) {
            const editUrl = `/admin/books/${data}/edit`;

            const deleteButton = `<a class=" delete-button pr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-custom-blue hover:text-custom-blue disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#" :href="" data-id="${data}">Delete</a>`;

            return `<div><a href="${editUrl}" class="pr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-custom-blue hover:text-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Edit</a>${deleteButton}</div>`;
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
    <Header />


    <Sidebar />


    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div class="py-2">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="grid justify-between float-right pl-2 items-center text-center">
                        <!-- Button -->
                        <Link href="/admin/books/create"
                            class="py-2  px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-custom-blue text-white hover:bg-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        <PencilSquareIcon class="h-5 w-5" />Create
                        </Link>
                    </div>
                </div>
            </div>
            <DataTable class="display" :columns="columns" :data="books" :options ref="myDataTable">

            </DataTable>

        </div>
    </div>

</template>
<style>
@import 'datatables.net-dt';
@import 'datatables.net-responsive-dt';
</style>