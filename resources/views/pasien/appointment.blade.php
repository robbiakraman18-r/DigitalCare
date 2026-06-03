@extends('layouts.pasien') {{-- Sesuaikan dengan nama layout dashboard Anda --}}

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Make Appointment</h1>
                <p class="text-sm text-gray-500">Fill in the details below to book your appointment</p>
            </div>
        </div>
    </div>

    <form action="{{ route('pasien.appointment.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex items-center space-x-3 mb-6">
                        <span class="flex items-center justify-center w-6 h-6 bg-emerald-600 text-white rounded-full text-sm font-semibold">1</span>
                        <h2 class="text-lg font-bold text-gray-800">Personal Information</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-500" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. ID Pasien</label>
                            <input type="text" value="{{ Auth::id() }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-500" readonly>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <input type="text" value="{{ Auth::user()->tanggal_lahir ?? '-' }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-500" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                            <input type="text" value="{{ Auth::user()->jenis_kelamin ?? '-' }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-500" readonly>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-500" readonly>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex items-center space-x-3 mb-6">
                        <span class="flex items-center justify-center w-6 h-6 bg-emerald-600 text-white rounded-full text-sm font-semibold">2</span>
                        <h2 class="text-lg font-bold text-gray-800">Appointment Details</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="tanggal_janji" class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
                            <input type="date" name="tanggal_janji" id="tanggal_janji" min="{{ date('Y-m-disini') }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('tanggal_janji') border-red-500 @enderror" required>
                            @error('tanggal_janji') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="id_dokter" class="block text-sm font-medium text-gray-700 mb-1">Select Doctor</label>
                            <select name="id_dokter" id="id_dokter" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('id_dokter') border-red-500 @enderror" required>
                                <option value="">-- Choose Doctor --</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id_dokter }}">Dr. {{ $dokter->nama_dokter }} ({{ $dokter->spesialisasi }})</option>
                                @endforeach
                            </select>
                            @error('id_dokter') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 flex flex-col">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex-1 mb-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <span class="flex items-center justify-center w-6 h-6 bg-emerald-600 text-white rounded-full text-sm font-semibold">3</span>
                        <h2 class="text-lg font-bold text-gray-800">Visit Details</h2>
                    </div>

                    <div>
                        <label for="keluhan_utama" class="block text-sm font-medium text-gray-700 mb-1">Reason for Visit</label>
                        <textarea name="keluhan_utama" id="keluhan_utama" rows="8" placeholder="Describe your symptoms here..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('keluhan_utama') border-red-500 @enderror" required></textarea>
                        @error('keluhan_utama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6">
            <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/20 transition duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Book Appointment</span>
            </button>
        </div>
    </form>
</div>
@endsection