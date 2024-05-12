<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';


</script>

<script>
export default {
    data() {
        return {
            libraryStatus: null,
            librarianStatus: null
        };
    },
    mounted() {
        this.fetchLibraryStatus();
    },
    methods: {
        async fetchLibraryStatus() {
            try {
                const response = await axios.get('/api/library-status');
                this.libraryStatus = response.data.library_open ? 'Open' : 'Closed';

                if (this.libraryStatus == 'Open') {
                    this.libraryButtonText = "Closed"
                } else {
                    this.libraryButtonText = "Open"
                }

                this.librarianStatus = response.data.librarian_available ? 'Available' : 'Busy';

                if (this.librarianStatus == 'Available') {
                    this.librarianButtonText = "Busy"
                } else if (this.librarianStatus == 'Busy') {
                    this.librarianButtonText = "Available"
                }


            } catch (error) {
                console.error('Failed to fetch library status:', error);
            }
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

        <div class="flex flex-wrap md:flex-wrap-reverse">

            <div class="container lg:w-1/2">
                <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                    <div class="border mx-auto p-5 rounded-lg text-custom-blue">
                        <h1 class="text-3xl font-bold mb-4 text-custom-blue">Library Rules and Regulations</h1>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">1. Silence</h2>
                            <p class="text-xs">Maintain silence at all times within the library premises for a conducive
                                studying environment.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">2. No Food and Drinks</h2>
                            <p class="text-xs">Prohibited to maintain cleanliness and prevent damage to library
                                materials.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">3. Mobile Phones</h2>
                            <p class="text-xs">Set to silent mode or turned off to avoid disturbance to others.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">4. Handling of Materials</h2>
                            <p class="text-xs">Handle library materials with care and return to their proper place.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">5. Borrowed Books</h2>
                            <p class="text-xs">Return borrowed books on time to avoid fines or penalties.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">6. Computer Terminals</h2>
                            <p class="text-xs">Use for research and study only, not for entertainment or gaming.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">7. Printing Services</h2>
                            <p class="text-xs">Available with fees according to the printing price list.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">8. Personal Belongings</h2>
                            <p class="text-xs">Do not leave unattended; lockers may be provided.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">9. Disruptive Behavior</h2>
                            <p class="text-xs">Not tolerated; may result in suspension or legal action.</p>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-3 mb-3">
                            <h2 class="text-sm font-semibold mb-1">10. Authority of Librarian</h2>
                            <p class="text-xs">Librarian has full authority to enforce rules; non-compliance may result
                                in
                                expulsion.</p>
                        </div>
                    </div>

                </div>
            </div>
            <div>
                <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                    <div class="border mx-auto p-5 rounded-lg text-custom-blue">
                        <h2 class="text-lg font-semibold mb-2">Library Opening Hours</h2>
                        <p class="text-sm mb-2">Monday to Friday</p>
                        <p class="text-xs mb-2">8:00 AM to 5:00 PM</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="p-4 sm:p-6 space-y-4 sm:space-y-6 w-full">
                    <div class="border mx-auto p-5 rounded-lg text-custom-blue">
                        <h2 class="text-lg font-semibold mb-2">Library Status</h2>
                        <p class="text-sm mb-2">Current Status:</p>
                        <p class="text-xs mb-2">Library: <span class="font-semibold">{{ libraryStatus }}</span></p>
                        <p class="text-xs mb-2">Librarian: <span class="font-semibold">{{ librarianStatus }}</span></p>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
