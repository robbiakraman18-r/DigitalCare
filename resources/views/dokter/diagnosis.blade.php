@extends('layouts.dokter')

@section('title', 'Doctor Diagnosis Form')

@section('content')

<div class="min-h-screen bg-slate-100 p-6">

    <div class="max-w-7xl mx-auto bg-white rounded-[35px] border border-sky-100 shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-10 py-8 text-white">

            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-4xl font-black tracking-wide">
                        FORM DIAGNOSA DOKTER
                    </h1>

                    <p class="mt-2 text-cyan-100 text-lg">
                        Doctor Diagnosis Form
                    </p>

                </div>

                <div class="bg-white/20 px-6 py-4 rounded-3xl">

                    <div class="space-y-2 text-sm">

                        <div>
                            <span class="font-semibold">Medical Record :</span>
                            RM.2026.00123
                        </div>

                        <div>
                            <span class="font-semibold">Date :</span>
                            26 May 2026
                        </div>

                        <div>
                            <span class="font-semibold">Time :</span>
                            10:45 WIB
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-8 space-y-8">

            <!-- PATIENT -->
            <div class="bg-sky-50 border border-sky-100 rounded-[30px] p-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-blue-500 text-white flex items-center justify-center text-xl">
                        👤
                    </div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Patient Information
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="space-y-4">

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Patient Name
                            </label>

                            <input type="text"
                            value="Andi Pratama"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-5 py-4">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Date of Birth
                            </label>

                            <input type="date"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-5 py-4">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Gender
                            </label>

                            <select
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-5 py-4">

                                <option>Male</option>
                                <option>Female</option>

                            </select>

                        </div>

                    </div>

                    <div class="space-y-4">

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Doctor Name
                            </label>

                            <input type="text"
                            value="dr. Budi Santoso"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-5 py-4">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Department
                            </label>

                            <input type="text"
                            value="Internal Medicine"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-5 py-4">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Visit Type
                            </label>

                            <input type="text"
                            value="Outpatient"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-5 py-4">
                        </div>

                    </div>

                </div>

            </div>

            <!-- MAIN -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                <!-- LEFT -->
                <div class="space-y-6">

                    <!-- ANAMNESIS -->
                    <div class="bg-white border border-slate-200 rounded-[30px] p-6 shadow-sm">

                        <h3 class="text-xl font-bold text-slate-800 mb-5">
                            Anamnesis
                        </h3>

                        <textarea rows="5"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">
Patient complains of fever, cough, and sore throat for the last 3 days.
                        </textarea>

                    </div>

                    <!-- HISTORY -->
                    <div class="bg-white border border-slate-200 rounded-[30px] p-6 shadow-sm">

                        <h3 class="text-xl font-bold text-slate-800 mb-5">
                            Medical History
                        </h3>

                        <textarea rows="4"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">
No history of chronic disease.
                        </textarea>

                    </div>

                    <!-- EXAMINATION -->
                    <div class="bg-white border border-slate-200 rounded-[30px] p-6 shadow-sm">

                        <h3 class="text-xl font-bold text-slate-800 mb-5">
                            Physical Examination
                        </h3>

                        <div class="grid grid-cols-2 gap-4">

                            <input type="text"
                            placeholder="Temperature"
                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">

                            <input type="text"
                            placeholder="Blood Pressure"
                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">

                            <input type="text"
                            placeholder="Heart Rate"
                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">

                            <input type="text"
                            placeholder="Respiratory Rate"
                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="space-y-6">

                    <!-- DIAGNOSIS -->
                    <div class="bg-white border border-slate-200 rounded-[30px] p-6 shadow-sm">

                        <h3 class="text-xl font-bold text-slate-800 mb-5">
                            Diagnosis
                        </h3>

                        <div class="space-y-5">

                            <div>

                                <label class="text-sm font-semibold text-slate-700">
                                    Working Diagnosis
                                </label>

                                <input type="text"
                                value="Acute Pharyngitis"
                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">

                            </div>

                            <div>

                                <label class="text-sm font-semibold text-slate-700">
                                    Final Diagnosis
                                </label>

                                <input type="text"
                                value="Acute Pharyngitis (J02.9)"
                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">

                            </div>

                            <div>

                                <label class="text-sm font-semibold text-slate-700">
                                    ICD-10 Code
                                </label>

                                <input type="text"
                                value="J02.9"
                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">

                            </div>

                        </div>

                    </div>

                    <!-- TREATMENT -->
                    <div class="bg-emerald-50 border border-emerald-100 rounded-[30px] p-6">

                        <h3 class="text-xl font-bold text-emerald-700 mb-5">
                            Treatment Plan
                        </h3>

                        <div class="overflow-x-auto">

                            <table class="w-full">

                                <thead>

                                    <tr class="bg-emerald-100">

                                        <th class="px-4 py-3 text-left text-sm">
                                            Medicine
                                        </th>

                                        <th class="px-4 py-3 text-left text-sm">
                                            Dosage
                                        </th>

                                        <th class="px-4 py-3 text-left text-sm">
                                            Frequency
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr class="border-b border-emerald-100">

                                        <td class="px-4 py-4">
                                            Paracetamol 500mg
                                        </td>

                                        <td class="px-4 py-4">
                                            1 Tablet
                                        </td>

                                        <td class="px-4 py-4">
                                            3x Daily
                                        </td>

                                    </tr>

                                    <tr>

                                        <td class="px-4 py-4">
                                            Amoxicillin 500mg
                                        </td>

                                        <td class="px-4 py-4">
                                            1 Capsule
                                        </td>

                                        <td class="px-4 py-4">
                                            2x Daily
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <!-- NOTES -->
                    <div class="bg-white border border-slate-200 rounded-[30px] p-6 shadow-sm">

                        <h3 class="text-xl font-bold text-slate-800 mb-5">
                            Additional Notes
                        </h3>

                        <textarea rows="4"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">
Get enough rest and drink plenty of water.
                        </textarea>

                    </div>

                </div>

            </div>

            <!-- SIGNATURE -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-5">

                <div class="bg-slate-50 border border-slate-200 rounded-[30px] p-6 text-center">

                    <h3 class="font-bold text-slate-800 mb-4">
                        Doctor Signature
                    </h3>

                    <div class="h-32 border-2 border-dashed border-slate-300 rounded-2xl flex items-center justify-center text-slate-400">
                        Signature Area
                    </div>

                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-[30px] p-6 text-center">

                    <h3 class="font-bold text-slate-800 mb-4">
                        Patient Signature
                    </h3>

                    <div class="h-32 border-2 border-dashed border-slate-300 rounded-2xl flex items-center justify-center text-slate-400">
                        Signature Area
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="pt-4">

                <button
                class="w-full py-5 rounded-3xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-lg shadow-xl hover:scale-[1.01] transition-all duration-300">

                    Save Diagnosis Report

                </button>

            </div>

        </div>

    </div>

</div>

@endsection