<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const showingNavigationDropdown = ref(false);
const page = usePage();
</script>

<template>
    <div class="min-h-screen bg-[#FAFAFA] flex font-sans">
        <!-- Sidebar Utama (Neo-Brutalist) -->
        <aside class="hidden md:flex flex-col w-64 bg-white border-r-2 border-steel-900 shadow-neo z-20">
            <!-- Logo & Brand -->
            <div class="h-16 flex items-center px-6 border-b-2 border-steel-900 bg-construction-400">
                <Link :href="route('dashboard')" class="flex items-center gap-3">
                    <svg class="h-8 w-auto text-steel-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <span class="text-xl font-black text-steel-900 tracking-tight uppercase">SaaS Bangunan</span>
                </Link>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto">
                <Link
                    :href="route('dashboard')"
                    :class="route().current('dashboard') ? 'bg-construction-400 text-steel-900 border-2 border-steel-900 shadow-neo' : 'text-steel-800 border-2 border-transparent hover:border-steel-900 hover:bg-gray-100 hover:shadow-neo'"
                    class="group flex items-center px-3 py-2.5 text-sm font-bold rounded-none transition-all duration-200 uppercase tracking-wide"
                >
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    Dashboard
                </Link>

                <Link
                    href="/users" 
                    :class="$page.url.startsWith('/users') ? 'bg-construction-400 text-steel-900 border-2 border-steel-900 shadow-neo' : 'text-steel-800 border-2 border-transparent hover:border-steel-900 hover:bg-gray-100 hover:shadow-neo'"
                    class="group flex items-center px-3 py-2.5 text-sm font-bold rounded-none transition-all duration-200 uppercase tracking-wide"
                >
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Manajemen User
                </Link>

                <Link
                    href="/debts" 
                    :class="$page.url.startsWith('/debts') ? 'bg-construction-400 text-steel-900 border-2 border-steel-900 shadow-neo' : 'text-steel-800 border-2 border-transparent hover:border-steel-900 hover:bg-gray-100 hover:shadow-neo'"
                    class="group flex items-center px-3 py-2.5 text-sm font-bold rounded-none transition-all duration-200 uppercase tracking-wide"
                >
                    <!-- Icon for Kasbon Mandor (Credit Card / Wallet) -->
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                    Kasbon Mandor
                </Link>

                <!-- Menu Khusus Super Admin -->
                <Link
                    v-if="$page.props.auth.user.role === 'super_admin'"
                    :href="route('admin.tenants.index')" 
                    :class="$page.url.startsWith('/admin/tenants') ? 'bg-construction-400 text-steel-900 border-2 border-steel-900 shadow-neo' : 'text-steel-800 border-2 border-transparent hover:border-steel-900 hover:bg-gray-100 hover:shadow-neo'"
                    class="group flex items-center px-3 py-2.5 text-sm font-bold rounded-none transition-all duration-200 uppercase tracking-wide mt-4 border-t-4 border-steel-900 pt-4"
                >
                    <!-- Icon for Tenants (Building/Store) -->
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75v-3.75a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>
                    Manajemen Toko
                </Link>
                <Link
                    v-if="$page.props.auth.user.role === 'super_admin'"
                    :href="route('admin.activity_logs.index')" 
                    :class="$page.url.startsWith('/admin/activity-logs') ? 'bg-construction-400 text-steel-900 border-2 border-steel-900 shadow-neo' : 'text-steel-800 border-2 border-transparent hover:border-steel-900 hover:bg-gray-100 hover:shadow-neo'"
                    class="group flex items-center px-3 py-2.5 text-sm font-bold rounded-none transition-all duration-200 uppercase tracking-wide"
                >
                    <!-- Icon for Activity Log (List / Eye) -->
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                    </svg>
                    Log Aktivitas
                </Link>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navbar (Header) -->
            <header class="bg-white border-b-2 border-steel-900 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0 z-10 shadow-neo-sm relative">
                <!-- Mobile Menu Button & Tenant Name -->
                <div class="flex items-center gap-4">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-none text-steel-900 border-2 border-transparent hover:border-steel-900 hover:bg-construction-400 transition-colors"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Nama Toko (Otomatis dari Middleware yang kita buat) -->
                    <div class="flex items-center">
                        <span class="bg-steel-900 text-white text-xs font-bold px-3 py-1.5 uppercase tracking-widest shadow-neo">
                            🏢 {{ page.props.auth.user.tenant ? page.props.auth.user.tenant.name : 'AREA SUPER ADMIN' }}
                        </span>
                    </div>
                </div>

                <!-- User Dropdown (Kanan) -->
                <div class="flex items-center">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button class="flex items-center gap-2 text-sm font-bold text-steel-900 border-2 border-transparent hover:border-steel-900 px-3 py-1 bg-white hover:bg-construction-400 hover:shadow-neo transition-all">
                                <div class="flex flex-col text-right hidden sm:block">
                                    <span class="block font-black uppercase">{{ page.props.auth.user.name }}</span>
                                    <span class="block text-[10px] text-steel-800 uppercase tracking-widest border-t-2 border-steel-900 mt-1 pt-0.5">{{ page.props.auth.user.role }}</span>
                                </div>
                                <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </template>

                        <template #content>
                            <div class="border-2 border-steel-900 bg-white shadow-neo">
                                <DropdownLink :href="route('profile.edit')" class="hover:bg-construction-400 font-bold uppercase text-sm border-b-2 border-steel-900">Profile</DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button" class="hover:bg-construction-400 font-bold uppercase text-sm text-brick-600">Log Out</DropdownLink>
                            </div>
                        </template>
                    </Dropdown>
                </div>
            </header>

            <!-- Page Header Slot -->
            <header class="bg-white border-b-2 border-steel-900" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>
