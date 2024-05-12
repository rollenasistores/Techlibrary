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
        data: 'borrowed_at',
        title: 'Borrowed Date',

    },
    {
        data: 'returned_at',
        title: 'Returning Date',

    },
    {
        data: 'confirmed',
        title: 'Status',
        render: function (data) {
            if(data == 1) {
                return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-teal-500 text-teal-500">Returned</span>';
            }else if(data == 3) {
                return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-red-500 text-red-500">OVERDUE</span>'
            }else {
                return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-red-500 text-red-500">Not Returned</span>'
            }
        }
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