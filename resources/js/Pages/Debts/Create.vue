<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

defineProps({
    contractors: Array,
});

const form = useForm({
    contractor_id: '',
    amount: '',
    due_date: '',
    description: '',
});

const submit = () => {
    // Karena kita akan membuat rute debts.store nanti, kita tembak POST ke /debts
    form.post('/debts', {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Tambah Kasbon" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-black text-xl text-steel-900 uppercase tracking-widest">Tambah Kasbon Mandor</h2>
                <Link href="/debts" class="text-sm font-bold text-steel-900 border-2 border-transparent hover:border-steel-900 hover:bg-construction-400 hover:shadow-neo px-3 py-1.5 transition-all uppercase">
                    &larr; Kembali ke Daftar
                </Link>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden border-2 border-steel-900 shadow-neo p-8">
                    
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Dropdown Mandor -->
                        <div>
                            <label for="contractor_id" class="block text-sm font-black text-steel-900 uppercase tracking-wide">Pilih Mandor <span class="text-brick-600">*</span></label>
                            <select 
                                id="contractor_id" 
                                v-model="form.contractor_id"
                                class="mt-1 block w-full rounded-none border-2 border-steel-900 shadow-neo-sm focus:ring-0 focus:border-steel-900 focus:bg-construction-400/10 sm:text-sm font-bold text-steel-900 transition-colors"
                                required
                            >
                                <option value="" disabled>-- Pilih Mandor --</option>
                                <option v-for="contractor in contractors" :key="contractor.id" :value="contractor.id">
                                    {{ contractor.name }} ({{ contractor.phone || 'No HP Belum Diisi' }})
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.contractor_id" />
                            <p v-if="contractors.length === 0" class="text-xs font-bold text-brick-600 mt-2">Belum ada mandor terdaftar di Toko ini.</p>
                        </div>

                        <!-- Nominal Kasbon -->
                        <div>
                            <label for="amount" class="block text-sm font-black text-steel-900 uppercase tracking-wide">Nominal Kasbon (Rp) <span class="text-brick-600">*</span></label>
                            <div class="relative mt-1">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-steel-900 font-black sm:text-sm">Rp</span>
                                </div>
                                <input 
                                    type="number" 
                                    id="amount" 
                                    v-model="form.amount"
                                    class="block w-full rounded-none border-2 border-steel-900 shadow-neo-sm pl-10 focus:ring-0 focus:border-steel-900 focus:bg-construction-400/10 sm:text-sm font-bold text-steel-900 transition-colors"
                                    placeholder="0"
                                    min="0"
                                    required
                                >
                            </div>
                            <InputError class="mt-2" :message="form.errors.amount" />
                        </div>

                        <!-- Jatuh Tempo -->
                        <div>
                            <label for="due_date" class="block text-sm font-black text-steel-900 uppercase tracking-wide">Tanggal Jatuh Tempo <span class="text-brick-600">*</span></label>
                            <input 
                                type="date" 
                                id="due_date" 
                                v-model="form.due_date"
                                class="mt-1 block w-full rounded-none border-2 border-steel-900 shadow-neo-sm focus:ring-0 focus:border-steel-900 focus:bg-construction-400/10 sm:text-sm font-bold text-steel-900 transition-colors"
                                required
                            >
                            <InputError class="mt-2 font-bold" :message="form.errors.due_date" />
                        </div>

                        <!-- Rincian Barang / Keterangan -->
                        <div>
                            <label for="description" class="block text-sm font-black text-steel-900 uppercase tracking-wide">Rincian Barang (Wajib Diisi) <span class="text-brick-600">*</span></label>
                            <p class="text-xs text-steel-800 font-bold mb-2">Catat nama barang, jumlah sak semen, besi, dll secara detail.</p>
                            <textarea 
                                id="description" 
                                v-model="form.description"
                                rows="4"
                                class="mt-1 block w-full rounded-none border-2 border-steel-900 shadow-neo-sm focus:ring-0 focus:border-steel-900 focus:bg-construction-400/10 sm:text-sm font-bold text-steel-900 transition-colors"
                                placeholder="Contoh: Semen Gresik 50 Sak, Besi 10mm 20 batang. Diambil oleh tukang A."
                                required
                            ></textarea>
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end border-t-2 border-steel-900 pt-6">
                            <button 
                                type="submit" 
                                :disabled="form.processing"
                                class="inline-flex items-center px-6 py-3 bg-construction-500 border-2 border-steel-900 shadow-neo hover:shadow-none hover:translate-y-1 hover:translate-x-1 font-black text-sm text-steel-900 uppercase tracking-widest transition-all disabled:opacity-50"
                            >
                                <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-steel-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ form.processing ? 'MENYIMPAN DATA...' : 'SIMPAN KASBON' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
