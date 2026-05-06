<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - DigitalCare</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-6xl bg-white rounded-xl shadow-md overflow-hidden flex">

    <!-- LEFT IMAGE -->
    <div class="w-1/2 hidden md:block relative">
        <img src="/images/medical.jpg" class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-teal-500/40 flex items-center justify-center">
            <h1 class="text-white text-3xl font-bold">Reset Password</h1>
        </div>
    </div>

    <!-- RIGHT FORM -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-10">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">

            <!-- LOGO -->
            <div class="text-center mb-6">
                <div class="text-teal-600 text-3xl mb-2">🩺</div>
                <h2 class="text-xl font-semibold text-gray-800">DigitalCare</h2>
                <p class="text-sm text-gray-500">Better Healthcare, Digitally</p>
            </div>

            <h3 class="text-lg font-semibold text-center mb-1">Reset Password</h3>
            <p class="text-sm text-gray-500 text-center mb-6">
                Masukkan password baru Anda
            </p>

            <!-- FORM -->
            <form>

                <div class="mb-4">
                    <input type="password"
                        placeholder="Password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>

                <div class="mb-4">
                    <input type="password"
                        placeholder="Konfirmasi Password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 outline-none">
                </div>

                <button type="button"
                    onclick="reset()"
                     class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition duration-200 font-medium">
                    Confirm Password
                </button>

            </form>

        </div>
    </div>

</div>

<script>
function reset() {
    alert("Password berhasil direset (dummy)");
    window.location.href = "/login";
}
</script>

</body>
</html>