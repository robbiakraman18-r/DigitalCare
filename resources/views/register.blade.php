<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/style_lolly.css') }}">
    <script src="{{ asset('js/script_lolly.js') }}" defer></script>

    <!-- Font Awesome (icon mata) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Register</title>

    <style>
    body {
        background-image: url("{{ asset('images/polibatam.jpg') }}");
        background-size: cover;
        background-position: center;
        height: 100vh;
    }
    </style>
</head>

<body>

<div class="register-box">
    <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <h2>DigitalCare Polibatam</h2>

    <!-- Tambah onsubmit -->
    <form onsubmit="return validatePassword()">

        <input type="text" name="nama" placeholder="Nama" required><br><br>

        <input type="email" name="email" placeholder="Email" required><br><br>

        <!-- PASSWORD -->
        <div class="password-box">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword('password','eye-open','eye-closed')">
                <i class="fa-solid fa-eye" id="eye-open"></i>
                <i class="fa-solid fa-eye-slash" id="eye-closed" style="display: none;"></i>
            </span>
        </div>

        <br>

        <!-- CONFIRM PASSWORD -->
        <div class="password-box">
            <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm Password" required>
            <span class="toggle-password" onclick="togglePassword('confirm_password','eye-open2','eye-closed2')">
                <i class="fa-solid fa-eye" id="eye-open2"></i>
                <i class="fa-solid fa-eye-slash" id="eye-closed2" style="display: none;"></i>
            </span>
        </div>

        <br>

        <div class="button-group">
            <button type="submit" class="submit-box">Submit</button>
            <button type="button" class="cancel-box" onclick="window.location.href='{{ url('/') }}'">Cancel</button>
        </div>

    </form>
</div>

</body>
</html>