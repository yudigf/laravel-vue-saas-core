<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    logs: {
        type: Object,
        required: true
    }
});

const formatDate = (dateString) => {
    if (!dateString) return '-';
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

const getEventColor = (event) => {
    switch (event) {
        case 'created':
            return 'bg-green-400 text-black';
        case 'updated':
            return 'bg-yellow-400 text-black';
        case 'deleted':
            return 'bg-red-400 text-black';
        default:
            return 'bg-gray-200 text-black';
    }
};

const formatModelName = (modelClass) => {
    if (!modelClass) return '-';
    // Mengambil nama class dari namespace (misal App\Models\User -> User)
    const parts = modelClass.split('\\');
    return parts[parts.length - 1];
};
</script>

<template>
    <Head title="Log Aktivitas Sistem" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-black uppercase tracking-widest">
                LOG AKTIVITAS SISTEM
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Neo-Brutalist Container -->
                <div class="bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b-4 border-black pb-4">
                        <div>
                            <h3 class="text-xl font-bold uppercase">Riwayat Perubahan Data</h3>
                            <p class="text-sm font-bold text-gray-600 uppercase mt-1">Halaman Khusus Super Admin</p>
                        </div>
                    </div>

                    <!-- Table Container -->
                    <div class="overflow-x-auto border-4 border-black">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-construction-400 border-b-4 border-black uppercase text-sm font-black">
                                    <th class="p-4 border-r-4 border-black">Waktu</th>
                                    <th class="p-4 border-r-4 border-black">Aksi</th>
                                    <th class="p-4 border-r-4 border-black">Tipe Data</th>
                                    <th class="p-4">Pelaku (Causer)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(log, index) in logs.data" :key="log.id" 
                                    class="border-b-4 border-black hover:bg-gray-100 transition-colors"
                                    :class="{'bg-gray-50': index % 2 === 0}">
                                    
                                    <td class="p-4 border-r-4 border-black font-bold text-sm">
                                        {{ formatDate(log.created_at) }}
                                    </td>
                                    
                                    <td class="p-4 border-r-4 border-black font-bold">
                                        <span class="px-3 py-1 border-2 border-black font-black uppercase text-xs" :class="getEventColor(log.event)">
                                            {{ log.event }}
                                        </span>
                                    </td>
                                    
                                    <td class="p-4 border-r-4 border-black">
                                        <div class="font-bold uppercase">{{ formatModelName(log.subject_type) }}</div>
                                        <div class="text-xs font-bold text-gray-600">ID: {{ log.subject_id }}</div>
                                    </td>
                                    
                                    <td class="p-4 font-bold">
                                        <div v-if="log.causer">
                                            <div class="uppercase">{{ log.causer.name }}</div>
                                            <div class="text-xs text-gray-600">{{ log.causer.email }}</div>
                                        </div>
                                        <div v-else class="text-gray-400 italic uppercase">
                                            Sistem / Tidak Diketahui
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="logs.data.length === 0">
                                    <td colspan="4" class="p-8 text-center font-bold uppercase border-t-4 border-black">
                                        Belum ada aktivitas yang terekam
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Neo-Brutalist -->
                    <div v-if="logs.links && logs.links.length > 3" class="mt-8 flex justify-center gap-2 flex-wrap">
                        <template v-for="(link, k) in logs.links" :key="k">
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
