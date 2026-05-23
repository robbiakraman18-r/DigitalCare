 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun - DigitalCare</title>
    
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-[#f0fffd] via-[#f8fffe] to-[#ecfffb] flex items-center justify-center p-6">

<div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 text-center relative overflow-hidden">
    <div class="absolute -top-10 -right-10 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl"></div>
    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl"></div>

    @if(session('verified'))
        <div class="w-20 h-20 mx-auto rounded-3xl bg-emerald-50 flex items-center justify-center text-emerald-500 text-4xl shadow-inner mb-6 animate-bounce">
            🎉
        </div>
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Registrasi Berhasil!</h2>
        <p class="text-sm text-slate-500 px-4 mb-6">
            Email Anda telah berhasil diverifikasi. Akun pasien dan Nomor Rekam Medis Anda kini telah aktif sepenuhnya di DigitalCare.
        </p>
        <button onclick="window.location.href='/login'" class="w-full py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-200 transition duration-300">
            Masuk ke Aplikasi
        </button>
    @else
        <div class="w-20 h-20 mx-auto rounded-3xl bg-teal-50 flex items-center justify-center text-teal-500 text-4xl shadow-inner mb-6">
            ✉️
        </div>
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Verifikasi Akun Anda</h2>
        
        <p class="text-sm text-slate-500 px-4 mb-6">
            Link verifikasi telah dikirimkan ke email 
            <span class="font-semibold text-teal-600 block mt-1 break-all">{{ session('email') ?? 'email Anda' }}</span>. 
            Silakan buka kotak masuk email tersebut dan klik tautan untuk mengaktifkan akun.
        </p>

        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 mb-6 text-xs text-left text-slate-600 space-y-2">
            <div class="flex items-start gap-2">
                <span class="text-teal-500 font-bold">✓</span>
                <span>Nomor Rekam Medis (RM) otomatis Anda telah dicadangkan oleh sistem PoliBatam Clinic.</span>
            </div>
        </div>

        <div class="space-y-3">
            <button onclick="window.location.href='/login'" class="w-full py-3 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-medium transition">
                Kembali ke Login
            </button>
        </div>
    @endif
</div>

</body>
</html>
