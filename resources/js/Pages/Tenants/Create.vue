<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route('admin.tenants.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Tambah Toko Baru" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-black uppercase tracking-widest">
                TAMBAH TOKO BARU
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Neo-Brutalist Container -->
                <div class="bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 mb-8">
                    
                    <div class="mb-6 border-b-4 border-black pb-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-black uppercase">Formulir Pendaftaran Toko</h3>
                            <p class="text-sm font-bold text-gray-600 mt-1 uppercase">Silakan masukkan nama toko/tenant yang baru.</p>
                        </div>
                        <Link 
                            :href="route('admin.tenants.index')"
                            class="bg-white text-black border-4 border-black px-4 py-2 font-black uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none text-xs"
                        >
                            &larr; KEMBALI
                        </Link>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Peringatan Otomatisasi -->
                        <div class="bg-construction-400 border-4 border-black p-4 text-sm font-bold uppercase flex gap-4 items-center">
                            <span class="text-2xl">⚡</span>
                            <p><strong>Info Cerdas:</strong> Anda hanya perlu memasukkan Nama Toko. Sistem akan otomatis men-generate Slug/ID Unik di balik layar.</p>
                        </div>

                        <!-- Nama Toko -->
                        <div>
                            <label for="name" class="block text-sm font-black text-black uppercase mb-2">Nama Toko Lengkap</label>
                            <input 
                                type="text" 
                                id="name"
                                v-model="form.name"
                                class="w-full border-4 border-black p-4 font-bold text-black focus:ring-0 focus:outline-none focus:border-construction-500 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all text-xl"
                                placeholder="Cth: PT. Bangun Persada Abadi"
                            />
                            <div v-if="form.errors.name" class="mt-2 text-red-600 font-bold uppercase text-sm bg-red-100 border-2 border-red-600 p-2 inline-block">
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 flex justify-end">
                            <button 
                                type="submit" 
                                :disabled="form.processing"
                                class="bg-construction-500 hover:bg-construction-400 text-black border-4 border-black px-8 py-4 text-lg font-black uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none disabled:opacity-50 flex items-center gap-2"
                            >
                                <span v-if="form.processing">Menyimpan...</span>
                                <span v-else>Simpan Toko</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
