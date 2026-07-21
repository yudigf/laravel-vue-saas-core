<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-black text-xl text-steel-900 uppercase tracking-widest">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white border-2 border-steel-900 shadow-neo p-8">
                    <div class="border-l-4 border-construction-500 pl-4">
                        <h3 class="text-2xl font-black text-steel-900 uppercase">Selamat Datang di Sistem Manajemen!</h3>
                        <p class="text-steel-800 font-bold mt-2">Anda berhasil login ke dalam sistem. Gunakan menu di sebelah kiri untuk menavigasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
