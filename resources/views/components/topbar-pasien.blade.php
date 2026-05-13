<header class="flex justify-between items-center px-6 lg:px-10 py-6">
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            @yield('title')
        </h1>
        <p class="text-slate-400 text-sm mt-1">
            @yield('subtitle')
        </p>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <!-- NOTIFICATION -->
        @include('components.notifikasi-pasien')

        <!-- PROFILE -->
        <div class="relative">

            <button
                @click="openProfile = !openProfile"
                class="flex items-center gap-3 bg-white px-3 py-2 rounded-2xl shadow-sm border border-slate-100 hover:bg-slate-50 transition-all duration-300"
            >
                <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-xl object-cover">

                <div class="hidden md:block text-left">
                    <h3 class="text-sm font-semibold text-slate-800">
                        Rizki A
                    </h3>

                    <p class="text-xs text-slate-400">
                        Pasien
                    </p>
                </div>
            </button>

            <!-- DROPDOWN -->
            <div
                x-show="openProfile"
                x-transition.scale.origin.top.right
                @click.away="openProfile = false"
                class="absolute right-0 mt-4 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 p-5 z-50"
                style="display:none;"
            >

                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100" class="w-14 h-14 rounded-2xl">

                    <div>
                        <h2 class="font-bold text-slate-800">
                            Rizki A
                        </h2>

                        <p class="text-sm text-slate-400">
                            rizki@email.com
                        </p>
                    </div>
                </div>

                <div class="mt-5 space-y-3 text-sm border-t pt-4">

                    <div class="flex justify-between">
                        <span class="text-slate-400">NIM</span>
                        <span class="font-medium">12345678</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Status</span>
                        <span class="font-medium text-teal-500">
                            Pasien
                        </span>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-5">
                    <a
                        href="/edit-profile"
                        class="flex items-center justify-center gap-2 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-medium transition-all duration-300"
                    >
                        <i data-lucide="user-cog" class="w-4 h-4"></i>
                        Edit Profil
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>