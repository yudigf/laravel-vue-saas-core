<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    tenants: Array
});

const page = usePage();
const isSuperAdmin = page.props.auth.user.role === 'super_admin';

const form = useForm({
    name: '',
    email: '',
    password: '',
    role: isSuperAdmin ? '' : 'tenant_staff', // Default untuk admin toko
    tenant_id: ''
});

const submit = () => {
    form.post(route('users.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Tambah Pengguna" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-black uppercase tracking-widest">
                TAMBAH PENGGUNA BARU
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Neo-Brutalist Container -->
                <div class="bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 mb-8">
                    
                    <div class="mb-6 border-b-4 border-black pb-4">
                        <h3 class="text-xl font-black uppercase">Formulir Pendaftaran</h3>
                        <p class="text-sm font-bold text-gray-600 mt-1 uppercase">Silakan lengkapi data pengguna di bawah ini.</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-black text-black uppercase mb-2">Nama Lengkap</label>
                            <input 
                                type="text" 
                                id="name"
                                v-model="form.name"
                                class="w-full border-4 border-black p-3 font-bold text-black focus:ring-0 focus:outline-none focus:border-construction-500 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all"
                                placeholder="Cth: Budi Santoso"
                            />
                            <div v-if="form.errors.name" class="mt-2 text-red-600 font-bold uppercase text-xs">
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-black text-black uppercase mb-2">Email Address</label>
                            <input 
                                type="email" 
                                id="email"
                                v-model="form.email"
                                class="w-full border-4 border-black p-3 font-bold text-black focus:ring-0 focus:outline-none focus:border-construction-500 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all"
                                placeholder="Cth: budi@majujaya.com"
                            />
                            <div v-if="form.errors.email" class="mt-2 text-red-600 font-bold uppercase text-xs">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-black text-black uppercase mb-2">Kata Sandi (Password)</label>
                            <input 
                                type="password" 
                                id="password"
                                v-model="form.password"
                                class="w-full border-4 border-black p-3 font-bold text-black focus:ring-0 focus:outline-none focus:border-construction-500 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all"
                                placeholder="Minimal 8 karakter"
                            />
                            <div v-if="form.errors.password" class="mt-2 text-red-600 font-bold uppercase text-xs">
                                {{ form.errors.password }}
                            </div>
                        </div>

                        <!-- KHUSUS SUPER ADMIN: Pilihan Toko & Role -->
                        <div v-if="isSuperAdmin" class="p-4 border-4 border-black bg-construction-400/20 space-y-6">
                            <div class="inline-block bg-black text-white px-3 py-1 font-black uppercase text-xs mb-2">
                                Khusus Super Admin
                            </div>

                            <div>
                                <label for="tenant_id" class="block text-sm font-black text-black uppercase mb-2">Pilih Toko / Tenant</label>
                                <select 
                                    id="tenant_id"
                                    v-model="form.tenant_id"
                                    class="w-full border-4 border-black p-3 font-bold text-black focus:ring-0 focus:outline-none shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-white appearance-none cursor-pointer"
                                >
                                    <option value="" disabled>-- Pilih Toko Tujuan --</option>
                                    <option v-for="tenant in tenants" :key="tenant.id" :value="tenant.id">
                                        {{ tenant.name }}
                                    </option>
                                </select>
                                <div v-if="form.errors.tenant_id" class="mt-2 text-red-600 font-bold uppercase text-xs">
                                    {{ form.errors.tenant_id }}
                                </div>
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-black text-black uppercase mb-2">Peran Pengguna (Role)</label>
                                <select 
                                    id="role"
                                    v-model="form.role"
                                    class="w-full border-4 border-black p-3 font-bold text-black focus:ring-0 focus:outline-none shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-white appearance-none cursor-pointer"
                                >
                                    <option value="" disabled>-- Pilih Peran --</option>
                                    <option value="tenant_admin">Admin Toko</option>
                                    <option value="tenant_staff">Staf Toko</option>
                                </select>
                                <div v-if="form.errors.role" class="mt-2 text-red-600 font-bold uppercase text-xs">
                                    {{ form.errors.role }}
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 flex justify-end">
                            <button 
                                type="submit" 
                                :disabled="form.processing"
                                class="bg-construction-500 hover:bg-construction-400 text-black border-4 border-black px-8 py-3 font-black uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none disabled:opacity-50"
                            >
                                {{ form.processing ? 'Menyimpan...' : 'Simpan Pengguna' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
