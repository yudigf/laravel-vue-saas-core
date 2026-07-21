<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    debts: Object,
});

// Helper function to format IDR currency
const formatCurrency = (value) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value);
};
</script>

<template>
    <Head title="Kasbon Mandor" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kasbon Mandor</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Card Container (Neo-Brutalist) -->
                <div class="bg-white overflow-hidden border-2 border-steel-900 shadow-neo">
                    
                    <!-- Table Header & Action Button -->
                    <div class="p-6 border-b-2 border-steel-900 flex justify-between items-center bg-white">
                        <div>
                            <h3 class="text-xl font-black text-steel-900 uppercase">Daftar Pencatatan Kasbon</h3>
                            <p class="text-sm text-steel-800 mt-1 font-bold">Kelola data pinjaman mandor dan pemborong Anda.</p>
                        </div>
                        <Link href="/debts/create" class="bg-construction-500 text-steel-900 px-5 py-2.5 border-2 border-steel-900 shadow-neo hover:shadow-none hover:translate-y-1 hover:translate-x-1 text-sm font-black transition-all uppercase tracking-wide">
                            + Tambah Kasbon
                        </Link>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-steel-900">
                            <thead class="text-xs text-steel-900 uppercase bg-construction-400 border-b-2 border-steel-900">
                                <tr>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Nama Mandor</th>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Nominal (Rp)</th>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Tanggal Kasbon</th>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Jatuh Tempo</th>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Status</th>
                                    <th scope="col" class="px-6 py-4 border-r-2 border-steel-900 font-black">Keterangan</th>
                                    <th scope="col" class="px-6 py-4 font-black text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y-2 divide-steel-900">
                                <tr v-for="debt in debts.data" :key="debt.id" class="bg-white hover:bg-gray-100 transition-colors">
                                    <td class="px-6 py-4 font-black border-r-2 border-steel-900">
                                        {{ debt.contractor.name }}
                                    </td>
                                    <td class="px-6 py-4 font-black text-brick-600 border-r-2 border-steel-900">
                                        {{ formatCurrency(debt.amount) }}
                                    </td>
                                    <td class="px-6 py-4 text-steel-800 font-bold border-r-2 border-steel-900">
                                        {{ new Date(debt.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) }}
                                    </td>
                                    <td class="px-6 py-4 text-steel-800 font-bold border-r-2 border-steel-900">
                                        {{ new Date(debt.due_date).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) }}
                                    </td>
                                    <td class="px-6 py-4 border-r-2 border-steel-900">
                                        <span 
                                            class="px-3 py-1 text-[10px] font-black tracking-widest uppercase border-2 border-steel-900 shadow-neo-sm"
                                            :class="{
                                                'bg-brick-600 text-white': debt.status === 'unpaid',
                                                'bg-green-500 text-white': debt.status === 'paid',
                                                'bg-construction-500 text-steel-900': debt.status === 'partial'
                                            }"
                                        >
                                            {{ debt.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-steel-800 font-bold border-r-2 border-steel-900">
                                        {{ debt.description || '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="bg-steel-900 text-white px-3 py-1 font-bold text-xs hover:bg-steel-800 transition-colors uppercase tracking-widest shadow-neo-sm">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                <!-- Tampilan saat data kosong -->
                                <tr v-if="debts.data.length === 0">
                                    <td colspan="7" class="px-6 py-8 text-center text-steel-800 font-bold bg-white">
                                        Belum ada data kasbon mandor saat ini.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginasi (Basic placeholder) -->
                    <div v-if="debts.data.length > 0" class="p-4 border-t-2 border-steel-900 bg-white text-xs text-steel-900 flex justify-between items-center font-bold">
                        <span class="uppercase tracking-widest">Menampilkan {{ debts.from }} sampai {{ debts.to }} dari {{ debts.total }} data.</span>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
