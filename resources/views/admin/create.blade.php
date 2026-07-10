@extends('layouts.admin')

@section('content')

<div x-data="addDoctorForm()" class="space-y-6">

    <!-- TOP -->
    <div class="flex items-center justify-between gap-4">

        <div>
            <a
            href="{{ route('admin.user-management') }}"
            class="inline-flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-600 transition mb-2">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                Back to User Management
            </a>

            <h1 class="text-3xl font-bold text-slate-800">
                Add Doctor
            </h1>

            <p class="text-slate-400 mt-1">
                Register a new doctor account and their practice details.
            </p>
        </div>

    </div>

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 shrink-0"></i>
            <ul class="text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
    action="{{ route('admin.doctor.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6">
    @csrf

    <div class="bg-white rounded-[30px] border border-slate-100 shadow-sm p-8">

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

            <!-- LEFT: PHOTO -->
<div class="xl:col-span-3">

    <p class="font-semibold text-slate-800 mb-4">
        Foto Profil
    </p>

    <div class="flex items-start gap-4">

        <div
        @click="$refs.fotoInput.click()"
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="onDrop($event)"
        :class="dragging ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-blue-300 hover:bg-slate-50'"
        class="relative w-40 h-40 shrink-0 rounded-3xl border-2 border-dashed flex flex-col items-center justify-center overflow-hidden cursor-pointer transition group">

            <template x-if="!preview">
                <div class="flex flex-col items-center gap-2 px-4 text-center">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center group-hover:scale-105 transition">
                        <i data-lucide="upload" class="w-5 h-5 text-blue-600"></i>
                    </div>
                    <p class="text-sm font-semibold text-slate-600">
                        Klik untuk upload
                    </p>
                    <p class="text-xs text-slate-400">
                        atau drag & drop<br>JPG/PNG
                    </p>
                </div>
            </template>

            <img
            x-show="preview"
            :src="preview"
            class="w-full h-full object-cover">

            <div
            x-show="preview"
            class="absolute inset-0 bg-black/0 group-hover:bg-black/40 flex items-center justify-center transition">
                <span class="opacity-0 group-hover:opacity-100 text-white text-sm font-semibold transition">
                    Ganti foto
                </span>
            </div>

            <input
            x-ref="fotoInput"
            type="file"
            name="foto_profil"
            accept="image/png, image/jpeg, image/jpg"
            class="hidden"
            @click.stop
            @change="onFileChange($event)">

        </div>

        <!-- TIPS: KANAN -->
        <div class="flex-1 p-4 rounded-2xl bg-blue-50/60 border border-blue-100">
            <div class="flex items-center gap-2 mb-2">
                <i data-lucide="info" class="w-4 h-4 text-blue-500"></i>
                <p class="text-sm font-semibold text-slate-700">Tips Foto</p>
            </div>
            <ul class="text-xs text-slate-500 space-y-1.5 list-disc list-inside">
                <li>Gunakan foto tampak depan yang jelas</li>
                <li>Latar belakang polos lebih baik</li>
                <li>Foto rasio persegi hasilnya paling rapi</li>
            </ul>
        </div>

    </div>

    <button
    type="button"
    x-show="preview"
    @click="clearPhoto()"
    class="mt-3 text-sm font-medium text-red-500 hover:text-red-600 transition flex items-center gap-1.5">
        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
        Hapus foto
    </button>

</div>

            <!-- RIGHT: FORM -->
            <div class="xl:col-span-9 space-y-8">

                <!-- ACCOUNT INFO -->
                <div>

                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center">
                            <i data-lucide="id-card" class="w-4 h-4 text-blue-600"></i>
                        </div>
                        <p class="font-semibold text-slate-800">
                            Account Information
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div class="sm:col-span-2">
                            <label class="text-sm font-medium text-slate-600">
                                Doctor Name
                            </label>

                            <div class="relative mt-2">
                                <i data-lucide="user" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                                <input
                                type="text"
                                name="nama"
                                value="{{ old('nama') }}"
                                required
                                placeholder="e.g. Dr. Maria Jessica"
                                class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-600">
                                Email
                            </label>

                            <div class="relative mt-2">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                                <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="doctor@digitalcare.com"
                                class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-600">
                                Password
                            </label>

                            <div class="relative mt-2">
                                <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                                <input
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                minlength="8"
                                placeholder="Minimum 8 characters"
                                class="w-full pl-11 pr-11 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">

                                <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                    <i x-show="!showPassword" data-lucide="eye" class="w-4 h-4"></i>
                                    <i x-show="showPassword" data-lucide="eye-off" class="w-4 h-4" x-cloak></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="border-t border-slate-100"></div>

                <!-- PROFESSIONAL INFO -->
                <div>

                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-8 h-8 rounded-xl bg-cyan-100 flex items-center justify-center">
                            <i data-lucide="stethoscope" class="w-4 h-4 text-cyan-600"></i>
                        </div>
                        <p class="font-semibold text-slate-800">
                            Professional Details
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                        <div>
                            <label class="text-sm font-medium text-slate-600">
                                No SIP
                            </label>

                            <div class="relative mt-2">
                                <i data-lucide="badge-check" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                                <input
                                type="text"
                                name="no_sip"
                                value="{{ old('no_sip') }}"
                                required
                                placeholder="e.g. 1234567890"
                                class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-600">
                                Gender
                            </label>

                            <div class="grid grid-cols-2 gap-2 mt-2">

                                <label class="cursor-pointer">
                                    <input type="radio" name="gender" value="Male" class="peer sr-only" checked>
                                    <div class="px-4 py-3 rounded-2xl border border-slate-200 text-center text-sm font-medium text-slate-500 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition">
                                        Male
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="gender" value="Female" class="peer sr-only">
                                    <div class="px-4 py-3 rounded-2xl border border-slate-200 text-center text-sm font-medium text-slate-500 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition">
                                        Female
                                    </div>
                                </label>

                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-600">
                                Availability
                            </label>

                            <div class="relative mt-2">
                                <select
                                name="status_ketersediaan"
                                class="w-full pl-4 pr-10 py-3 rounded-2xl border border-slate-200 bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">

                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>

                                </select>

                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ACTIONS -->
    <div class="flex justify-end gap-3">

        <a
        href="{{ route('admin.user-management') }}"
        class="px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">
            Cancel
        </a>

        <button
        type="submit"
        :disabled="submitting"
        class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 disabled:opacity-60 disabled:cursor-not-allowed text-white font-semibold transition inline-flex items-center gap-2">

            <i data-lucide="save" class="w-4 h-4" x-show="!submitting"></i>
            <span x-text="submitting ? 'Saving...' : 'Save Doctor'"></span>

        </button>

    </div>

    </form>

</div>

<script>
function addDoctorForm() {
    return {
        preview: null,
        showPassword: false,
        submitting: false,
        dragging: false,
        onFileChange(event) {
            const file = event.target.files[0];
            if (!file) {
                this.preview = null;
                return;
            }
            this.preview = URL.createObjectURL(file);
        },
        onDrop(event) {
            this.dragging = false;
            const file = event.dataTransfer.files[0];
            if (!file) return;

            this.$refs.fotoInput.files = event.dataTransfer.files;
            this.preview = URL.createObjectURL(file);
        },
        clearPhoto() {
            this.preview = null;
            this.$refs.fotoInput.value = '';
        }
    }
}
</script>

@endsection