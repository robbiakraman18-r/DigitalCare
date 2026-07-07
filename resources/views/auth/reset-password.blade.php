<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password - DigitalCare</title>

    @vite('resources/css/app.css')

</head>

<body class="min-h-screen bg-gradient-to-br from-[#f0fffd] via-[#f8fffe] to-[#ecfffb] flex items-center justify-center p-6">

    <!-- CARD -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

        <!-- LOGO -->
        <div class="text-center mb-7">

            <div class="w-14 h-14 mx-auto rounded-2xl bg-teal-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-200">
                🩺
            </div>

            <h2 class="mt-4 text-2xl font-bold text-slate-800">
                DigitalCare
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Better Healthcare, Digitally
            </p>

        </div>

        <!-- TITLE -->
        <div class="mb-6 text-center">

            <h3 class="text-2xl font-bold text-slate-800">
                Create New Password
            </h3>

            <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                Masukkan password baru untuk akun Anda
            </p>

        </div>

        <!-- FORM -->
        @if ($errors->any())
    <div class="mb-4 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-600 text-sm">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="mb-4">
        <input type="password" name="password" minlength="8" placeholder="Password Baru"
            class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition" required>
    </div>

    <div class="mb-6">
        <input type="password" name="password_confirmation" minlength="8" placeholder="Konfirmasi Password"
            class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-teal-500 outline-none transition" required>
    </div>

    <button type="submit" class="w-full py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-semibold shadow-lg shadow-teal-200 transition duration-300">
        SIMPAN PASSWORD
    </button>

    <div class="flex items-center gap-3 my-6">
        <div class="h-px bg-slate-200 flex-1"></div>
        <span class="text-sm text-slate-400">atau</span>
        <div class="h-px bg-slate-200 flex-1"></div>
    </div>

    <button type="button" onclick="window.location.href='/login'" class="w-full py-3 rounded-2xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition">
        Kembali ke Login
    </button>
</form>

    </div>

    <!-- SCRIPT -->
    <script>

        function resetPassword() {

            alert("Password berhasil direset!");

            window.location.href = "/login";

        }

    </script>

</body>
</html>