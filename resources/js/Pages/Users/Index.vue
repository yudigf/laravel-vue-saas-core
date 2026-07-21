<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// Menangkap properti 'users' yang dikirim dari UserController.php
defineProps({
    users: Object,
});
</script>

<template>
    <Head title="Manajemen User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen User</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Card Container -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200">
                    
                    <!-- Table Header & Action Button -->
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Daftar Pengguna</h3>
                            <p class="text-sm text-gray-500 mt-1">Data pengguna yang terdaftar di dalam database.</p>
                        </div>
                        <!-- Tombol ini belum berfungsi, sekadar pemanis UI -->
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                            + Tambah User
                        </button>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-4">Email Address</th>
                                    <th scope="col" class="px-6 py-4">Peran (Role)</th>
                                    <th scope="col" class="px-6 py-4">Tanggal Gabung</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <!-- Looping data users dari Laravel -->
                                <tr v-for="user in users.data" :key="user.id" class="bg-white hover:bg-gray-50/80 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ user.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ user.email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- Menambahkan warna berbeda otomatis berdasarkan Role -->
                                        <span 
                                            class="px-2.5 py-1 rounded-md text-xs font-bold tracking-wide"
                                            :class="{
                                                'bg-purple-100 text-purple-700': user.role === 'super_admin',
                                                'bg-blue-100 text-blue-700': user.role === 'tenant_admin',
                                                'bg-slate-100 text-slate-700': user.role === 'tenant_staff'
                                            }"
                                        >
                                            {{ user.role.replace('_', ' ').toUpperCase() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ new Date(user.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
