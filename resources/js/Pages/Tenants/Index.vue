<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    tenants: Object,
});
</script>

<template>
    <Head title="Manajemen Toko (Tenant)" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-black uppercase tracking-widest">
                MANAJEMEN TOKO
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Neo-Brutalist Container -->
                <div class="bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 mb-8">
                    
                    <!-- Table Header & Action Button -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b-4 border-black pb-4">
                        <div>
                            <h3 class="text-xl font-bold uppercase">Daftar Toko / Tenant Terdaftar</h3>
                            <p class="text-sm font-bold text-gray-600 mt-1 uppercase">Halaman Khusus Super Admin</p>
                        </div>
                        <Link 
                            :href="route('admin.tenants.create')"
                            class="bg-construction-500 hover:bg-construction-400 text-black border-4 border-black px-6 py-2 font-black uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none whitespace-nowrap mt-4 md:mt-0"
                        >
                            + Tambah Toko
                        </Link>
                    </div>

                    <!-- Table Container -->
                    <div class="overflow-x-auto border-4 border-black">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-construction-400 border-b-4 border-black uppercase text-sm font-black">
                                    <th class="p-4 border-r-4 border-black">Nama Toko</th>
                                    <th class="p-4 border-r-4 border-black">Slug (ID Unik)</th>
                                    <th class="p-4 border-r-4 border-black text-center">Jumlah Pegawai</th>
                                    <th class="p-4">Tanggal Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tenant, index) in tenants.data" :key="tenant.id" 
                                    class="border-b-4 border-black hover:bg-gray-100 transition-colors"
                                    :class="{'bg-gray-50': index % 2 === 0}">
                                    
                                    <td class="p-4 border-r-4 border-black font-black uppercase text-lg">
                                        {{ tenant.name }}
                                    </td>
                                    
                                    <td class="p-4 border-r-4 border-black font-bold">
                                        <span class="bg-black text-white px-2 py-1 text-xs tracking-widest">{{ tenant.slug }}</span>
                                    </td>
                                    
                                    <td class="p-4 border-r-4 border-black font-bold text-center">
                                        <div class="inline-flex items-center justify-center w-8 h-8 rounded-full border-2 border-black bg-construction-400 font-black">
                                            {{ tenant.users_count }}
                                        </div>
                                    </td>
                                    
                                    <td class="p-4 font-bold text-sm">
                                        {{ new Date(tenant.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) }}
                                    </td>
                                </tr>
                                <tr v-if="tenants.data.length === 0">
                                    <td colspan="4" class="p-8 text-center font-bold uppercase border-t-4 border-black">
                                        Belum ada data toko terdaftar.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Neo-Brutalist -->
                    <div v-if="tenants.links && tenants.links.length > 3" class="mt-8 flex justify-center gap-2 flex-wrap">
                        <template v-for="(link, k) in tenants.links" :key="k">
                            <div v-if="link.url === null" 
                                 class="px-4 py-2 border-4 border-gray-300 text-gray-400 font-black uppercase bg-gray-100" 
                                 v-html="link.label">
                            </div>
                            <Link v-else
                                  :href="link.url"
                                  class="px-4 py-2 border-4 border-black font-black uppercase transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none"
                                  :class="link.active ? 'bg-construction-500 text-black' : 'bg-white text-black'"
                                  v-html="link.label">
                            </Link>
                        </template>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
