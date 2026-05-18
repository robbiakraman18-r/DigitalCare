@extends('layouts.dokter')

@section('title', 'Diagnosis and Prescription')
@section('subtitle', 'Manage patient diagnosis and medication')

@section('content')

<div class="space-y-6">

    <!-- TOP -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- PATIENT -->
        <div class="xl:col-span-2 bg-white rounded-[32px] border border-slate-100 shadow-sm p-6">

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- PROFILE -->
                <div class="flex items-center gap-5">

                    <img
                    src="https://api.dicebear.com/7.x/adventurer/svg?seed=Kvaratshelia"
                    class="w-28 h-28 rounded-[28px] bg-slate-100 p-2">

                    <div class="space-y-3">

                        <h2 class="text-2xl font-bold text-slate-800">
                            Kvaratshelia
                        </h2>

                        <div class="space-y-2 text-slate-500 text-sm">

                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                20 Years Old
                            </div>

                            <div class="flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                Male
                            </div>

                            <div class="flex items-center gap-2">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                                +62 812 346 7890
                            </div>

                            <div class="flex items-center gap-2">
                                <i data-lucide="id-card" class="w-4 h-4"></i>
                                MRN : 00012345
                            </div>

                        </div>

                    </div>

                </div>

                <!-- COMPLAINT -->
                <div class="flex-1 border-l border-slate-200 pl-6">

                    <div class="flex items-center gap-2 mb-3">

                        <i data-lucide="message-square-more"
                        class="w-5 h-5 text-indigo-500"></i>

                        <h3 class="font-bold text-slate-800">
                            Chief Complaint
                        </h3>

                    </div>

                    <p class="text-slate-500 leading-relaxed">
                        Headache, fever, and cough for the past 2 days.
                    </p>

                </div>

            </div>

        </div>

        <!-- VISIT -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center">

                    <i data-lucide="calendar-check-2"
                    class="w-6 h-6 text-indigo-600"></i>

                </div>

                <div>

                    <h2 class="font-bold text-slate-800">
                        Visit Information
                    </h2>

                </div>

            </div>

            <div class="space-y-4 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-400">Visit Date</span>
                    <span class="font-semibold text-slate-700">26 May 2026</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Doctor</span>
                    <span class="font-semibold text-slate-700">dr. Andi Pratama</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Department</span>
                    <span class="font-semibold text-slate-700">General Practice</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-400">Status</span>
                    <span class="font-semibold text-green-500">Consultation</span>
                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- DIAGNOSIS -->
        <div class="xl:col-span-2 bg-white rounded-[32px] border border-slate-100 shadow-sm p-6">

            <div class="flex items-center gap-3 mb-8">

                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="heart-pulse"
                    class="w-6 h-6 text-blue-600"></i>

                </div>

                <h2 class="text-xl font-bold text-slate-800">
                    Diagnosis
                </h2>

            </div>

            <div class="space-y-5">

                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Chief Complaint
                    </label>

                    <textarea
                    rows="3"
                    class="mt-2 w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">Headache, fever, and cough for the past 2 days.</textarea>

                </div>

                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Medical History
                    </label>

                    <textarea
                    rows="3"
                    class="mt-2 w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">No history of chronic illness.</textarea>

                </div>

                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Examination Results
                    </label>

                    <textarea
                    rows="3"
                    class="mt-2 w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">Body temperature 38.2°C, normal blood pressure, throat redness.</textarea>

                </div>

                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Doctor's Diagnosis
                    </label>

                    <textarea
                    rows="3"
                    class="mt-2 w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500">Acute Pharyngitis (J02.9)</textarea>

                </div>

            </div>

        </div>

        <!-- PRESCRIPTION -->
        <div
        x-data="{
            medicines:[
                {
                    name:'Paracetamol 500mg',
                    dose:'1 Tablet',
                    frequency:'3 times a day',
                    duration:'5 Days'
                }
            ],

            addMedicine(){
                this.medicines.push({
                    name:'',
                    dose:'',
                    frequency:'',
                    duration:''
                })
            },

            removeMedicine(index){
                this.medicines.splice(index,1)
            }
        }"
        class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-6">

            <!-- TOP -->
<div class="flex items-start justify-between mb-6">

    <div class="flex items-center gap-3">

        <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center">

            <i data-lucide="pill"
            class="w-6 h-6 text-indigo-600"></i>

        </div>

        <div>

            <h2 class="text-xl font-bold text-slate-800">
                Prescription
            </h2>

            <p class="text-sm text-slate-400">
                Add medication for the patient
            </p>

        </div>

    </div>

    <!-- ACTION BUTTON -->
    <div class="flex items-center gap-3">

        <!-- ADD -->
        <button
        type="button"
        @click="addMedicine()"
        class="w-12 h-12 rounded-2xl bg-indigo-500 hover:bg-indigo-600 text-white flex items-center justify-center transition shadow-lg shadow-indigo-100">

            <i data-lucide="plus"
            class="w-5 h-5"></i>

        </button>

        <!-- DELETE -->
        <button
        type="button"
        x-show="medicines.length > 1"
        @click="removeMedicine(medicines.length - 1)"
        class="w-12 h-12 rounded-2xl bg-red-50 hover:bg-red-100 border border-red-100 flex items-center justify-center transition">

            <i data-lucide="trash-2"
            class="w-5 h-5 text-red-500"></i>

        </button>

    </div>

</div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px]">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="text-left px-4 py-4 text-sm font-semibold text-slate-400">
                                Medicine
                            </th>

                            <th class="text-left px-4 py-4 text-sm font-semibold text-slate-400">
                                Dose
                            </th>

                            <th class="text-left px-4 py-4 text-sm font-semibold text-slate-400">
                                Frequency
                            </th>

                            <th class="text-left px-4 py-4 text-sm font-semibold text-slate-400">
                                Duration
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <template
                        x-for="(medicine,index) in medicines"
                        :key="index">

                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                                <!-- NAME -->
                                <td class="px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        <input
                                        type="text"
                                        x-model="medicine.name"
                                        placeholder="Medicine name"
                                        class="flex-1 px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                                        <!-- DELETE -->
                                        <button
                                        type="button"
                                        x-show="medicines.length > 1"
                                        @click="removeMedicine(index)"
                                        class="w-11 h-11 rounded-2xl bg-red-50 hover:bg-red-100 border border-red-100 flex items-center justify-center transition-all duration-300 hover:scale-105 shrink-0">

                                            <i data-lucide="trash-2"
                                            class="w-5 h-5 text-red-500"></i>

                                        </button>

                                    </div>

                                </td>

                                <!-- DOSE -->
                                <td class="px-4 py-4">

                                    <input
                                    type="text"
                                    x-model="medicine.dose"
                                    placeholder="1 Tablet"
                                    class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                                </td>

                                <!-- FREQUENCY -->
                                <td class="px-4 py-4">

                                    <input
                                    type="text"
                                    x-model="medicine.frequency"
                                    placeholder="3 times a day"
                                    class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                                </td>

                                <!-- DURATION -->
                                <td class="px-4 py-4">

                                    <input
                                    type="text"
                                    x-model="medicine.duration"
                                    placeholder="5 Days"
                                    class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                                </td>

                            </tr>

                        </template>

                    </tbody>

                </table>

            </div>

            <!-- INFO -->
            <div class="mt-6 p-4 rounded-2xl bg-green-50 border border-green-100">

                <div class="flex items-start gap-3">

                    <i data-lucide="info"
                    class="w-5 h-5 text-green-500 mt-0.5"></i>

                    <p class="text-sm text-green-700 leading-relaxed">

                        After the diagnosis and prescription are saved,
                        the data will automatically appear on:

                        <span class="font-semibold">
                            Doctor Medical Records,
                            Patient Data,
                            and Admin Medical Records.
                        </span>

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- ACTION BUTTON -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- SAVE -->
        <button
        class="py-5 rounded-2xl bg-blue-50 hover:bg-blue-100 transition border border-blue-100">

            <i data-lucide="save"
            class="w-6 h-6 text-blue-600 mx-auto mb-3"></i>

            <h3 class="font-bold text-slate-800">
                Save Diagnosis
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Save to medical records
            </p>

        </button>

        <!-- PRINT -->
        <button
        class="py-5 rounded-2xl bg-green-50 hover:bg-green-100 transition border border-green-100">

            <i data-lucide="printer"
            class="w-6 h-6 text-green-600 mx-auto mb-3"></i>

            <h3 class="font-bold text-slate-800">
                Print Prescription
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Print patient prescription
            </p>

        </button>

        <!-- SEND -->
        <button
        class="py-5 rounded-2xl bg-pink-50 hover:bg-pink-100 transition border border-pink-100">

            <i data-lucide="send"
            class="w-6 h-6 text-pink-600 mx-auto mb-3"></i>

            <h3 class="font-bold text-slate-800">
                Send To Patient
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Send diagnosis results
            </p>

        </button>

    </div>

</div>

@endsection