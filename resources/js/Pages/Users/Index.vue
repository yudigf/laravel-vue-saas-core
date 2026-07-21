<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// Menangkap properti 'users' yang dikirim dari UserController.php
defineProps({
    users: Object,
});
</script>

<template>
    <Head title="Manajemen User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-black text-xl text-steel-900 uppercase tracking-widest">Manajemen User</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Card Container -->
                <div class="bg-white overflow-hidden border-2 border-steel-900 shadow-neo">
                    
                    <!-- Table Header & Action Button -->
                    <div class="p-6 border-b-2 border-steel-900 flex justify-between items-center bg-white">
                        <div>
                            <h3 class="text-xl font-black text-steel-900 uppercase">Daftar Pengguna</h3>
                            <p class="text-sm text-steel-800 mt-1 font-bold">Data pengguna yang terdaftar di dalam database.</p>
                        </div>
                        <!-- Tombol Tambah User -->
                        <Link :href="route('users.create')" class="bg-construction-500 text-steel-900 px-5 py-2.5 border-2 border-steel-900 shadow-neo hover:shadow-none hover:translate-y-1 hover:translate-x-1 text-sm font-black transition-all uppercase tracking-wide">
                            + Tambah User
                        </Link>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-steel-900">
                            <thead class="text-xs text-steel-900 uppercase bg-construction-400 border-b-2 border-steel-900">
                                <tr>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Email Address</th>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Peran (Role)</th>
                                    <th scope="col" class="px-6 py-4 font-black">Tanggal Gabung</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y-2 divide-steel-900">
                                <!-- Looping data users dari Laravel -->
                                <tr v-for="user in users.data" :key="user.id" class="bg-white hover:bg-gray-100 transition-colors">
                                    <td class="px-6 py-4 font-black text-steel-900 border-r-2 border-steel-900">
                                        {{ user.name }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-steel-800 border-r-2 border-steel-900">
                                        {{ user.email }}
                                    </td>
                                    <td class="px-6 py-4 border-r-2 border-steel-900">
                                        <!-- Menambahkan warna berbeda otomatis berdasarkan Role -->
                                        <span 
                                            class="px-3 py-1 text-[10px] font-black tracking-widest uppercase border-2 border-steel-900 shadow-neo-sm"
                                            :class="{
                                                'bg-steel-900 text-white': user.role === 'super_admin',
                                                'bg-construction-500 text-steel-900': user.role === 'tenant_admin',
                                                'bg-white text-steel-900': user.role === 'tenant_staff'
                                            }"
                                        >
                                            {{ user.role.replace('_', ' ') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-steel-800 font-bold">
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
